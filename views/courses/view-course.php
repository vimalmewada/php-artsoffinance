<?php
// Simulate course data - in a real application, this would come from a database
require_once '../public/data/course-data.php';
// Get course ID and section from URL parameters
$courseId = isset($_GET['id']) ? intval($_GET['id']) : null;
$sectionName = isset($_GET['sectionName']) ? $_GET['sectionName'] : null;

// Find the course
$course = null;
$course = CoursesData::getCourseBySectionAndId($sectionName,$courseId);


// If course not found, redirect or show error
if (!$course) {
    // header("Location: /courses");
    // exit();
    echo "Course not found!";
    exit();
}
?>

<!-- Navigation would be included here -->
<!-- <app-nav-bar></app-nav-bar> -->

<!-- start breadcrumb area -->
<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                <h1 class="title">Course Name: <?php echo htmlspecialchars($course['headline']); ?></h1>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="bread-tag">
                    <a href="index.html">Home</a>
                    <span> / </span>
                    <a href="#" class="active">
                        <?php 
                        $words = explode(' ', $course['headline']);
                        $shortTitle = implode(' ', array_slice($words, 0, 3));
                        echo htmlspecialchars($shortTitle) . '...';
                        ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb area -->

<!-- start service details area -->
<div class="rts-service-details-area rts-section-gap">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-md-12 col-sm-12 col-12">
                <!-- service details left area start -->
                <div class="service-detials-step-1">
                    <div class="thumbnail">
                        <img src="<?php echo htmlspecialchars($course['serviceDetails']['thumbnailSrc']); ?>" alt="course-pic">
                    </div>
                    <h4 class="title"><?php echo htmlspecialchars($course['headline']); ?></h4>
                    <p class="disc">
                        <?php echo htmlspecialchars($course['serviceDetails']['description']); ?>
                    </p>
                    <h6 class="title">About course</h6>
                    <p class="disc">
                        <?php 
                        if (isset($course['serviceDetails']['aboutCourse']['aboutCourse'])) {
                            echo htmlspecialchars($course['serviceDetails']['aboutCourse']['aboutCourse']);
                        } elseif (isset($course['serviceDetails']['aboutCourse']['content'])) {
                            echo htmlspecialchars($course['serviceDetails']['aboutCourse']['content']);
                        }
                        ?>
                    </p>
                    
                    <!-- faq accordion area -->
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="faq-two-inner">
                                <?php if (!empty($course['serviceDetails']['features'])): ?>
                                <h6 class="title">What Awaits Your Exploration:</h6>
                                <?php endif; ?>
                                <div class="faq-accordion-area" style="margin-top: 5px;">
                                    <div class="accordion" id="accordionExample">
                                        <?php foreach ($course['serviceDetails']['features'] as $i => $feature): ?>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="heading<?php echo $i; ?>">
                                                <button class="accordion-button" style="color: black;" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="false" aria-controls="collapse<?php echo $i; ?>">
                                                    <span><?php echo $i + 1; ?>.</span> <?php echo htmlspecialchars($feature['title']); ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $i; ?>" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <?php echo htmlspecialchars($feature['description']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>

                                        <?php if (isset($course['serviceDetails']['examDetails']) && !empty($course['serviceDetails']['examDetails'])): ?>
                                        <div>
                                            <?php foreach ($course['serviceDetails']['examDetails'] as $exam): ?>
                                            <div class="single-banifits">
                                                <i class="far fa-check-circle" style="color: orange; margin-right: 8px;"></i>
                                                <span><?php echo htmlspecialchars($exam['examCondition']); ?></span>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if (isset($course['serviceDetails']['courseOutline']) && !empty($course['serviceDetails']['courseOutline'])): ?>
                                        <div class="mt-4">
                                            <h6>Course Outline</h6>
                                            <ul style="padding-left: 20px; list-style-type: decimal; font-size: 16px; line-height: 1.6;">
                                                <?php foreach ($course['serviceDetails']['courseOutline'] as $i => $outline): ?>
                                                <li>
                                                    <span style="font-weight: bold; color: #FF6F00;"><?php echo $i + 1; ?>.</span> 
                                                    <?php echo htmlspecialchars($outline['topic']); ?>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if (isset($course['serviceDetails']['courseOffering'])): ?>
                                        <?php foreach ($course['serviceDetails']['courseOffering']['content'] as $content): ?>
                                        <div class="mt-4">
                                            <h6><?php echo htmlspecialchars($content['topic']); ?></h6>
                                            <ul style="padding-left: 20px; list-style-type: decimal; font-size: 16px; line-height: 1.6;">
                                                <?php foreach ($content['details'] as $i => $detail): ?>
                                                <li>
                                                    <span style="font-weight: bold; color: #FF6F00;"><?php echo $i + 1; ?>.</span> 
                                                    <?php echo htmlspecialchars($detail); ?>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- faq accordion area end -->
                    
                    <div class="row g-5 mt-4 mb-4">
                        <div class="col-lg-6">
                            <!-- single service details card -->
                            <div class="service-details-card">
                                <div class="thumbnail">
                                    <img src="assets/images/service/icon/09.svg" alt="" class="icon">
                                </div>
                                <div class="details">
                                    <h6 class="title">In-Depth Curriculum</h6>
                                    <p class="disc">Learn stock trading strategies and market analysis with expert guidance.</p>
                                </div>
                            </div>
                            <!-- single service details card End -->
                        </div>
                        <div class="col-lg-6">
                            <!-- single service details card -->
                            <div class="service-details-card">
                                <div class="thumbnail">
                                    <img src="assets/images/service/icon/10.svg" alt="" class="icon">
                                </div>
                                <div class="details">
                                    <h6 class="title">Live Mentorship Support</h6>
                                    <p class="disc">Get 24/7 mentorship from experienced traders to guide your learning.</p>
                                </div>
                            </div>
                            <!-- single service details card End -->
                        </div>
                        <div class="col-lg-6">
                            <!-- single service details card -->
                            <div class="service-details-card">
                                <div class="thumbnail">
                                    <img src="assets/images/service/icon/11.svg" alt="" class="icon">
                                </div>
                                <div class="details">
                                    <h6 class="title">Community & Networking</h6>
                                    <p class="disc">Join a vibrant community of traders for support and collaboration.</p>
                                </div>
                            </div>
                            <!-- single service details card End -->
                        </div>
                        <div class="col-lg-6">
                            <!-- single service details card -->
                            <div class="service-details-card">
                                <div class="thumbnail">
                                    <img src="assets/images/service/icon/12.svg" alt="" class="icon">
                                </div>
                                <div class="details">
                                    <h6 class="title">Flexible Learning Options</h6>
                                    <p class="disc">Choose between offline or online learning at your convenience.</p>
                                </div>
                            </div>
                            <!-- single service details card End -->
                        </div>
                    </div>
                    
                    <?php if (isset($course['serviceDetails']['howWeWork'])): ?>
                    <?php foreach ($course['serviceDetails']['howWeWork']['content'] as $content): ?>
                    <p class="disc">
                        <?php echo htmlspecialchars($content); ?>
                    </p>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="service-detials-step-2 mt-4">
                    <h4 class="title">3 Simple Steps to Process</h4>
                    
                    <!-- stem-area start -->
                    <div class="row mb-4 g-5">
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="single-service-step text-center">
                                <p class="step">01</p>
                                <h6 class="title">
                                    Book Your offline/online counselling with mentor.
                                </h6>
                                <p class="disc">
                                    Book a consultant fill the form and get free counseling session with our mentor
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="single-service-step text-center">
                                <p class="step">02</p>
                                <h6 class="title">
                                    Take a Demo class.
                                </h6>
                                <p class="disc">
                                    Before joining, you can get a free demo class to understand the course contains in details.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            <div class="single-service-step text-center">
                                <p class="step">03</p>
                                <h6 class="title">
                                    Complete Our Registration process.
                                </h6>
                                <p class="disc">
                                    Get our fee structure and installment options.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- stem-area End -->
                </div>
                <!-- service details left area end -->
                
                <div class="service-detials-step-3 mt-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="thumbnail sm-thumb-service">
                                <img src="assets/images/service/sm-01.jpg" alt="Service">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h4 class="title">Student Benefits</h4>
                            <p class="disc">Our mentorship program provides students with the tools and strategies needed to succeed in the share market. With personalized guidance, real-time market insights, and hands-on learning, students gain the confidence to navigate the trading world effectively.</p>
                            <div class="single-banifits">
                                <i class="far fa-check-circle"></i>
                                <span>Learn from SEBI Registered Mentors</span>
                            </div>
                            <div class="single-banifits">
                                <i class="far fa-check-circle"></i>
                                <span>Practical, Real-Time Trading Experience</span>
                            </div>
                            <div class="single-banifits">
                                <i class="far fa-check-circle"></i>
                                <span>Gain Confidence in Making Informed Decisions</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--rts blog wizered area -->
            <div class="col-xl-4 col-md-12 col-sm-12 col-12 mt-5 pl-lg-5">
                <!-- single wizered start -->
                <div class="rts-single-wized Categories service">
                    <div class="wized-header">
                        <h5 class="title">
                           Courses Categories 
                        </h5>
                    </div>
                    <div class="wized-body">
                        <!-- single categoris -->
                        <ul class="single-categories">
                            <li><a href="/courses-list?sectionName=basic">PHASE 1(basic)<i class="far fa-long-arrow-right"></i></a></li>
                        </ul>
                        <!-- single categoris End -->
                        <!-- single categoris -->
                        <ul class="single-categories">
                            <li><a href="/courses-list?sectionName=advance">PHASE 2 (advanced) <i class="far fa-long-arrow-right"></i></a></li>
                        </ul>
                        <!-- single categoris End -->
                        <!-- single categoris -->
                        <ul class="single-categories">
                            <li><a href="/courses-list?sectionName=placement">Placement Courses <i class="far fa-long-arrow-right"></i></a></li>
                        </ul>
                        <!-- single categoris End -->
                    </div>
                </div>
                <!-- single wizered End -->
                
                <!-- single wizered start -->
                <div class="rts-single-wized download service">
                    <div class="wized-header">
                        <h5 class="title">Download</h5>
                    </div>
                    <div class="wized-body">
                        <!-- single downlaod area start -->
                        <div class="single-download-area">
                            <img src="assets/images/service/icon/07.svg" alt="Business_downlaod">
                            <div class="mid">
                                <h6 class="title">
                                    Our Brochures
                                </h6>
                                <span>Download</span>
                            </div>
                            <a class="rts-btn btn-primary" href="assets/img/Artsoffinance-CourseBrochure.pdf" download><i class="fal fa-arrow-right"></i></a>
                        </div>
                        <!-- single downlaod area End -->
                    </div>
                </div>
                <!-- single wizered End -->
                
                <!-- single wizered start -->
                <div class="rts-single-wized contact service">
                    <div class="wized-header">
                        <a href="#"><img src="assets/img/logo1.png" alt="Business_logo"></a>
                    </div>
                    <div class="wized-body">
                        <h5 class="title">Need Help? We Are Here To Help You</h5>
                        <a class="rts-btn btn-primary" href="/contact">Contact Us</a>
                    </div>
                </div>
                <!-- single wizered End -->
            </div>
            <!-- rts- blog wizered end area -->
        </div>
    </div>
</div>
<!-- End service details area -->

  