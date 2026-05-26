<?php

/**
 * Приводит новость к формату с мультиязычными полями:
 *   title: {ru,en,ky}
 *   text:  {ru,en,ky}
 */
function normalizeNewsItem($news) {
    $langs = ['ru', 'en', 'ky'];

    // title
    if (isset($news['title']) && is_string($news['title'])) {
        $t = $news['title'];
        $news['title'] = ['ru' => $t, 'en' => $t, 'ky' => $t];
    }
    if (!isset($news['title']) || !is_array($news['title'])) {
        $news['title'] = ['ru' => '', 'en' => '', 'ky' => ''];
    }
    foreach ($langs as $lc) {
        if (!isset($news['title'][$lc])) $news['title'][$lc] = $news['title']['ru'] ?? '';
    }

    // text
    if (isset($news['text']) && is_string($news['text'])) {
        $full = $news['text'];
        $split = _splitLegacyNewsText($full);
        $news['text'] = [
            'ky' => $split['ky'] ?? $full,
            'ru' => $split['ru'] ?? $full,
            'en' => $split['en'] ?? ($split['ru'] ?? $full),
        ];
    }
    if (!isset($news['text']) || !is_array($news['text'])) {
        $news['text'] = ['ru' => '', 'en' => '', 'ky' => ''];
    }
    foreach ($langs as $lc) {
        if (!isset($news['text'][$lc])) $news['text'][$lc] = $news['text']['ru'] ?? '';
    }

    return $news;
}

function newsGetTitle($news, $lang) {
    $news = normalizeNewsItem($news);
    return $news['title'][$lang] ?? ($news['title']['ru'] ?? '');
}

function newsGetText($news, $lang) {
    $news = normalizeNewsItem($news);
    return $news['text'][$lang] ?? ($news['text']['ru'] ?? '');
}

function _splitLegacyNewsText($text) {
    // 1) Старый формат с разделителем "***" (или "*****")
    $sections = preg_split('/\r?\n\*+\r?\n/', (string)$text);
    if (is_array($sections) && count($sections) >= 2) {
        return [
            // В старом коде: ky=0, ru=1, en=2
            'ky' => trim($sections[0] ?? ''),
            'ru' => trim($sections[1] ?? ($sections[0] ?? '')),
            'en' => trim($sections[2] ?? ($sections[1] ?? ($sections[0] ?? ''))),
        ];
    }

    // 2) Часто встречается маркер "🔰" перед русским блоком
    $pos = mb_strpos($text, '🔰');
    if ($pos !== false) {
        $ky = trim(mb_substr($text, 0, $pos));
        $ru = trim(mb_substr($text, $pos));
        return ['ky' => $ky, 'ru' => $ru];
    }

    return [];
}

