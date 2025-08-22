<?php
// routes/route.php

function route($page) {
    $viewPath = __DIR__ . '/../views/';
      $controllerPath = __DIR__ . '/../server/controllers/';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        switch ($page) {
            case 'submit-contact':
                return $controllerPath . 'MailerController.php';
        }
    }

    switch ($page) {
        case 'contact':
            return $viewPath . 'contact.php';
        case 'about-us':
            return $viewPath . 'about-us.php';
        case 'courses':
            return $viewPath . 'courses/courses.php';
         case 'courses-list':
            return $viewPath . 'courses/courses-list.php';
        case 'course-view':
            return $viewPath . 'courses/view-course.php';
        case 'teachers':
            return $viewPath . 'teachers.php';
        case 'mentor-profile':  
            return $viewPath . 'mentor-profile.php';
        case 'gallery':
            return $viewPath . 'gallery.php';
        case 'blog':
            return $viewPath . 'blog/blog.php';
        case 'blog-detail':
            return $viewPath . 'blog/blog-detail.php';
        
        case '':
        case '/':
        case 'home':
        default:
            return $viewPath . 'landing.php';
    }
}