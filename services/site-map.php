<?php
// services/site-map.php

$baseUrl = "https://www.artsoffinance.in";

$staticPages = [
    '', '/', 'home',
    'contact',
    'about-us',
    'courses', 'courses-list',
    'teachers',
    'gallery',
    'blog',
];

$mentorPages = [];
for ($i = 1; $i <= 2; $i++) {
    $mentorPages[] = "mentor-profile?id=$i";
}

$sections = ['basic', 'advance', 'placement'];
$courseListPages = [];
$courseViewPages = [];
$courseIds = [
    'basic' => [1],
    'advance' => [2],
    'placement' => [3,4,5,6,7,8,9,10,11,12]
];

foreach ($sections as $section) {
    $courseListPages[] = "courses-list?sectionName=$section";
    foreach ($courseIds[$section] as $id) {
        $courseViewPages[] = "course-view?sectionName=$section&id=$id";
    }
}

$blogPages = [];
for ($i = 1; $i <= 13; $i++) {
    $blogPages[] = "blog-detail?id=$i";
}

$allPages = array_merge($staticPages, $mentorPages, $courseListPages, $courseViewPages, $blogPages);

$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
$xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

foreach ($allPages as $page) {
    $url = $xml->addChild('url');
    $loc = rtrim($baseUrl, '/') . '/' . ltrim($page, '/');
    $url->addChild('loc', htmlspecialchars($loc, ENT_QUOTES));
    $url->addChild('lastmod', date('Y-m-d'));
    $url->addChild('changefreq', 'monthly');
    $url->addChild('priority', '0.8');
}

// Save to public folder
file_put_contents(__DIR__ . '/../sitemap.xml', $xml->asXML());
