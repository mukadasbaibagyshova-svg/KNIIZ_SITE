<?php

/**
 * Возвращает путь к картинке с учетом замены из админки.
 * В базе хранится JSON:
 *   { "index.hero1": "uploads/site/hero1.jpg", ... }
 */
function siteImage($key, $defaultPath) {
    static $cache = null;
    if ($cache === null) {
        $file = __DIR__ . '/../database/image_overrides.json';
        $cache = [];
        if (is_file($file)) {
            $raw = file_get_contents($file);
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) $cache = $decoded;
        }
    }
    if (isset($cache[$key]) && is_string($cache[$key]) && $cache[$key] !== '') {
        return $cache[$key];
    }
    return $defaultPath;
}

