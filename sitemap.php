<?php
/**
 * sitemap.php — динамический sitemap для KNIIZ_SITE
 * Доступен по адресу: https://kniiz.kg/sitemap.xml (через robots.txt)
 * Или напрямую: https://kniiz.kg/sitemap.php
 */
header('Content-Type: application/xml; charset=utf-8');

$base  = 'https://kniiz.kg';
$langs = ['ru', 'en', 'ky'];

$staticPages = [
    ['loc' => '/',                                            'priority' => '1.0', 'changefreq' => 'weekly'],
    ['loc' => '/news.php',                                    'priority' => '0.9', 'changefreq' => 'daily'],
    ['loc' => '/history.php',                                 'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/maps.php',                                    'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/science.php',                                 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/administration.php',                          'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/documents.php',                               'priority' => '0.6', 'changefreq' => 'monthly'],
    ['loc' => '/gallery.php',                                 'priority' => '0.7', 'changefreq' => 'weekly'],
    ['loc' => '/contacts.php',                                'priority' => '0.6', 'changefreq' => 'yearly'],
    ['loc' => '/katalog.php',                                 'priority' => '0.8', 'changefreq' => 'monthly'],
    ['loc' => '/international.php',                           'priority' => '0.6', 'changefreq' => 'monthly'],
    ['loc' => '/structure-detail.php?item=wheat',             'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/structure-detail.php?item=barley',            'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/structure-detail.php?item=corn',              'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/structure-detail.php?item=sugarbeet',         'priority' => '0.7', 'changefreq' => 'monthly'],
    ['loc' => '/structure-detail.php?item=fruit_veg',         'priority' => '0.6', 'changefreq' => 'monthly'],
    ['loc' => '/structure-detail.php?item=soil',              'priority' => '0.6', 'changefreq' => 'monthly'],
    ['loc' => '/structure-detail.php?item=agrochemistry',     'priority' => '0.6', 'changefreq' => 'monthly'],
];

$today = date('Y-m-d');

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
echo '        xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

foreach ($staticPages as $page) {
    $path = $page['loc'];

    // Canonical URL (без lang-параметра)
    $canonicalLoc = $base . $path;

    // Определяем разделитель параметра
    $sep = (strpos($path, '?') !== false) ? '&amp;' : '?';

    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($canonicalLoc, ENT_XML1) . "</loc>\n";
    echo "    <lastmod>{$today}</lastmod>\n";
    echo "    <changefreq>{$page['changefreq']}</changefreq>\n";
    echo "    <priority>{$page['priority']}</priority>\n";

    // hreflang alternate links
    foreach ($langs as $lang) {
        $hrefLoc = $base . $path . $sep . 'lang=' . $lang;
        if (strpos($path, '?') !== false && $lang !== $langs[0]) {
            // уже есть ? — нужен &amp;
        }
        // Пересчитываем sep корректно
        $hlSep = (strpos($path, '?') !== false) ? '&amp;' : '?';
        $hrefLoc = $base . $path . $hlSep . 'lang=' . $lang;
        echo '    <xhtml:link rel="alternate" hreflang="' . $lang . '" href="' . htmlspecialchars($hrefLoc, ENT_XML1) . '"/>' . "\n";
    }
    // x-default → русский
    $defaultHref = $base . $path . ((strpos($path, '?') !== false) ? '&amp;' : '?') . 'lang=ru';
    echo '    <xhtml:link rel="alternate" hreflang="x-default" href="' . htmlspecialchars($defaultHref, ENT_XML1) . '"/>' . "\n";

    echo "  </url>\n";
}

echo '</urlset>' . "\n";
