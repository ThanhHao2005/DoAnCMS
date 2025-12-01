<?php
/**
 * The Template for displaying all single products.
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header(); ?>
<style>
    
    .btn.btn-primary {
        background-color: #007bff !important;
        border-color: #007bff !important;
    }

    .btn.btn-primary:hover,
    .btn.btn-primary:focus {
        background-color: #0056b3 !important;
        border-color: #0056b3 !important;
    }

    /* Tùy chỉnh nút Thêm vào giỏ hàng */
    .single_add_to_cart_button {
        /* Màu nền */
        background-color: #007bff !important;
        /* Màu chữ */
        color: #ffffff !important;
        /* Đổ bóng */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        /* Bo góc */
        border-radius: 5px;
        /* Kích thước */
        padding: 12px 30px;
        /* Xóa viền */
        border: none !important;
    }

    /* Hiệu ứng khi di chuột qua */
    .single_add_to_cart_button:hover {
        background-color: #0056b3 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .nav.nav-pills.d-flex {
    flex-direction: row !important;
    justify-content: flex-start !important;
    /* DÒNG QUAN TRỌNG: NGĂN NGẮT DÒNG */
    flex-wrap: nowrap !important; 
    overflow-x: auto; /* Thêm thanh cuộn ngang nếu tổng chiều rộng quá lớn */
}
</style>
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
            // Không cần global $product ở đây
            ?>

            <div class="row">

                <div class="col-lg-6 mb-5 ftco-animate">
                    <?php
                    /**
                     * HOOK QUAN TRỌNG: woocommerce_before_single_product_summary (Mặc định chứa Product Gallery)
                     * Lệnh này sẽ hiển thị đầy đủ Image Gallery (Ảnh chính, Thumbnails, Variable Product)
                     */
                    do_action('woocommerce_before_single_product_summary');
                    
                    ?>
                </div>

                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <?php
                    /**
                     * HOOK QUAN TRỌNG: woocommerce_single_product_summary (Mặc định chứa Title, Price, Rating, Form, Meta, Sharing)
                     * Lệnh này sẽ tải tất cả các thành phần còn thiếu (Form Mua hàng, Rating, Price)
                     * và khắc phục lỗi thiếu dữ liệu.
                     */
                    do_action('woocommerce_single_product_summary');
                    ?>
                </div>

            </div>

            <div class="row mt-5">
                <div class="col-md-12">
                    <?php
                    /**
                     * Hook này hiển thị các Tab (Description, Reviews) và Up-sells.
                     */
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