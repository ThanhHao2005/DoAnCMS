<?php
/**
 * Template cho trang tĩnh (Page)
 * Hiển thị nội dung trang từ WordPress Editor
 */
get_header(); ?>
<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end"
                    data-scrollax-parent="true">
                    <img class="one-third order-md-last img-fluid"
                        src="<?php echo get_template_directory_uri(); ?>/images/bg_1.png" alt="" />
                    <div class="one-forth d-flex align-items-center ftco-animate"
                        data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading">#New Arrival</span>
                            <div class="horizontal">
                                <!-- ✅ Sử dụng Customizer Option -->
                                <h1 class="mb-4 mt-3">
                                    <?php echo esc_html(get_theme_mod('homepage_banner_text', 'Chào mừng đến với H-Fashion')); ?>
                                </h1>
                                <p class="mb-4">
                                    <?php echo esc_html(get_theme_mod('homepage_banner_subtext', 'Style Your Story')); ?>
                                </p>
                                <p><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
                                        class="btn-custom">Khám phá ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-flex no-gutters slider-text align-items-center justify-content-end"
                    data-scrollax-parent="true">
                    <img class="one-third order-md-last img-fluid"
                        src="<?php echo get_template_directory_uri(); ?>/images/bg_2.png" alt="" />
                    <div class="one-forth d-flex align-items-center ftco-animate"
                        data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading">#Hot Sale</span>
                            <div class="horizontal">
                                <h1 class="mb-4 mt-3">Bộ Sưu Tập Mới 2025</h1>
                                <p class="mb-4">Khám phá phong cách thời trang hiện đại, trẻ trung</p>
                                <p><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn-custom">Mua
                                        ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<br>

<div id="colorlib-page"> <!-- Nội dung chính, chiếm 8/12 cột -->
    <div class="page-content">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                ?>
                <h1 class="page-title"><?php the_title(); ?></h1> <!-- Tiêu đề trang -->
                <div class="page-excerpt">
                    <?php the_content(); ?> <!-- Nội dung trang từ Editor -->
                </div>
                <?php
            endwhile;
        else:
            echo '<p>Không tìm thấy nội dung trang.</p>';
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>