<?php
/**
 * Простые настройки сайта в JSON (для админки/форм/почты).
 *
 * Файл: database/site_settings.json
 *
 * Структура (пример):
 * {
 *   "contact_form_recipients": ["example@mail.com"]
 * }
 */

function siteSettingsPath() {
    return dirname(__DIR__) . '/database/site_settings.json';
}

function getDefaultSiteSettings() {
    // дефолты — чтобы сайт работал даже без файла настроек
    return [
        'contact_form_recipients' => [],
    ];
}

function getSiteSettings() {
    $path = siteSettingsPath();
    $defaults = getDefaultSiteSettings();

    if (!is_file($path)) {
        return $defaults;
    }

    $raw = file_get_contents($path);
    $data = json_decode($raw, true);
    if (!is_array($data)) {
        return $defaults;
    }

    return array_replace($defaults, $data);
}

function saveSiteSettings($settings) {
    $path = siteSettingsPath();
    $dir = dirname($path);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    $defaults = getDefaultSiteSettings();
    $settings = array_replace($defaults, is_array($settings) ? $settings : []);

    file_put_contents($path, json_encode($settings, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
}

