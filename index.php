<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Bypass routing for existing files (like sitemap.xml)
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestedFile = __DIR__ . '/../' . ltrim($uri, '/');
if (file_exists($requestedFile) && is_file($requestedFile)) {
    header('Content-Type: ' . mime_content_type($requestedFile));
    readfile($requestedFile);
    exit;
}

require_once __DIR__ . '/routes/route.php';
$metaConfig = require __DIR__ . '/public/data/meta.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/';
$page = trim(str_replace($basePath, '', $uri), '/');
$page = $page ?: 'home';

if ($page === 'submit-contact') {
    require_once __DIR__ . '/../server/controllers/MailerController.php';
    exit; // 🚀 stop here, don’t load header/footer
}

// Load meta (fallback to default if page not found in config)
$meta = $metaConfig[$page] ?? $metaConfig['default'];

// Handle dynamic meta (example: blog-detail, course-view)
// if ($page === 'blog-detail' && isset($_GET['id'])) {
//     // Fetch blog data from DB
//     require_once __DIR__ . '/../server/models/BlogModel.php';
//     $blog = BlogModel::getBlogById($_GET['id']);
//     if ($blog) {
//         $meta['title'] = $blog['title'] . ' | My Website';
//         $meta['description'] = substr(strip_tags($blog['content']), 0, 150);
//         $meta['keywords'] = $blog['tags'] ?? $meta['keywords'];
//     }
// }

// if ($page === 'course-view' && isset($_GET['id'])) {
//     // Fetch course data from DB
//     require_once __DIR__ . '/../server/models/CourseModel.php';
//     $course = CourseModel::getCourseById($_GET['id']);
//     if ($course) {
//         $meta['title'] = $course['name'] . ' | My Website';
//         $meta['description'] = substr(strip_tags($course['description']), 0, 150);
//         $meta['keywords'] = $course['keywords'] ?? $meta['keywords'];
//     }
// }

$viewFile = route($page);

// Make $meta available in views
include __DIR__ . '/views/partials/header.php';

if (file_exists($viewFile)) {
    include $viewFile;
} else {
    http_response_code(404);
    echo "<h1>404 - Page Not Found</h1>";
}

include __DIR__ . '/views/partials/footer.php';
