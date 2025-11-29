<?php
/**
 * The Template for displaying product archives, including the shop page.
 * Cấu trúc: Sidebar (3 cột) + Nội dung chính (9 cột).
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

do_action('woocommerce_before_main_content');
?>

<div class="hero-wrap hero-bread"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <?php 
                    if ( function_exists('woocommerce_breadcrumb') ) {
                        woocommerce_breadcrumb([
                            'delimiter' => '<span> / </span>',
                            'wrap_before' => '<span class="mr-2">',
                            'wrap_after' => '</span>'
                        ]);
                    }
                    ?>
                </p>
                <h1 class="mb-0 bread"><?php woocommerce_page_title(); ?></h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 sidebar ftco-animate">

                <div class="sidebar-box">
                    <h3 class="heading">Danh Mục Sản Phẩm</h3>

                    <?php
                    // ********** HIỂN THỊ DANH MỤC SẢN PHẨM Ở SIDEBAR **********
                    
                    // Lấy tất cả các danh mục sản phẩm cấp cao nhất (parent = 0)
                    $args = array(
                        'taxonomy' => 'product_cat',
                        'orderby' => 'name',
                        'show_count' => 1, // Hiển thị số lượng sản phẩm trong danh mục
                        'pad_counts' => 1,
                        'hierarchical' => 1,
                        'title_li' => '',
                        'hide_empty' => 0, // Hiển thị cả danh mục không có sản phẩm
                    );

                    echo '<ul class="category-list">'; // Thêm class tùy chỉnh cho styling
                    wp_list_categories($args); // Hàm chuẩn của WP/WC để liệt kê danh mục
                    echo '</ul>';

                    // Hoặc bạn có thể dùng một Widget Area nếu theme hỗ trợ sidebar
                    ?>
                </div>

            </div>
            <div class="col-md-9">

                <header class="woocommerce-products-header">
                    <?php do_action('woocommerce_archive_description'); ?>
                </header>

                <?php
                if (woocommerce_product_loop()) {

                    do_action('woocommerce_before_shop_loop');

                    // Bắt đầu danh sách sản phẩm (Mở thẻ <ul> hoặc <div>)
                    woocommerce_product_loop_start();

                    // Vòng lặp chính
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                            // Tải template content-product.php
                            wc_get_template_part('content', 'product');
                        }
                    }

                    // Kết thúc danh sách sản phẩm
                    woocommerce_product_loop_end();

                    // Phân trang
                    do_action('woocommerce_after_shop_loop');

                } else {
                    do_action('woocommerce_no_products_found');
                }
                ?>

            </div>
        </div>
    </div>
</section>

<?php
do_action('woocommerce_after_main_content');
get_footer();