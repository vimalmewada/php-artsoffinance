<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback Carousel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Jost', sans-serif;
    }

    /* body {
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
    } */

    .rts-client-feedback {
        padding: 80px 0;
        background: #fff;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -15px;
    }

    .col-lg-7 {
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
        padding: 0 15px;
        position: relative;
    }

    .col-lg-5 {
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
        padding: 0 15px;
    }

    .pl--30 {
        padding-left: 30px;
    }

    .pt--70 {
        padding-top: 70px;
    }

    /* .pre-title {
            color: #4a6cf7;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 40px;
            color: #1d2a3a;
            line-height: 1.2;
        } */

    .swiper {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .swiper-wrapper {
        position: relative;
        overflow: hidden;
        height: 100%;
    }

    .swiper-slide {
        display: none;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .swiper-slide.active {
        display: block;
        opacity: 1;
    }

    .testimonial-inner {
        background: #fff;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 5px 30px rgba(0, 0, 0, 0.07);
        position: relative;
    }

    .disc {
        font-size: 18px;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
        font-style: italic;
    }

    .testimonial-bottom-one {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 20px;
    }

    .reviewer-info {
        display: flex;
        align-items: center;
    }

    .thumbnailReview {
        margin-right: 20px;
    }

    .thumbnailReview img {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #4a6cf7;
    }

    /* .details h5 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1d2a3a;
        }
        
        .details span {
            color: #4a6cf7;
            font-weight: 500;
        } */

    /* .navigation-buttons {
            display: flex;
            gap: 15px;
        }
        
        .swiper-button-next, 
        .swiper-button-prev {
            position: relative;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #d6a40e;
            color: white;
            box-shadow: 0 4px 15px rgba(214, 164, 14, 0.4);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 10;
            bottom: auto;
            top: auto;
            left: auto;
            right: auto;
            margin: 0;
        }
        
     
        
        .swiper-button-next i, 
        .swiper-button-prev i {
            font-size: 20px;
            font-weight: bold;
        } */

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: #c4950c;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(214, 164, 14, 0.6);
    }

    /* .rts-test-one-image-inner {
            text-align: center;
        }
        
        .rts-test-one-image-inner img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        } */

    @media (max-width: 991px) {

        .col-lg-7,
        .col-lg-5 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .pl--30 {
            padding-left: 15px;
        }

        .pt--70 {
            padding-top: 50px;
        }

        /* .title {
                font-size: 32px;
            } */
    }

    @media (max-width: 767px) {
        /* .title {
                font-size: 28px;
            } */

        .disc {
            font-size: 16px;
        }

        .thumbnailReview img {
            width: 60px;
            height: 60px;
        }

        .details h5 {
            font-size: 18px;
        }

        .testimonial-bottom-one {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }

        .navigation-buttons {
            align-self: flex-end;
        }

        .swiper-button-next,
        .swiper-button-prev {
            width: 45px;
            height: 45px;
        }
    }
    </style>
</head>

<body>
    <!-- start client feed back section -->
    <div class="rts-client-feedback">
        <div class="container">
            <div class="row">
                <!-- start testimonials area -->
                <div class="col-lg-7">
                    <div class="rts-title-area reviews text-start pl--30 pt--70">
                        <p class="pre-title">
                            Our Testimonials
                        </p>
                        <h2 class="title">Student's Feedbacks</h2>

                        <!-- swiper area start -->
                        <div class="swiper mySwipertestimonial">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide active">
                                    <div class="testimonial-inner">
                                        <p class="disc text-start">
                                            "The academy is excellent if you're new to trading and want to learn more
                                            about how to make investing in your hands. This facility and its staff are
                                            top-notch."
                                        </p>
                                        <div class="testimonial-bottom-one">
                                            <div class="reviewer-info">
                                                <div class="thumbnailReview">
                                                    <img src="https://ui-avatars.com/api/?name=Krapal&background=4a6cf7&color=fff"
                                                        alt="Krapal">
                                                </div>
                                                <div class="details">
                                                    <h5 class="title">Krapal</h5>
                                                    <span>Option-Trading</span>
                                                </div>
                                            </div>
                                            <div class="navigation-buttons">
                                                <div class="swiper-button-prev">
                                                    <!-- <i class="fas fa-arrow-left"></i> -->
                                                </div>
                                                <div class="swiper-button-next">
                                                    <!-- <i class="fas fa-arrow-right"></i> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-inner">
                                        <p class="disc text-start">
                                            "I am a beginner and this course turned out to be an excellent source for
                                            me. The instructor did an amazing job to keep me engaged throughout."
                                        </p>
                                        <div class="testimonial-bottom-one">
                                            <div class="reviewer-info">
                                                <div class="thumbnailReview">
                                                    <img src="https://ui-avatars.com/api/?name=Ashwin&background=4a6cf7&color=fff"
                                                        alt="Ashwin">
                                                </div>
                                                <div class="details">
                                                    <h5 class="title">Ashwin Bagoria</h5>
                                                    <span>Technical Analyst</span>
                                                </div>
                                            </div>
                                            <div class="navigation-buttons">
                                                <div class="swiper-button-prev">
                                                    <!-- <i class="fas fa-arrow-left"></i> -->
                                                </div>
                                                <div class="swiper-button-next">
                                                    <!-- <i class="fas fa-arrow-right"></i> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="testimonial-inner">
                                        <p class="disc text-start">
                                            "Great Team, and Teachers with re-takes which for me have been a great tool
                                            to become a successful trader."
                                        </p>
                                        <div class="testimonial-bottom-one">
                                            <div class="reviewer-info">
                                                <div class="thumbnailReview">
                                                    <img src="https://ui-avatars.com/api/?name=Ankit&background=4a6cf7&color=fff"
                                                        alt="Ankit">
                                                </div>
                                                <div class="details">
                                                    <h5 class="title">Ankit Vishwakarma</h5>
                                                    <span>Founder, CreativeCo</span>
                                                </div>
                                            </div>
                                            <div class="navigation-buttons">
                                                <div class="swiper-button-prev">
                                                    <!-- <i class="fas fa-arrow-left"></i> -->
                                                </div>
                                                <div class="swiper-button-next">
                                                    <!-- <i class="fas fa-arrow-right"></i> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- swiper area end -->
                    </div>
                </div>
                <!-- end testimonials area -->
                <!-- images area -->
                <div class="col-lg-5">
                    <div class="rts-test-one-image-inner">
                        <img src="assets/images/testimonials/01.png" alt="Students learning">
                    </div>
                </div>
                <!-- image area end -->
            </div>
        </div>
    </div>
    <!-- start client feed back section End -->

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.swiper-slide');
        const prevButtons = document.querySelectorAll('.swiper-button-prev');
        const nextButtons = document.querySelectorAll('.swiper-button-next');
        let currentSlide = 0;

        // Function to show a specific slide
        function showSlide(index) {
            // Hide all slides
            slides.forEach(slide => {
                slide.classList.remove('active');
            });

            // Show the selected slide
            slides[index].classList.add('active');
            currentSlide = index;
        }

        // Next slide function
        function nextSlide() {
            let nextIndex = (currentSlide + 1) % slides.length;
            showSlide(nextIndex);
        }

        // Previous slide function
        function prevSlide() {
            let prevIndex = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(prevIndex);
        }

        // Add event listeners to buttons
        prevButtons.forEach(button => {
            button.addEventListener('click', prevSlide);
        });

        nextButtons.forEach(button => {
            button.addEventListener('click', nextSlide);
        });

        // Auto-advance slides every 5 seconds
        let autoAdvance = setInterval(nextSlide, 5000);

        // Pause auto-advance when user hovers over the carousel
        const swiper = document.querySelector('.swiper');
        swiper.addEventListener('mouseenter', function() {
            clearInterval(autoAdvance);
        });

        swiper.addEventListener('mouseleave', function() {
            autoAdvance = setInterval(nextSlide, 5000);
        });
    });
    </script>
</body>

</html>