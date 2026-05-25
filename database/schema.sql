-- Схема БД для агро-карт КНИИЗ
-- CREATE DATABASE kniiz_maps CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS regions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(64) NOT NULL UNIQUE,
    iso_code VARCHAR(8) NOT NULL,
    name_ru VARCHAR(255) NOT NULL,
    name_ky VARCHAR(255) DEFAULT NULL,
    name_en VARCHAR(255) DEFAULT NULL,
    center_lat DECIMAL(10, 7) NOT NULL,
    center_lng DECIMAL(10, 7) NOT NULL,
    default_zoom TINYINT UNSIGNED DEFAULT 10,
    color VARCHAR(16) DEFAULT '#2a9d8f',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS enterprises (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    num TINYINT UNSIGNED NOT NULL,
    region_id INT UNSIGNED NOT NULL,
    slug VARCHAR(64) NOT NULL,
    type_key VARCHAR(64) NOT NULL,
    color VARCHAR(16) NOT NULL DEFAULT '#2a9d8f',
    name_ru VARCHAR(255) NOT NULL,
    name_ky VARCHAR(255) DEFAULT NULL,
    name_en VARCHAR(255) DEFAULT NULL,
    address_ru VARCHAR(255) NOT NULL,
    address_ky VARCHAR(255) DEFAULT NULL,
    address_en VARCHAR(255) DEFAULT NULL,
    activity_ru TEXT NOT NULL,
    activity_ky TEXT DEFAULT NULL,
    activity_en TEXT DEFAULT NULL,
    hectares DECIMAL(8, 2) NOT NULL DEFAULT 0,
    director_ru VARCHAR(255) NOT NULL,
    director_ky VARCHAR(255) DEFAULT NULL,
    director_en VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(64) NOT NULL,
    map_x INT DEFAULT 0,
    map_y INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_enterprises_region FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS fields (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    region_id INT UNSIGNED NOT NULL,
    enterprise_id INT UNSIGNED DEFAULT NULL,
    name VARCHAR(255) NOT NULL,
    culture VARCHAR(128) NOT NULL,
    culture_key VARCHAR(64) NOT NULL,
    hectares DECIMAL(8, 2) NOT NULL DEFAULT 0,
    year SMALLINT UNSIGNED NOT NULL,
    moisture DECIMAL(5, 2) DEFAULT NULL,
    status ENUM('good', 'attention', 'critical') DEFAULT 'good',
    coordinates JSON NOT NULL,
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_fields_region FOREIGN KEY (region_id) REFERENCES regions(id) ON DELETE CASCADE,
    CONSTRAINT fk_fields_enterprise FOREIGN KEY (enterprise_id) REFERENCES enterprises(id) ON DELETE SET NULL,
    INDEX idx_fields_region (region_id),
    INDEX idx_fields_enterprise (enterprise_id),
    INDEX idx_fields_culture (culture_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS field_crop_history (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    field_id INT UNSIGNED NOT NULL,
    year SMALLINT UNSIGNED NOT NULL,
    culture VARCHAR(128) NOT NULL,
    culture_key VARCHAR(64) NOT NULL,
    yield_tons DECIMAL(10, 2) DEFAULT NULL,
    notes VARCHAR(512) DEFAULT NULL,
    CONSTRAINT fk_history_field FOREIGN KEY (field_id) REFERENCES fields(id) ON DELETE CASCADE,
    UNIQUE KEY uk_field_year (field_id, year)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

