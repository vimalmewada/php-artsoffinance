<?php
// Team data array (replacing the Angular component data)
$teamMembers = [
    [
        'id' => 1,
        'name' => 'Chitresh Goswami',
        'position' => 'Management Trainee - Surveillance And Investigation Department, Multi Commodity Exchange,',
        'imageSrc' => 'assets/img/guest1.jpg',
        'detailsLink' => 'team-details.html'
    ],
    [
        'id' => 2,
        'name' => 'Nagendra Patra',
        'position' => 'Assistant Manager - Market Risk, IDBI Bank',
        'imageSrc' => 'assets/img/guest2.jpg',
        'detailsLink' => 'team-details.html'
    ],
    [
        'id' => 3,
        'name' => 'Gaurav Mishra',
        'position' => 'Inspection offsite work in NSE INDIA',
        'imageSrc' => 'assets/img/guest3.jpeg',
        'detailsLink' => 'team-details.html'
    ],
    [
        'id' => 4,
        'name' => 'Abhishek Jajoo',
        'position' => 'Management Trainee - Surveillance And Investigation Department, Multi Commodity Exchange, Ex-Treasury Dealer in ICICI Bank,',
        'imageSrc' => 'assets/img/guest4.jpg',
        'detailsLink' => 'team-details.html'
    ],
    [
        'id' => 5,
        'name' => 'Chetan Singh Bisht',
        'position' => 'Management Trainee - MCXCCL (Spot, Delivery and Warehousing Operations)',
        'imageSrc' => 'assets/img/guest5.jpg',
        'detailsLink' => 'team-details.html'
    ]
];
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area bg_image" style="background-image: url('assets/img/team.jpg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">Our Mentors</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="/home">Home</a>
                        <span> / </span>
                        <a href="/teachers" class="active">Our Mentor</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->


    <?php include('views/partials/mentor.php') ?>

    <!-- team area start-->
    <section class="portfolio-area style-4 pt--120 pb--120 pt_xs--60 pt_xs--60">
        <div class="container">
            <div class="row mb--30">
                <div class="col-12">
                    <div class="rts-title-area gallery text-start">
                        <p class="pre-title">
                            Our Guest
                        </p>
                        <h2 class="title">Meet Our Guest Faculties And Our Corporate Connections
                        </h2>
                    </div>
                </div>
            </div>
        
            <div class="row g-5">
                <!-- team single items -->
                <?php foreach ($teamMembers as $teamMember): ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="team-single-one-start">
                        <div class="team-image-area">
                            <a href="<?php echo $teamMember['detailsLink']; ?>">
                                <img src="<?php echo $teamMember['imageSrc']; ?>" alt="<?php echo $teamMember['name']; ?>">
                                <div class="team-social">
                                    <div class="main">
                                        <i class="fal fa-plus"></i>
                                    </div>
                                    <div class="team-social-one">
                                        <i class="fab fa-youtube"></i>
                                        <i class="fab fa-pinterest-p"></i>
                                        <i class="fab fa-instagram"></i>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="single-details">
                            <a href="<?php echo $teamMember['detailsLink']; ?>">
                                <h5 class="title"><?php echo $teamMember['name']; ?></h5>
                            </a>
                            <p><?php echo $teamMember['position']; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- team single end -->
            </div>
        </div>
    </section>
    <!-- team single end -->