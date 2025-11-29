<?php
/**
 * Template Name: WooCommerce - My Account Page
 * Template File: page-my-account.php
 * Dùng để tùy chỉnh trang "Tài khoản của tôi"
 */
get_header(); ?>
<style>
    /* ========================================= */
/* WOOCOMMERCE MY ACCOUNT STYLING            */
/* ========================================= */

/* 1. TỔNG QUAN LAYOUT (Dùng cho desktop) */
.woocommerce-account .woocommerce-MyAccount-navigation {
    /* Tạo khoảng cách bên phải menu */
    padding-right: 30px; 
}

.woocommerce-account .woocommerce-MyAccount-content {
    /* Tạo khoảng cách bên trái nội dung */
    padding-left: 30px; 
}

/* 2. STYLING CHO MENU ĐIỀU HƯỚNG (NAV LINKS) */

.woocommerce-MyAccount-navigation ul {
    list-style: none;
    margin: 0;
    padding: 0;
    /* Màu nền nhẹ cho toàn bộ khối menu */
    background-color: #f7f7f7; 
    border-radius: 5px;
    border: 1px solid #eeeeee;
}

.woocommerce-MyAccount-navigation li {
    border-bottom: 1px solid #eeeeee;
}
.woocommerce-MyAccount-navigation li:last-child {
    border-bottom: none;
}

/* Style cho các nút Menu */
.woocommerce-MyAccount-navigation a {
    display: block;
    padding: 15px 20px;
    color: #333333;
    font-weight: 600;
    text-decoration: none;
    border-left: 4px solid transparent; /* Dùng border trái làm điểm nhấn */
    transition: all 0.2s ease-in-out;
}

/* Hiệu ứng Hover và Trạng thái Active */
.woocommerce-MyAccount-navigation a:hover {
    background-color: #ffffff;
    color: #007bff; /* Mặc định là Primary Color */
}

.woocommerce-MyAccount-navigation li.is-active a {
    background-color: #ffffff; 
    color: #007bff; /* Mặc định là Primary Color */
    border-left-color: #007bff; /* Mặc định là Primary Color */
    font-weight: 700;
}

/* 3. STYLING CHO NỘI DUNG CHÍNH (CONTENT AREA) */

/* Tiêu đề chính của từng tab */
.woocommerce-MyAccount-content h2:first-of-type {
    border-bottom: 2px solid #eeeeee;
    padding-bottom: 10px;
    margin-bottom: 25px;
    font-size: 1.8rem;
    font-weight: 700;
    color: #333333;
}

/* 4. TÙY CHỈNH BẢNG ĐƠN HÀNG (ORDERS TABLE) */

.woocommerce-orders-table th {
    background-color: #343a40; /* Màu nền Dark */
    color: #ffffff;
    padding: 12px 10px;
    text-align: left;
}

.woocommerce-orders-table td {
    padding: 10px;
    border-bottom: 1px solid #eeeeee;
    vertical-align: middle;
}

/* Nút Xem/Hủy đơn hàng (Nút Action) */
.woocommerce-orders-table .button {
    font-size: 14px;
    padding: 8px 15px;
    margin-right: 5px;
    /* Sử dụng lại màu Primary/Button đã khai báo trong customizer */
    background-color: #007bff; 
    color: #ffffff;
    border-radius: 50px; /* Làm nút bo tròn hơn */
    text-transform: uppercase;
    letter-spacing: 1px;
}
.woocommerce-orders-table .button.cancel {
    background-color: #dc3545; /* Màu đỏ cho nút Hủy */
}

/* 5. FIX RESPONSIVE */

@media screen and (max-width: 768px) {
    .woocommerce-MyAccount-navigation,
    .woocommerce-MyAccount-content {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .woocommerce-MyAccount-navigation {
        margin-bottom: 30px;
    }
}
</style>
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
<div id="myaccount-content" class="container" style="padding: 50px 0;">
    <div class="row">
        <div class="col-md-12">

            <?php
            // Bắt đầu vòng lặp WordPress để lấy nội dung trang
            while ( have_posts() ) : the_post();

                // Hiển thị nội dung trang (chứa Shortcode [woocommerce_my_account])
                the_content(); 

            endwhile; // End of the loop.
            ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>