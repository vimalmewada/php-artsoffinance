<?php
// Get the section name from URL parameter
require_once '../public/data/course-data.php';
$sectionName = isset($_GET['sectionName']) ? $_GET['sectionName'] : '';

// Get courses for the section
$COURSE_LIST_BY_SECTION = CoursesData::getCourseBySection($sectionName);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo strtoupper($sectionName); ?> COURSE</title>
    <!-- Add your CSS links here -->
</head>
<body>
    <app-nav-bar></app-nav-bar>
    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title"><?php echo strtoupper($sectionName); ?> COURSE</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="index.html">Home</a>
                        <span> / </span>
                        <a href="#" class="active"><?php echo strtoupper($sectionName); ?> </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- our service area start -->
    <div class="rts-service-area rts-section-gapTop pb--200 service-two-bg bg_image">
        <div class="container">
            <div class="row g-5 service padding-controler">
                <!-- single service area -->
                <?php foreach ($COURSE_LIST_BY_SECTION as $i => $course): ?>
                <div class="col-xl-4 col-md-6 col-sm-12 col-12 pb--140 pb_md--100">
                    <div class="service-two-inner">
                        <a href="/course-view?sectionName=<?php echo $sectionName; ?>&id=<?php echo $course['id']; ?>" class="thumbnail thumbnail-<?php echo $i + 1; ?>">
                            <img src="<?php echo $course['serviceDetails']['thumbnailSrc']; ?>" alt="Business_image">
                        </a>
                        <div class="body-content">
                            <div class="hidden-area">
                                <a href="/course-view?sectionName=<?php echo $sectionName; ?>&id=<?php echo $course['id']; ?>">
                                    <h5 class="title"><?php echo $course['headline']; ?></h5>
                                </a>
                                <p class="dsic">
                                    <?php 
                                    $description = $course['serviceDetails']['description'];
                                    $words = explode(' ', $description);
                                    $shortDescription = implode(' ', array_slice($words, 0, 10));
                                    echo $shortDescription;
                                    ?>
                                </p>
                                <a class="rts-read-more-two color-primary" href="/course-view/sectionName=<?php echo $sectionName; ?>&id=<?php echo $course['id']; ?>">
                                    Read More<i class="far fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- single service area end-->
            </div>
        </div>
    </div>

    <!-- Add your JavaScript links here -->
</body>
</html>