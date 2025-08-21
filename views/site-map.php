<?php
header("Content-Type: application/xml; charset=utf-8");

// Base URL of your website
$baseUrl = "https://www.artsoffinance.com";

// Include your route function
require_once __DIR__ . '/../routes/route.php';

// List of static pages based on your routes
$staticPages = [
    '', '/', 'home',
    'pricing',
    'contact',
    'about-us',
    'courses',
    'courses-list',
    'course-view',
    'teachers',
    'mentor-profile',
    'gallery',
    'blog',
    'blog-detail'
];


// 2a. Mentors (id 1 to 2)
$mentorPages = [];
for ($i = 1; $i <= 2; $i++) {
    $mentorPages[] = "mentor-profile?id=$i";
}

// 2b. Courses list and course-view
$sections = ['basic', 'advance', 'placement'];
$courseListPages = [];
$courseViewPages = [];
$courseIds = [
    'basic' => [1],
    'advance' => [2],
    'placement' => [3,4,5,6,7,8,9,10,11,12] // Adjust as needed
];

foreach ($sections as $section) {
    // courses-list page for each section
    $courseListPages[] = "courses-list?sectionName=$section";

    // course-view pages
    foreach ($courseIds[$section] as $id) {
        $courseViewPages[] = "course-view?sectionName=$section&id=$id";
    }
}

// 2c. Blogs (id 1 to 13)
$blogPages = [];
for ($i = 1; $i <= 13; $i++) {
    $blogPages[] = "blog-detail?id=$i";
}
$allPages = array_merge($staticPages, $mentorPages, $courseListPages, $courseViewPages, $blogPages);

// Start XML
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset/>');
$xml->addAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

foreach ($allPages as $page) {
    $url = $xml->addChild('url');
    $loc = rtrim($baseUrl, '/') . '/' . ltrim($page, '/');
    $url->addChild('loc', htmlspecialchars($loc));
    $url->addChild('lastmod', date('Y-m-d'));
    $url->addChild('changefreq', 'monthly');
    $url->addChild('priority', '0.8');
}

// Output XML
// echo $xml->asXML();

// Optional: save to sitemap.xml
file_put_contents(__DIR__ . '/../public/sitemap.xml', $xml->asXML());

echo "\nSitemap generated successfully!";
