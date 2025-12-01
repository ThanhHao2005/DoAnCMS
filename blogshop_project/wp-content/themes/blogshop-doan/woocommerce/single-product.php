<?php
/**
 * The Template for displaying all single products.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>

<div class="hero-wrap hero-bread"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <?php woocommerce_breadcrumb([
                        'delimiter' => '<span> / </span>',
                        'wrap_before' => '<span class="mr-2">',
                        'wrap_after' => '</span>'
                    ]); ?>
                </p>
                <h1 class="mb-0 bread"><?php woocommerce_page_title(); ?></h1>
            </div>
        </div>
    </div>
</div>
<section class="ftco-section">
    <div class="container">

        <?php
        while (have_posts()):
            the_post();
            // Lấy đối tượng sản phẩm (rất cần thiết cho các hàm sau)
            global $product;
            ?>

            <div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
                <div class="row">

                    <div class="col-lg-6 mb-5 ftco-animate">
                        <?php
                        /**
                         * Hook này TẢI TOÀN BỘ GALLERY, BAO GỒM ẢNH CHÍNH & THUMBNAILS.
                         */
                        do_action('woocommerce_before_single_product_summary');
                        ?>
                    </div>

                    <div class="col-lg-6 product-details pl-md-5 ftco-animate">

                        <!-- BẮT ĐẦU: HIỂN THỊ LƯỢT XEM TỪ PLUGIN MSPVT -->
                        <?php
                        /**
                         * =======================================================
                         * GẮN LƯỢT XEM VÀO VỊ TRÍ TRÊN TRANG SẢN PHẨM (single-product.php)
                         * =======================================================
                         */
                        if (!function_exists('display_mspvt_product_views')) {
                            /**
                             * Hàm hiển thị lượt xem
                             */
                            function display_mspvt_product_views()
                            {
                                if (function_exists('mspvt_get_post_views')) {
                                    $views = mspvt_get_post_views(get_the_ID());
                                    ?>
                                    <div class="mspvt-views-count"
                                        style="font-size: 15px; color: #ff7f00; font-weight: 500; margin-bottom: 10px;">
                                        <i class="icon-eye" style="margin-right: 5px;"></i> Đã có
                                        <strong><?php echo number_format_i18n($views); ?></strong> lượt xem sản phẩm
                                    </div>
                                    <?php
                                }
                            }
                            // Gắn hàm hiển thị vào hook, ưu tiên 25 (sau tiêu đề 5, rating 10, nhưng trước giá 30)
                            add_action('woocommerce_single_product_summary', 'display_mspvt_product_views', 25);
                        }

                        ?>
                        <!-- KẾT THÚC: HIỂN THỊ LƯỢT XEM -->

                        <?php
                        /**
                         * Hook này TẢI TOÀN BỘ TÓM TẮT: Tiêu đề, Giá, Form Mua hàng (Add to Cart).
                         */
                        do_action('woocommerce_single_product_summary');
                        ?>
                    </div>

                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <?php
                    // Hàm này hiển thị các Tab (Description, Reviews)
                    woocommerce_output_product_data_tabs();
                    ?>
                </div>
            </div>

            <?php
        endwhile; // Kết thúc vòng lặp sản phẩm
        ?>

    </div>
</section>
<section class="ftco-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Sản phẩm liên quan</h2>
            </div>
        </div>
        <div class="row">
            <?php
            // Hàm này hiển thị các sản phẩm liên quan
            woocommerce_output_related_products();
            ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>