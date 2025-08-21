<?php
// slider.php

// Define your slides data (you could load this from DB or API)
$images = [
    [
        "url" => "assets/img/best.jpg",
        "alt" => "Slide 1",
        "texts" => [
            ["content" => "Passion of Winning a Trade", "size" => "small"],
            ["content" => "Arts Of Finance", "size" => "large"],
            ["content" => "Share Market Classes", "size" => "small"]
        ]
    ],
    [
        "url" => "assets/img/sebi.jpg",
        "alt" => "Slide 2",
        "texts" => [
            ["content" => "Honored by Ms. Madhabi Puri Buch Chairperson, SEBI", "size" => "large"],
            ["content" => "I was deeply honored to be recognized by the current SEBI Chairperson for my contributions to the financial industry.", "size" => "small"]
        ]
    ],
    [
        "url" => "assets/img/nism.jpg",
        "alt" => "Slide 3",
        "texts" => [
            ["content" => "Our Mentor is SEBI Registered", "size" => "large"],
            ["content" => "Guiding you with expertise and trust for a secure financial future.", "size" => "small"]
        ]
    ]
];
?>

<style>
.slider-container {
    width: 100%;
    position: relative;
    overflow: hidden;
    touch-action: pan-y pinch-zoom;
}

.slider {
    display: flex;
    transition: transform 0.5s ease-in-out;
    cursor: grab;
}

.slider:active {
    cursor: grabbing;
    transition: none;
}

.slide {
    min-width: 100%;
    position: relative;

    padding-bottom: 56.25%;
    user-select: none;

    overflow: hidden;

}

@media (min-width: 1024px) {
    .slide {
        height: 550px;
        /* Or any fixed height you prefer for laptops/desktops */
        padding-bottom: 0;
        /* Disable padding-based aspect ratio */
    }
}

/* .slide img {
        width: 100%;
        height: auto;
        object-fit: cover;
        background: #f0f0f0;
        pointer-events: none;
        position: absolute;
    } */
.slide img {
    width: 100%;
    height: -webkit-fill-available;
    object-fit: fill;
    background: #f0f0f0;
    pointer-events: none;
    position: absolute;
}


.slide-content {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    flex-direction: column;
    padding: 40px;
    color: white;
    justify-content:flex-end;

}

.text-container {
    margin: auto 0 0 0;
    padding: 20px;
}

.slide:first-child .slide-content {
    justify-content: center;
}

.slide:first-child .text-container {
    margin: 0;
    text-align: left;
}

.slide:first-child .text-large {
    font-size: clamp(2.5rem, 6vw, 8rem);
    font-weight: 800;
    text-transform: uppercase;
    font-family: Georgia;
    letter-spacing: 2px;
    margin-bottom: 0.3em;
    line-height: 1.1;
}

.text-large {
    font-size: clamp(1.5rem, 4vw, 2.5rem);
    font-weight: bold;
    margin-bottom: 0.5em;
    line-height: 1.2;
}

.text-small {
    font-size: clamp(0.875rem, 2vw, 1.2rem);
    line-height: 1.5;
    margin-bottom: 0.5em;
}

.slider-controls {
    position: absolute;
    bottom: 20px;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: 8px;
    z-index: 2;
}

.dot-indicator {
    width: 8px;
    height: 8px;
    background: rgba(255, 255, 255, 0.5);
    border: none;
    border-radius: 4px;
    padding: 0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.dot-indicator.active {
    width: 24px;
    background: white;
}

.arrow-button {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    transition: background 0.3s;
    z-index: 2;
}

.arrow-button:hover {
    background: rgba(0, 0, 0, 0.7);
}

.arrow-button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.arrow-button.prev {
    left: 20px;
}

.arrow-button.next {
    right: 20px;
}

@media (max-width: 640px) {
    .slide-content {
        padding: 30px 15px;
    }

    .arrow-button {
        width: 32px;
        height: 32px;
        font-size: 18px;
    }

    .arrow-button.prev {
        left: 10px;
    }

    .arrow-button.next {
        right: 10px;
    }
}
</style>


<div class="slider-container">
    <button class="arrow-button prev" onclick="prevSlide()">←</button>
    <button class="arrow-button next" onclick="nextSlide()">→</button>

    <div class="slider" id="slider">
        <?php foreach ($images as $image): ?>
        <div class="slide">
            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" draggable="false">
            <div class="slide-content">
                <?php foreach ($image['texts'] as $text): ?>
                <div class="<?= $text['size'] === 'large' ? 'text-large' : 'text-small' ?>">
                    <?= $text['content'] ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="slider-controls">
        <?php foreach ($images as $i => $image): ?>
        <button class="dot-indicator" onclick="goToSlide(<?= $i ?>)" id="dot-<?= $i ?>"></button>
        <?php endforeach; ?>
    </div>
</div>

<script>
let currentIndex = 0;
const slider = document.getElementById("slider");
const totalSlides = <?= count($images) ?>;

function updateSlider() {
    slider.style.transform = `translateX(${-currentIndex * 100}%)`;
    for (let i = 0; i < totalSlides; i++) {
        document.getElementById("dot-" + i).classList.remove("active");
    }
    document.getElementById("dot-" + currentIndex).classList.add("active");
}

function prevSlide() {
    currentIndex = currentIndex > 0 ? currentIndex - 1 : totalSlides - 1;
    updateSlider();
}

function nextSlide() {
    currentIndex = currentIndex < totalSlides - 1 ? currentIndex + 1 : 0;
    updateSlider();
}

function goToSlide(index) {
    currentIndex = index;
    updateSlider();
}

// Auto slide (every 2 min like Angular version)
setInterval(nextSlide, 120000);

// Initialize
updateSlider();
</script>