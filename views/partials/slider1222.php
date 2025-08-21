<?php
// Slider data
$images = [
    [
        'url' => 'assets/img/best.jpg',
        'alt' => 'Slide 1',
        'texts' => [
            ['content' => 'Passion of Winning a Trade', 'size' => 'small'],
            ['content' => 'Arts Of Finance', 'size' => 'large'],
            ['content' => 'Share Market Classes', 'size' => 'small']
        ]
    ],
    [
        'url' => 'assets/img/sebi.jpg',
        'alt' => 'Slide 2',
        'texts' => [
            ['content' => 'Honored by Ms. Madhabi Puri Buch Chairperson, SEBI', 'size' => 'large'],
            ['content' => 'I was deeply honored to be recognized by the current SEBI Chairperson for my contributions to the financial industry.', 'size' => 'small']
        ]
    ],
    [
        'url' => 'assets/img/nism.jpg',
        'alt' => 'Slide 3',
        'texts' => [
            ['content' => 'Our Mentor is SEBI Registered', 'size' => 'large'],
            ['content' => 'Guiding you with expertise and trust for a secure financial future.', 'size' => 'small']
        ]
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Slider</title>
    <style>
        .slider-container {
            position: relative;
            max-width: 100%;
            overflow: hidden;
            margin: 0 auto;
        }

        .slider {
            display: flex;
            transition: transform 0.3s ease-out;
            will-change: transform;
        }

        .slide {
            flex: 0 0 100%;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: auto;
            display: block;
        }

        .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 20px;
        }

        .text-container {
            text-align: center;
        }

        .text-large {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .text-small {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .arrow-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 15px;
            cursor: pointer;
            z-index: 10;
            font-size: 24px;
        }

        .arrow-button:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .arrow-button.prev {
            left: 10px;
        }

        .arrow-button.next {
            right: 10px;
        }

        .slider-controls {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
            z-index: 10;
        }

        .dot-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            border: none;
            cursor: pointer;
        }

        .dot-indicator.active {
            background: white;
        }
    </style>
</head>
<body>
    <div class="slider-container">
        <button 
            class="arrow-button prev" 
            id="prevButton"
            aria-label="Previous slide"
        >
            ←
        </button>
        <button 
            class="arrow-button next" 
            id="nextButton"
            aria-label="Next slide"
        >
            →
        </button>
        <div class="slider" id="slider">
            <?php foreach ($images as $index => $image): ?>
                <div class="slide">
                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" draggable="false">
                    <div class="slide-content">
                        <div class="text-container">
                            <?php foreach ($image['texts'] as $text): ?>
                                <div class="<?php echo $text['size'] === 'large' ? 'text-large' : 'text-small'; ?>">
                                    <?php echo $text['content']; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="slider-controls">
            <?php foreach ($images as $index => $image): ?>
                <button 
                    class="dot-indicator"
                    data-index="<?php echo $index; ?>"
                    aria-label="Go to slide <?php echo $index + 1; ?>"
                ></button>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Elements
            const slider = document.getElementById('slider');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const dots = document.querySelectorAll('.dot-indicator');
            
            // State
            let currentIndex = 0;
            let isDragging = false;
            let startPos = 0;
            let currentTranslate = 0;
            let prevTranslate = 0;
            let autoSlideInterval;
            
            // Initialize
            updateButtons();
            startAutoSlide();
            
            // Event listeners
            prevButton.addEventListener('click', prevSlide);
            nextButton.addEventListener('click', nextSlide);
            
            dots.forEach(dot => {
                dot.addEventListener('click', function() {
                    goToSlide(parseInt(this.getAttribute('data-index')));
                });
            });
            
            // Touch/Mouse events
            slider.addEventListener('mousedown', startDrag);
            slider.addEventListener('touchstart', startDrag);
            
            slider.addEventListener('mousemove', onDrag);
            slider.addEventListener('touchmove', onDrag);
            
            slider.addEventListener('mouseup', endDrag);
            slider.addEventListener('touchend', endDrag);
            slider.addEventListener('mouseleave', endDrag);
            
            // Functions
            function updateButtons() {
                prevButton.disabled = currentIndex === 0;
                nextButton.disabled = currentIndex === <?php echo count($images) - 1; ?>;
                
                // Update dots
                dots.forEach((dot, index) => {
                    dot.classList.toggle('active', index === currentIndex);
                });
                
                // Update slider position
                slider.style.transform = `translateX(${-currentIndex * 100}%)`;
            }
            
            function startAutoSlide() {
                autoSlideInterval = setInterval(() => {
                    nextSlide();
                }, 5000); // Change slide every 5 seconds
            }
            
            function prevSlide() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateButtons();
                }
            }
            
            function nextSlide() {
                if (currentIndex < <?php echo count($images) - 1; ?>) {
                    currentIndex++;
                } else {
                    currentIndex = 0; // Loop back to the first slide
                }
                updateButtons();
            }
            
            function goToSlide(index) {
                currentIndex = index;
                updateButtons();
            }
            
            function startDrag(event) {
                if (event.type === 'touchstart') {
                    event.clientX = event.touches[0].clientX;
                }
                
                isDragging = true;
                startPos = event.clientX;
                prevTranslate = currentTranslate;
                
                // Stop auto sliding during drag
                clearInterval(autoSlideInterval);
            }
            
            function onDrag(event) {
                if (!isDragging) return;
                
                if (event.type === 'touchmove') {
                    event.clientX = event.touches[0].clientX;
                }
                
                const currentPosition = event.clientX;
                const diff = currentPosition - startPos;
                currentTranslate = prevTranslate + diff;
                
                // Apply temporary transform during drag
                slider.style.transform = `translateX(calc(${-currentIndex * 100}% + ${currentTranslate}px))`;
            }
            
            function endDrag() {
                if (!isDragging) return;
                
                isDragging = false;
                const movedBy = currentTranslate - prevTranslate;
                
                // If moved more than 100px, change slide
                if (Math.abs(movedBy) > 100) {
                    if (movedBy < 0 && currentIndex < <?php echo count($images) - 1; ?>) {
                        nextSlide();
                    } else if (movedBy > 0 && currentIndex > 0) {
                        prevSlide();
                    }
                }
                
                // Reset temporary transform
                slider.style.transform = `translateX(${-currentIndex * 100}%)`;
                
                // Resume auto sliding
                startAutoSlide();
                
                currentTranslate = 0;
                prevTranslate = 0;
            }
        });
    </script>
</body>
</html>