<?php
require_once '../public/data/blog-data.php';

// Create instance
$blogData = new BlogData();

// Check if category is passed in query string
if (isset($_GET['category']) && !empty($_GET['category'])) {
    $category = $_GET['category'];
    $blogs = $blogData->getBlogByCategory($category);
} else {
    $blogs = $blogData->getBlogList(); // Default all blogs
}

// Other sidebar data
$categories = $blogData->getAllCategories();
$lastestBlog = $blogData->getLatestBlogs(3); 
$galleryImages = $blogData->getRecentPostImages(6);
$allTags = $blogData->getAllTags();
?>

    <!-- start breadcrumb area -->
    <div class="rts-breadcrumb-area breadcrumb-bg bg_image">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                    <h1 class="title">Latest Blogs</h1>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="bread-tag">
                        <a href="index.html">Home</a>
                        <span> / </span>
                        <a class="active">Latest Blogs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end breadcrumb area -->

    <!-- rts blog grid area -->
    <div class="rts-blog-grid-area rts-section-gap">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-8 col-md-12 col-sm-12 col-12 pr--40 pr_md--0 pr_sm-controler--0">
                    <div class="row g-5">
                        <?php foreach ($blogs as $blog): ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <!-- start blog grid inner -->
                            <div class="blog-grid-inner">
                                <div class="blog-header">
                                    <a class="thumbnail" href="blog-detail?id=<?php echo $blog['id']; ?>">
                                        <img src="<?php echo $blog['featuredImage']; ?>" alt="Business_Blog">
                                    </a>
                                    <div class="blog-info">
                                        <div class="user">
                                            <i class="fal fa-user-circle"></i>
                                            <span> <?php echo $blog['author']['name']; ?></span>
                                        </div>
                                        <div class="user">
                                            <i class="fal fa-tags"></i>
                                            <span><?php echo $blog['categories'][0]; ?></span>
                                        </div>
                                    </div>
                                    <div class="date">
                                        <?php
                                        $publishDate = new DateTime($blog['publishDate']);
                                        $day = $publishDate->format('d');
                                        $month = $publishDate->format('M');
                                        ?>
                                        <h6 class="title"><?php echo $day; ?></h6>
                                        <span><?php echo $month; ?></span>
                                    </div>
                                </div>
                                <div class="blog-body">
                                    <a href="blog-detail?id=<?php echo $blog['id']; ?>">
                                        <h5 class="title">
                                            <?php echo $blog['title']; ?>
                                        </h5>
                                    </a>
                                </div>
                            </div>
                            <!-- end blog grid inner -->
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <!--rts blog wized area -->
                <div class="col-xl-4 col-md-12 col-sm-12 col-12">
                    <!-- single wized start -->
                    <div class="rts-single-wized Categories">
                        <div class="wized-header">
                            <h5 class="title">
                                Categories
                            </h5>
                        </div>
                        <div class="wized-body">
                            <!-- single categoris -->
                            <?php foreach ($categories as $category): ?>
                            <ul class="single-categories">
                                <li><a href="blog?category=<?php echo urlencode($category); ?>"><?php echo $category; ?> <i class="far fa-long-arrow-right"></i></a></li>
                            </ul>
                            <?php endforeach; ?>
                            <!-- single categoris End -->
                        </div>
                    </div>
                    <!-- single wizered End -->
                    
                    <!-- single wizered start -->
                    <div class="rts-single-wized Recent-post">
                        <div class="wized-header">
                            <h5 class="title">
                                Recent Posts
                            </h5>
                        </div>
                        <div class="wized-body">
                            <!-- recent-post -->
                            <?php foreach ($lastestBlog as $blog): ?>
                            <div class="recent-post-single">
                                <div class="thumbnail">
                                    <a href="blog-detail?id=<?php echo $blog['id']; ?>">
                                        <img src="<?php echo $blog['featuredImage']; ?>" alt="Blog_post">
                                    </a>
                                </div>
                                <div class="content-area">
                                    <div class="user">
                                        <i class="fal fa-clock"></i>
                                        <span><?php echo date('d M, Y', strtotime($blog['publishDate'])); ?></span>
                                    </div>
                                    <a class="post-title" href="blog-detail?id=<?php echo $blog['id']; ?>">
                                        <h6 class="title"><?php echo substr($blog['title'], 0, 40); ?>...</h6>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <!-- recent-post End -->
                        </div>
                    </div>
                    <!-- single wized End -->
                    
                    <!-- single wized start -->
                    <div class="rts-single-wized Recent-post">
                        <div class="wized-header">
                            <h5 class="title">
                                Recent Posts Gallery
                            </h5>
                        </div>
                        <div class="wized-body">
                            <div class="gallery-inner">
                                <div class="row-1 single-row">
                                    <?php for ($i = 0; $i < 3 && $i < count($galleryImages); $i++): ?>
                                    <a><img src="<?php echo $galleryImages[$i]; ?>" alt="Gallery"></a>
                                    <?php endfor; ?>
                                </div>
                                <div class="row-2 single-row">
                                    <?php for ($i = 3; $i < 6 && $i < count($galleryImages); $i++): ?>
                                    <a><img src="<?php echo $galleryImages[$i]; ?>" alt="Gallery"></a>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- single wized End -->
                    
                    <!-- single wized start -->
                    <div class="rts-single-wized">
                        <div class="wized-header">
                            <h5 class="title">
                                Popular Tags
                            </h5>
                        </div>
                        <div class="wized-body">
                            <div class="tags-wrapper">
                                <?php 
                                $tagsToShow = array_slice($allTags, 0, 10);
                                foreach ($tagsToShow as $tag): 
                                ?>
                                <a><?php echo $tag; ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
