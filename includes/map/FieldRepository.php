<?php

require_once __DIR__ . '/helpers.php';

class FieldRepository
{
    private ?PDO $pdo = null;
    private bool $useDatabase = false;
    private array $seedCache = [];

    public function __construct()
    {
        $this->pdo = $this->connect();
        $this->useDatabase = $this->pdo !== null;
    }

    private function connect(): ?PDO
    {
        $configFile = dirname(__DIR__, 2) . '/config/database.php';
        if (!file_exists($configFile)) {
            return null;
        }
        $db = require $configFile;
        try {
            $dsn = sprintf(
                'mysql:host=%s;port=%d;dbname=%s;charset=%s',
                $db['host'],
                (int) ($db['port'] ?? 3306),
                $db['dbname'],
                $db['charset'] ?? 'utf8mb4'
            );
            $pdo = new PDO($dsn, $db['username'], $db['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
            return $pdo;
        } catch (Throwable $e) {
            return null;
        }
    }

    private function loadSeed(): array
    {
        if (!empty($this->seedCache)) {
            return $this->seedCache;
        }
        $path = dirname(__DIR__, 2) . '/data/fields_seed.json';
        if (!file_exists($path)) {
            return [];
        }
        $data = json_decode(file_get_contents($path), true);
        $this->seedCache = is_array($data) ? $data : [];
        return $this->seedCache;
    }

    public function isUsingDatabase(): bool
    {
        return $this->useDatabase;
    }

    public function getFieldsByRegion(string $regionSlug, ?string $cultureKey = null, ?string $search = null, ?int $enterpriseId = null): array
    {
        if ($this->useDatabase) {
            return $this->fetchFieldsFromDb($regionSlug, $cultureKey, $search, $enterpriseId);
        }
        return $this->filterSeed($regionSlug, $cultureKey, $search, $enterpriseId);
    }

    public function getFieldById(int $id): ?array
    {
        if ($this->useDatabase) {
            return $this->fetchFieldFromDb($id);
        }
        foreach ($this->loadSeed()['fields'] ?? [] as $field) {
            if ((int) $field['id'] === $id) {
                return $this->normalizeField($field);
            }
        }
        return null;
    }

    public function getRegionStats(string $regionSlug, ?int $enterpriseId = null): array
    {
        $fields = $this->getFieldsByRegion($regionSlug, null, null, $enterpriseId);
        $totalHa = 0;
        $cultures = [];
        $avgMoisture = 0;
        $moistureCount = 0;

        foreach ($fields as $field) {
            $totalHa += (float) ($field['hectares'] ?? 0);
            $key = $field['culture_key'] ?? 'other';
            $cultures[$key] = ($cultures[$key] ?? 0) + 1;
            if (isset($field['moisture'])) {
                $avgMoisture += (float) $field['moisture'];
                $moistureCount++;
            }
        }

        return [
            'fields_count' => count($fields),
            'total_hectares' => round($totalHa, 2),
            'cultures' => $cultures,
            'avg_moisture' => $moistureCount ? round($avgMoisture / $moistureCount, 1) : null,
        ];
    }

    public function getCropHistory(int $fieldId): array
    {
        if ($this->useDatabase) {
            $stmt = $this->pdo->prepare(
                'SELECT year, culture, culture_key, yield_tons, notes
                 FROM field_crop_history WHERE field_id = :id ORDER BY year DESC'
            );
            $stmt->execute(['id' => $fieldId]);
            return $stmt->fetchAll();
        }
        foreach ($this->loadSeed()['fields'] ?? [] as $field) {
            if ((int) $field['id'] === $fieldId) {
                return $field['history'] ?? [];
            }
        }
        return [];
    }

    private function filterSeed(string $regionSlug, ?string $cultureKey, ?string $search, ?int $enterpriseId = null): array
    {
        $out = [];
        foreach ($this->loadSeed()['fields'] ?? [] as $field) {
            if (($field['region_slug'] ?? '') !== $regionSlug) {
                continue;
            }
            if ($enterpriseId !== null) {
                $f_ent_id = isset($field['enterprise_id']) ? (int)$field['enterprise_id'] : null;
                if ($f_ent_id !== $enterpriseId) {
                    continue;
                }
            }
            if ($cultureKey && ($field['culture_key'] ?? '') !== $cultureKey) {
                continue;
            }
            if ($search) {
                $hay = mb_strtolower(
                    ($field['name'] ?? '') . ' ' . ($field['culture'] ?? ''),
                    'UTF-8'
                );
                if (mb_strpos($hay, mb_strtolower($search, 'UTF-8')) === false) {
                    continue;
                }
            }
            $out[] = $this->normalizeField($field);
        }
        return $out;
    }

    private function normalizeField(array $field): array
    {
        $coords = $field['coordinates'] ?? [];
        if (is_string($coords)) {
            $coords = json_decode($coords, true) ?: [];
        }
        $field['coordinates'] = $coords;
        $field['color'] = mapCultureColor($field['culture_key'] ?? 'other');
        return $field;
    }

    private function fetchFieldsFromDb(string $regionSlug, ?string $cultureKey, ?string $search, ?int $enterpriseId = null): array
    {
        $sql = 'SELECT f.*, r.slug AS region_slug FROM fields f
                JOIN regions r ON r.id = f.region_id
                WHERE r.slug = :slug';
        $params = ['slug' => $regionSlug];
        if ($enterpriseId !== null) {
            $sql .= ' AND f.enterprise_id = :enterprise_id';
            $params['enterprise_id'] = $enterpriseId;
        }
        if ($cultureKey) {
            $sql .= ' AND f.culture_key = :culture';
            $params['culture'] = $cultureKey;
        }
        if ($search) {
            $sql .= ' AND (f.name LIKE :q OR f.culture LIKE :q)';
            $params['q'] = '%' . $search . '%';
        }
        $sql .= ' ORDER BY f.name';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return array_map([$this, 'normalizeField'], $rows);
    }

    private function fetchFieldFromDb(int $id): ?array
    {
        $stmt = $this->pdo->prepare(
            'SELECT f.*, r.slug AS region_slug FROM fields f
             JOIN regions r ON r.id = f.region_id WHERE f.id = :id LIMIT 1'
        );
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row ? $this->normalizeField($row) : null;
    }
}
