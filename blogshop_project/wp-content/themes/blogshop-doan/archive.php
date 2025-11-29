<?php
/**
 * Archive Template - Blog Settings
 */
get_header(); 

// ✅ Lấy Blog Layout từ Customizer
$blog_layout = get_theme_mod('blog_layout', 'grid');
$show_date = get_theme_mod('show_post_date', true);
$show_author = get_theme_mod('show_post_author', true);
?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="<?php echo home_url(); ?>">Home</a></span> 
                    <span>Blog</span>
                </p>
                <h1 class="mb-0 bread"><?php the_archive_title(); ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section bg-light">
    <div class="container">
        <!-- ✅ Áp dụng Blog Layout -->
        <div class="row blog-layout-<?php echo esc_attr($blog_layout); ?>">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    
                    <!-- Grid Layout (3 cột) -->
                    <?php if ($blog_layout == 'grid') : ?>
                    <div class="col-md-4 ftco-animate">
                        <div class="blog-entry">
                            <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="block-20 d-flex align-items-end" 
                               style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                            </a>
                            <?php endif; ?>
                            
                            <div class="text p-4">
                                <!-- ✅ Show Date nếu bật -->
                                <?php if ($show_date) : ?>
                                <div class="meta mb-2">
                                    <div><a href="#"><?php echo get_the_date(); ?></a></div>
                                </div>
                                <?php endif; ?>
                                
                                <h3 class="heading">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                
                                <div class="d-flex align-items-center mt-4">
                                    <!-- ✅ Show Author nếu bật -->
                                    <?php if ($show_author) : ?>
                                    <p class="mb-0">
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="mr-2">
                                            👤 <?php the_author(); ?>
                                        </a>
                                    </p>
                                    <?php endif; ?>
                                    
                                    <p class="mb-0 ml-auto">
                                        <a href="<?php the_permalink(); ?>" class="mr-2">Đọc thêm</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- List Layout (1 cột full width) -->
                    <?php elseif ($blog_layout == 'list') : ?>
                    <div class="col-md-12 ftco-animate">
                        <div class="blog-entry blog-entry-list d-md-flex">
                            <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="block-20 img" 
                               style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); width: 300px;">
                            </a>
                            <?php endif; ?>
                            
                            <div class="text p-4 flex-grow-1">
                                <?php if ($show_date) : ?>
                                <div class="meta mb-2">
                                    <div><a href="#">📅 <?php echo get_the_date(); ?></a></div>
                                </div>
                                <?php endif; ?>
                                
                                <h3 class="heading">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <p><?php echo wp_trim_words(get_the_excerpt(), 50); ?></p>
                                
                                <div class="d-flex align-items-center mt-4">
                                    <?php if ($show_author) : ?>
                                    <p class="mb-0">
                                        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
                                            👤 By <?php the_author(); ?>
                                        </a>
                                    </p>
                                    <?php endif; ?>
                                    
                                    <p class="mb-0 ml-auto">
                                        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Đọc thêm</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Masonry Layout (lưới không đều) -->
                    <?php else : ?>
                    <div class="col-md-4 ftco-animate">
                        <div class="blog-entry">
                            <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>" class="block-20" 
                               style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>'); height: <?php echo rand(200, 400); ?>px;">
                            </a>
                            <?php endif; ?>
                            
                            <div class="text p-4">
                                <?php if ($show_date) : ?>
                                <div class="meta mb-2">
                                    <div><a href="#"><?php echo get_the_date(); ?></a></div>
                                </div>
                                <?php endif; ?>
                                
                                <h3 class="heading">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                
                                <?php if ($show_author) : ?>
                                <p class="author">👤 <?php the_author(); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                <?php endwhile; ?>
            <?php else : ?>
                <div class="col-md-12">
                    <p>Chưa có bài viết nào.</p>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Pagination -->
        <div class="row mt-5">
            <div class="col text-center">
                <?php
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '« Prev',
                    'next_text' => 'Next »',
                ));
                ?>
            </div>
        </div>
    </div>
</section>

<style>
/* Grid Layout */
.blog-layout-grid .blog-entry {
    margin-bottom: 30px;
}

/* List Layout */
.blog-layout-list .blog-entry-list {
    margin-bottom: 30px;
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.blog-layout-list .block-20 {
    min-width: 300px;
    min-height: 200px;
    background-size: cover;
}

/* Masonry Layout */
.blog-layout-masonry {
    column-count: 3;
    column-gap: 30px;
}

.blog-layout-masonry .blog-entry {
    break-inside: avoid;
    margin-bottom: 30px;
}

@media (max-width: 768px) {
    .blog-layout-list .blog-entry-list {
        flex-direction: column;
    }
    
    .blog-layout-masonry {
        column-count: 1;
    }
}

/* Meta info */
.meta a {
    color: #999;
    font-size: 13px;
}

.author {
    color: #666;
    font-size: 14px;
    margin-top: 10px;
}
</style>

<?php get_footer(); ?>