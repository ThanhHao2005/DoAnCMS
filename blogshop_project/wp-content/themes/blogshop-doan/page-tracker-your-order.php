<?php
/**
 * Template Name: WooCommerce - Order Tracker Page
 * Template File: page-tracker-your-order.php
 * Dùng để hiển thị form tra cứu đơn hàng của WooCommerce
 */
get_header(); ?>
<style>
    /* ========================================= */
/* WOOCOMMERCE ORDER TRACKING PAGE STYLING   */
/* ========================================= */

#order-tracker-content h1 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333333;
    margin-bottom: 10px;
}

#order-tracker-content .lead {
    font-size: 1.1rem;
    color: #6c757d;
}

/* 1. TÙY CHỈNH FORM TRA CỨU (THEO DÕI ĐƠN HÀNG) */
.woocommerce-form.woocommerce-form-track-order {
    max-width: 550px; /* Giới hạn chiều rộng form */
    margin: 0 auto;
    padding: 30px;
    border: 1px solid #eeeeee;
    border-radius: 8px;
    background-color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); /* Tạo hiệu ứng nổi nhẹ */
}

.woocommerce-form-track-order p {
    margin-bottom: 15px;
}

/* 2. INPUT FIELDS */
.woocommerce-form-track-order label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.woocommerce-form-track-order .input-text {
    width: 100%;
    padding: 12px;
    border: 1px solid #ced4da;
    border-radius: 4px;
    box-sizing: border-box;
    transition: border-color 0.2s;
}

.woocommerce-form-track-order .input-text:focus {
    border-color: #007bff; /* Thay bằng Primary Color */
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Thay bằng Primary Color */
}

/* 3. NÚT SUBMIT */
.woocommerce-form-track-order button[type="submit"] {
    display: inline-block;
    width: 100%;
    padding: 15px;
    background-color: #007bff; /* Thay bằng Primary Color */
    color: #ffffff;
    border: none;
    border-radius: 5px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
    text-transform: uppercase;
}

.woocommerce-form-track-order button[type="submit"]:hover {
    background-color: #0056b3; /* Màu tối hơn của Primary Color */
}

/* 4. KẾT QUẢ TRA CỨU (ORDER DETAILS) */
.woocommerce-view-order {
    margin-top: 30px;
    padding: 30px;
    border: 1px solid #eeeeee;
    border-radius: 8px;
    background-color: #f9f9f9;
}

/* Bảng thông tin đơn hàng */
.woocommerce-view-order .shop_table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.woocommerce-view-order .shop_table th,
.woocommerce-view-order .shop_table td {
    padding: 10px;
    border: 1px solid #dee2e6;
}

.woocommerce-view-order .order_details {
    /* Tiêu đề "Order Details" */
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 20px;
}
</style>
<div class="hero-wrap hero-bread"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <?php
                    if (function_exists('woocommerce_breadcrumb')) {
                        woocommerce_breadcrumb([
                            'delimiter' => '<span> / </span>',
                            'wrap_before' => '<span class="mr-2">',
                            'wrap_after' => '</span>'
                        ]);
                    }
                    ?>
                </p>
                <h1 class="mb-0 bread"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</div>
<!-- Services Section -->
<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-bag"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Miễn phí vận chuyển</h3>
                        <p>Freeship cho đơn hàng từ 500,000đ trên toàn quốc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Hỗ trợ 24/7</h3>
                        <p>Đội ngũ tư vấn nhiệt tình, sẵn sàng hỗ trợ mọi lúc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-payment-security"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Thanh toán an toàn</h3>
                        <p>Bảo mật thông tin, đa dạng phương thức thanh toán</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="order-tracker-content" class="container" style="padding: 60px 0;">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            
            <h1 class="mb-4">Tra Cứu Tình Trạng Đơn Hàng</h1>
            <p class="lead mb-5">Vui lòng nhập ID đơn hàng và Email thanh toán để xem chi tiết đơn hàng của bạn.</p>

        </div>
        
        <div class="col-md-8">
            <?php
            // Bắt đầu vòng lặp WordPress
            while ( have_posts() ) : the_post();

                // Hiển thị nội dung trang. 
                // Nội dung này phải chứa Shortcode [woocommerce_track_order]
                the_content(); 

            endwhile; // End of the loop.
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>