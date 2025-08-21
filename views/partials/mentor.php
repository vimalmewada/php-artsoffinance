  <?php include('../public/data/mentor-data.php'); ?>
  <section class="portfolio-area style-4 pt--120 pt_xs--60">
        <div class="container">
            <div class="row mb--30" style="justify-content: center;">
                <div class="col-12">
                    <div class="rts-title-area team text-center">
                        <p class="pre-title">
                            Our Team
                        </p>
                        <h2 class="title">Meet Our Mentor</h2>
                    </div>
                </div>
            </div>
            <div class="row g-5" style="justify-content: center;">
                <?php foreach ($mentorList as $mentor): ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="team-single-one-start">
                      <div class="team-image-area">
                        <a href="mentor-profile?id=<?php echo $mentor['id']; ?>">
                          <img src="<?php echo $mentor['img']; ?>" alt="<?php echo $mentor['name']; ?>">
                        </a>
                      </div>
                      <div class="single-details">
                        <a href="mentor-profile?id=<?php echo $mentor['id']; ?>">
                          <h5 class="title"><?php echo $mentor['name']; ?></h5>
                        </a>
                        <p><?php echo $mentor['position']; ?></p>
                      </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>