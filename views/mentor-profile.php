<?php
// mentor-profile.php
include 'public/data/mentor-data.php'; // Include the data file

// Get the mentor ID from the URL parameter
$mentorId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Find the mentor with the matching ID
$mentor = null;
foreach ($mentorList as $m) {
    if ($m['id'] === $mentorId) {
        $mentor = $m;
        break;
    }
}

// If no mentor found, redirect to the main page or show an error
if (!$mentor) {
    header("Location: mentors.php");
    exit();
}
?>

  <div class="rts-breadcrumb-area bg_image" style="background-image: url('assets/img/stock10.jpg')">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title"><?php echo $mentor['name']; ?> <br>profile</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="/home">Home</a>
                        <span> / </span>
                        <a href="#" class="active"><?php echo $mentor['name']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts-team details area Start-->
    <div class="rts-team-details rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class="details-thumb">
                        <img src="<?php echo $mentor['img']; ?>" alt="<?php echo $mentor['name']; ?>">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 pl--35 pl_sm--15">
                    <div class="details-right-inner">
                        <div class="title-area">
                            <span class="pre-title">
                                <?php echo $mentor['position']; ?>
                            </span>
                            <h3 class="title"><?php echo $mentor['name']; ?></h3>
                        </div>
                        <p class="disc">
                            <?php echo $mentor['description']; ?>
                        </p>
                        <div class="left-area single-wized">
                            <h5 class="title" style="position: relative; margin-top: 2px; display: inline-block;">Key Skills
                                <span style="position: absolute; bottom: -2px; left: -2px; width: calc(100% + 4px); height: 2px; background-color: orange;"></span>
                            </h5>
                            <div class="details">
                                <ul class="key-skills-list">
                                    <?php foreach ($mentor['keySkills'] as $skill): ?>
                                    <li style="font-size: 18px; color: #333; margin-bottom: 8px; position: relative; padding-left: 25px; font-family: Arial, sans-serif;">
                                        <?php echo $skill; ?>
                                        <span style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 8px; height: 8px; background-color: orange; border-radius: 50%;"></span>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- rts-team details area ENd -->

    <!-- rts skills area end -->
    <section class="portfolio-area style-4 pb--120 pt_xs--60">
        <div class="container">
            <div class="row mb--5">
                <div class="col-12">
                    <div class="rts-title-area gallery text-start">
                        <p class="pre-title"></p>
                        <h2 class="title">Certificates</h2>
                    </div>
                </div>
            </div>

            <div class="tab-content-area mt_sm--30">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <!-- tab product area -->
                        <div class="row g-5">
                            <?php foreach ($mentor['certificates'] as $certificate): ?>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <!-- single -product area -->
                                <div class="rts-product-one">
                                    <div class="thumbnail-area">
                                        <img src="<?php echo $certificate['image']; ?>" alt="<?php echo $certificate['name']; ?>">
                                        <a class="rts-btn btn-primary rounded" href="<?php echo $certificate['pdfLocation']; ?>" target="_blank" rel="noopener noreferrer">
                                            <i class="far fa-arrow-right"></i>
                                        </a>
                                    </div>
                                    <div class="product-contact-wrapper">
                                        <a href="<?php echo $certificate['pdfLocation']; ?>" target="_blank" rel="noopener noreferrer">
                                            <h6 class="title"><?php echo $certificate['name']; ?></h6>
                                        </a>
                                    </div>
                                </div>
                                <!-- single -product area End -->
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>