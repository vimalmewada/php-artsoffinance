<?php
// gallery.php
$selectedFilter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
$previewImage = null;
$currentSection = null;
$currentImageIndex = -1;

// Define gallery data
$gallerySections = [
    [
        "title" => "Mentor's Certification",
        "images" => [
            ["url" => 'assets/img/Mentordocument/certificate1.jpeg', "caption" => 'nism'],
            ["url" => 'assets/img/Mentordocument/certificate2.jpeg', "caption" => 'nism'],
            ["url" => 'assets/img/Mentordocument/lokendra_nism2.png', "caption" => 'nism'],
            ["url" => 'assets/img/Mentordocument/certificatet.jpg', "caption" => 'nism'],
        ]
    ],
    [
        "title" => 'Events & Activities',
        "images" => [
            ["url" => 'assets/img/event/pachmari/pachmari_1.jpeg', "caption" => 'pachmarhi tour'],
            ["url" => 'assets/img/event/pachmari/pachmari_2.jpeg', "caption" => 'pachmarhi tour'],
            ["url" => 'assets/img/event/event-anniversary/event_3.jpeg', "caption" => 'Investor Awareness Program'],
            ["url" => 'assets/img/event/event-anniversary/event_4.jpeg', "caption" => 'Investor Awareness Program'],
            ["url" => 'assets/img/event/event-anniversary/event_1.jpeg', "caption" => 'Birthday Celebration'],
            ["url" => 'assets/img/event/event-anniversary/event_2.jpg', "caption" => 'Artsoffinance anniversary'],
        ]
    ],
    [
        "title" => 'Classroom',
        "images" => [
            ["url" => 'assets/img/classroom/class_1.jpeg', "caption" => 'Classroom'],
            ["url" => 'assets/img/classroom/class_2.jpeg', "caption" => 'Classroom'],
            ["url" => 'assets/img/classroom/class_3.jpeg', "caption" => 'Classroom'],
            ["url" => 'assets/img/classroom/class_4.jpeg', "caption" => 'Classroom'],
            ["url" => 'assets/img/classroom/class_5.jpeg', "caption" => 'Classroom'],
            ["url" => 'assets/img/classroom/class_6.jpeg', "caption" => 'Classroom'],
        ]
    ]
];

// Filter sections based on selection
$filteredSections = [];
if ($selectedFilter === 'all') {
    $filteredSections = $gallerySections;
} else {
    foreach ($gallerySections as $section) {
        if ($section['title'] === $selectedFilter) {
            $filteredSections[] = $section;
        }
    }
}

// Handle image preview
if (isset($_GET['preview'])) {
    $previewData = explode(':', $_GET['preview']);
    if (count($previewData) === 2) {
        $sectionTitle = urldecode($previewData[0]);
        $imageIndex = intval($previewData[1]);
        
        foreach ($gallerySections as $section) {
            if ($section['title'] === $sectionTitle && isset($section['images'][$imageIndex])) {
                $currentSection = $section;
                $previewImage = $section['images'][$imageIndex];
                $currentImageIndex = $imageIndex;
                break;
            }
        }
    }
}

// Helper functions for navigation
function hasPrevious($section, $index) {
    return $section !== null && $index > 0;
}

function hasNext($section, $index) {
    return $section !== null && $index < count($section['images']) - 1;
}

function getPreviousUrl($section, $index) {
    if (hasPrevious($section, $index)) {
        return "gallery?filter=" . urlencode($_GET['filter']) . 
               "&preview=" . urlencode($section['title']) . ":" . ($index - 1);
    }
    return "#";
}

function getNextUrl($section, $index) {
    if (hasNext($section, $index)) {
        return "gallery?filter=" . urlencode($_GET['filter']) . 
               "&preview=" . urlencode($section['title']) . ":" . ($index + 1);
    }
    return "#";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Gallery</title>
    <style>
        .gallery-container {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .gallery-title {
            text-align: center;
            color: #2c3e50;
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 3rem;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .filter-button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 25px;
            background: #f0f2f5;
            color: #2c3e50;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .filter-button:hover {
            background: #e2e8f0;
            transform: translateY(-2px);
        }

        .filter-button.active {
            background: #f8aa0fff;
            color: white;
        }

        .gallery-section {
            margin-bottom: 3rem;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .section-title {
            color: #34495e;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .image-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .image-card:hover {
            transform: translateY(-5px);
        }

        .gallery-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
        }

        .image-caption {
            padding: 1rem;
            margin: 0;
            text-align: center;
            color: #2c3e50;
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .no-results p {
            color: #2c3e50;
            font-size: 1.2rem;
            margin: 0;
        }

        /* Preview Modal Styles */
        .preview-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            animation: fadeIn 0.3s ease-out;
        }

        .modal-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .preview-content {
            position: relative;
            max-width: 90%;
            max-height: 90vh;
            display: flex;
            align-items: center;
        }

        .preview-image-container {
            position: relative;
            background: white;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
        }

        .preview-image {
            max-height: 80vh;
            max-width: 100%;
            object-fit: contain;
            border-radius: 4px;
        }

        .preview-caption {
            color: #2c3e50;
            font-size: 1.2rem;
            margin: 1rem 0 0.5rem;
        }

        .preview-section {
            color: #7f8c8d;
            font-size: 1rem;
            margin: 0;
        }

        .close-button {
            position: fixed;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            color: white;
            font-size: 2rem;
            cursor: pointer;
            padding: 0.5rem;
            line-height: 1;
            z-index: 1010;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .close-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .nav-button {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: white;
            font-size: 3rem;
            padding: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
            margin: 0 1rem;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .nav-button:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .prev {
            left: 0;
        }

        .next {
            right: 0;
        }

        @media (max-width: 768px) {
            .filter-container {
                padding: 0.5rem;
            }

            .filter-button {
                padding: 0.6rem 1rem;
                font-size: 0.8rem;
            }

            .preview-content {
                max-width: 95%;
            }

            .nav-button {
                font-size: 2rem;
                width: 40px;
                height: 40px;
                margin: 0 0.5rem;
            }

            .close-button {
                top: 0.5rem;
                right: 0.5rem;
            }

            .modal-wrapper {
                padding: 1rem;
            }
        }
        
        .rts-client-area.ptb--100.client-bg {
            padding: 100px 0;
            background-color: #f9f9f9;
        }
        
        .title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
        }
        
        .client-two-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 5px;
        }
        
        .btn-white {
            background-color: white;
            color: #333;
            border: 1px solid #ddd;
        }
        
    </style>
</head>
<body>
    <div class="rts-client-area ptb--100 client-bg">
        <div class="container">
            <div class="row">
                <h4 class="title">Campus Gallery</h4>
                <div class="col-12">
                    <div class="client-two-wrapper">
                        <a href="gallery?filter=all" class="filter-button rts-btn <?php echo $selectedFilter === 'all' ? 'btn-white active' : 'btn-white'; ?>">
                            All
                        </a>

                        <?php foreach ($gallerySections as $section): ?>
                            <a href="gallery?filter=<?php echo urlencode($section['title']); ?>" class="filter-button rts-btn <?php echo $selectedFilter === $section['title'] ? 'btn-white active' : 'btn-white'; ?>">
                                <?php echo htmlspecialchars($section['title']); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="gallery-container">
        <?php if (count($filteredSections) > 0): ?>
            <?php foreach ($filteredSections as $section): ?>
                <div class="gallery-section">
                    <h3 class="section-title"><?php echo htmlspecialchars($section['title']); ?></h3>
                    <div class="image-grid">
                        <?php foreach ($section['images'] as $index => $image): ?>
                            <div class="image-card">
                                <a href="gallery?filter=<?php echo urlencode($selectedFilter); ?>&preview=<?php echo urlencode($section['title']) . ':' . $index; ?>">
                                    <img src="<?php echo htmlspecialchars($image['url']); ?>" alt="<?php echo htmlspecialchars($image['caption']); ?>" class="gallery-image">
                                </a>
                                <p class="image-caption"><?php echo htmlspecialchars($image['caption']); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results">
                <p>No images found for the selected category.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($previewImage): ?>
        <!-- Image Preview Modal -->
        <div class="preview-modal">
            <div class="modal-wrapper">
                <a href="gallery?filter=<?php echo urlencode($selectedFilter); ?>" class="close-button">×</a>

                <?php if (hasPrevious($currentSection, $currentImageIndex)): ?>
                    <a href="<?php echo getPreviousUrl($currentSection, $currentImageIndex); ?>" class="nav-button prev">‹</a>
                <?php endif; ?>

                <div class="preview-content">
                    <div class="preview-image-container">
                        <img src="<?php echo htmlspecialchars($previewImage['url']); ?>" alt="<?php echo htmlspecialchars($previewImage['caption']); ?>" class="preview-image">
                        <p class="preview-caption"><?php echo htmlspecialchars($previewImage['caption']); ?></p>
                        <p class="preview-section"><?php echo htmlspecialchars($currentSection['title']); ?></p>
                    </div>
                </div>

                <?php if (hasNext($currentSection, $currentImageIndex)): ?>
                    <a href="<?php echo getNextUrl($currentSection, $currentImageIndex); ?>" class="nav-button next">›</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</body>
</html>