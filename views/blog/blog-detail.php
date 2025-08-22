<?php
require_once 'public/data/blog-data.php';

class BlogDetailComponent {
    private $blogData;
    public $blogPost;
    public $blogId;
    public $allTags;
    public $galleryImages;
    public $categories;
    public $latestBlog;

    public function __construct() {
        $this->blogData = new BlogData();
    }

    public function ngOnInit() {
        if (isset($_GET['id'])) {
            $this->blogId = intval($_GET['id']);
        }
        
        if (!$this->blogId) {
            header("Location: blog.php");
            exit();
        }
        
        $this->loadAllData();
    }

    private function loadAllData() {
        $this->blogPost = $this->blogData->getBlogById($this->blogId);
        
        if (!$this->blogPost) {
            header("Location: blog.php");
            exit();
        }
        
        $this->allTags = $this->blogData->getAllTags();
        $this->galleryImages = $this->blogData->getRecentPostImages();
        $this->categories = $this->blogData->getAllCategories();
        $this->latestBlog = $this->blogData->getLatestBlogs();
    }

    public function renderContent($content) {
        $html = '';

        switch ($content['type']) {
            case 'paragraph':
                $class = isset($content['class']) ? $content['class'] : '';
                $text = $content['text'];
                // Convert markdown-style bold to HTML
                $text = preg_replace('/\*\*(.*?)\*\*/', '<strong>$1</strong>', $text);
                $html = '<p class="disc ' . htmlspecialchars($class) . '">' . nl2br(htmlspecialchars($text)) . '</p>';
                break;

            case 'quote':
                $html = '
                    <div class="rts-quote-area text-center">
                        <h5 class="title">"' . htmlspecialchars($content['text']) . '"</h5>
                        <a href="#" class="name">' . htmlspecialchars($content['author']) . '</a>
                        <span>' . htmlspecialchars($content['role']) . '</span>
                    </div>
                ';
                break;

           case 'heading':
                $class = isset($content['class']) ? htmlspecialchars($content['class']) : '';
                $text  = isset($content['text']) ? htmlspecialchars($content['text']) : '';

                if (!empty($content['level'])) {
                // If level exists, render heading
                $level = (int)$content['level'];
                $html = '<h' . $level . ' class="title ' . $class . '">' . $text . '</h' . $level . '>';
                } else {
                // If no level, render a div fallback
                $html = '<div class="title ' . $class . '">' . $text . '</div>';
                }
                break;
                
            default:
                $html = '';
        }

        return $html;
    }
}

// Initialize the component
$component = new BlogDetailComponent();
$component->ngOnInit();

// Set page title
$pageTitle = $component->blogPost['title'] . " - Arts Of Finance";
?>

<!-- start breadcrumb area -->
<div class="rts-breadcrumb-area breadcrumb-bg bg_image">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 breadcrumb-1">
                <h1 class="title">Post Details</h1>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="bread-tag">
                    <a href="/">Home</a>
                    <span> / </span>
                    <a href="blog">Blog</a>
                    <span> / </span>
                    <a href="#" class="active">Post Details</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb area -->

<div class="rts-blog-list-area rts-section-gap">
    <div class="container">
        <div class="row g-5">
            <!-- rts blog post area -->
            <div class="col-xl-8 col-md-12 col-sm-12 col-12">
                <!-- single post -->
                <div class="blog-single-post-listing details mb--0">
                    <div class="thumbnail">
                        <img src="<?php echo $component->blogPost['featuredImage']; ?>"
                            alt="<?php echo $component->blogPost['title']; ?>">
                    </div>

                    <div class="blog-listing-content">
                        <div class="user-info">
                            <!-- single info -->
                            <div class="single">
                                <i class="far fa-user-circle"></i>
                                <span>by <?php echo $component->blogPost['author']['name']; ?></span>
                            </div>
                            <!-- single info end -->

                            <!-- single info -->
                            <div class="single">
                                <i class="far fa-clock"></i>
                                <span><?php echo date('F j, Y', strtotime($component->blogPost['publishDate'])); ?></span>
                            </div>
                            <!-- single info end -->

                            <!-- single info -->
                            <div class="single">
                                <i class="far fa-tags"></i>
                                <span><?php echo implode(', ', $component->blogPost['categories']); ?></span>
                            </div>
                            <!-- single info end -->
                        </div>

                        <h3 class="title"><?php echo $component->blogPost['title']; ?></h3>

                        <?php foreach ($component->blogPost['content'] as $content): ?>
                        <div><?php echo $component->renderContent($content); ?></div>
                        <?php endforeach; ?>

                        <div class="row align-items-center mt--5">
                            <div class="col-lg-6 col-md-12">
                                <!-- tags details -->
                                <div class="details-tag">
                                    <h6>Tags:</h6>
                                    <?php foreach ($component->blogPost['tags'] as $tag): ?>
                                    <button><?php echo $tag; ?></button>
                                    <?php endforeach; ?>
                                </div>
                                <!-- tags details end -->
                            </div>

                            <div class="col-lg-6 col-md-12">
                                <div class="details-share">
                                    <h6>Share:</h6>
                                    <?php if (isset($component->blogPost['socialSharing']['facebook']) && $component->blogPost['socialSharing']['facebook']): ?>
                                    <button><i class="fab fa-facebook-f"></i></button>
                                    <?php endif; ?>
                                    <?php if (isset($component->blogPost['socialSharing']['pinterest']) && $component->blogPost['socialSharing']['pinterest']): ?>
                                    <button><i class="fab fa-pinterest-p"></i></button>
                                    <?php endif; ?>
                                    <?php if (isset($component->blogPost['socialSharing']['instagram']) && $component->blogPost['socialSharing']['instagram']): ?>
                                    <button><i class="fab fa-instagram"></i></button>
                                    <?php endif; ?>
                                    <?php if (isset($component->blogPost['socialSharing']['linkedin']) && $component->blogPost['socialSharing']['linkedin']): ?>
                                    <button><i class="fab fa-linkedin-in"></i></button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="author-area">
                            <div class="thumbnail details mb_sm--15">
                                <img src="<?php echo $component->blogPost['author']['avatar']; ?>"
                                    alt="<?php echo $component->blogPost['author']['name']; ?>">
                            </div>

                            <div class="author-details team">
                                <span><?php echo $component->blogPost['authorBio']['role']; ?></span>
                                <h5><?php echo $component->blogPost['authorBio']['name']; ?></h5>
                                <p class="disc"><?php echo $component->blogPost['authorBio']['bio']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single post end -->
            </div>
            <!-- rts-blog post end area -->
            <!-- rts blog wizered area -->
            <div class="col-xl-4 col-md-12 col-sm-12 col-12">
                <!-- single wizered start -->
                <div class="rts-single-wized Categories">
                    <div class="wized-header">
                        <h5 class="title">
                            Categories
                        </h5>
                    </div>
                    <div class="wized-body">
                        <!-- single categories -->
                        <?php foreach ($component->categories as $category): ?>
                        <ul class="single-categories">
                            <li><a href="/blog?category=<?php echo urlencode(strtolower($category)); ?>"><?php echo $category; ?>
                                    <i class="far fa-long-arrow-right"></i></a></li>
                        </ul>
                        <?php endforeach; ?>
                        <!-- single categories End -->
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
                        <?php foreach ($component->latestBlog as $blog): ?>
                        <div class="recent-post-single">
                            <div class="thumbnail">
                                <a href="/blog-detail?id=<?php echo $blog['id']; ?>"><img
                                        src="<?php echo $blog['featuredImage']; ?>" alt="Blog_post"></a>
                            </div>
                            <div class="content-area">
                                <div class="user">
                                    <i class="fal fa-clock"></i>
                                    <span><?php echo date('d M, Y', strtotime($blog['publishDate'])); ?></span>
                                </div>
                                <a class="post-title" href="/blog-detail?id=<?php echo $blog['id']; ?>">
                                    <h6 class="title"><?php echo substr($blog['title'], 0, 40); ?>...</h6>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <!-- recent-post End -->
                    </div>
                </div>
                <!-- single wizered End -->
                <!-- single wizered start -->
                <div class="rts-single-wized Recent-post">
                    <div class="wized-header">
                        <h5 class="title">
                            Gallery Posts
                        </h5>
                    </div>
                    <div class="wized-body">
                        <div class="gallery-inner">
                            <div class="row-1 single-row">
                                <?php for ($i = 0; $i < min(3, count($component->galleryImages)); $i++): ?>
                                <a><img src="<?php echo $component->galleryImages[$i]; ?>" alt="Gallery"></a>
                                <?php endfor; ?>
                            </div>
                            <div class="row-2 single-row">
                                <?php for ($i = 3; $i < min(6, count($component->galleryImages)); $i++): ?>
                                <a><img src="<?php echo $component->galleryImages[$i]; ?>" alt="Gallery"></a>
                                <?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single wizered End -->
                <!-- single wizered start -->
                <div class="rts-single-wized">
                    <div class="wized-header">
                        <h5 class="title">
                            Popular Tags
                        </h5>
                    </div>
                    <div class="wized-body">
                        <div class="tags-wrapper">
                            <?php for ($i = 0; $i < min(5, count($component->allTags)); $i++): ?>
                            <a
                                href="/blog/tag/<?php echo urlencode(strtolower($component->allTags[$i])); ?>"><?php echo $component->allTags[$i]; ?></a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
                <!-- single wizered End -->
                <!-- single wizered start -->
                <div class="rts-single-wized contact">
                    <div class="wized-header">
                        <a><img src="assets/img/logo1.png" alt="Business_logo"></a>
                    </div>
                    <div class="wized-body">
                        <h5 class="title">Need Help? We Are Here
                            To Help You</h5>
                        <a class="rts-btn btn-primary" href="/contact.php">Contact Us</a>
                    </div>
                </div>
                <!-- single wizered End -->
            </div>
            <!-- rts- blog wizered end area -->
        </div>
    </div>
</div>
<!-- rts blog mlist area End -->