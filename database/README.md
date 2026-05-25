# База данных агро-карт

## Установка

1. Создайте БД в MySQL:
   ```sql
   CREATE DATABASE kniiz_maps CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Скопируйте `config/database.sample.php` → `config/database.php` и укажите доступ.

3. Импортируйте схему и тестовые данные:
   ```bash
   mysql -u root -p kniiz_maps < database/schema.sql
   mysql -u root -p kniiz_maps < database/seed.sql
   ```

Без `config/database.php` сайт автоматически использует `data/fields_seed.json`.

## Таблицы

- `regions` — области Кыргызстана
- `fields` — поля (координаты в JSON)
- `field_crop_history` — история культур и урожая по годам

## API

- `GET /api/fields.php?region=naryn&culture=wheat&search=поле`
- `GET /api/field.php?id=12`
- `GET /api/stats.php?region=naryn`
