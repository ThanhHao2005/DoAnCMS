<?php
/**
 * Template WooCommerce cho trang lưu trữ sản phẩm (Shop Page)
 * Tích hợp Page Banner và cấu trúc lưới sản phẩm của Minishop.
 */
get_header(); 
?>

<!-- 1. CHÈN PAGE BANNER (Breadcrumb) -->
<?php get_template_part( 'page-banner' ); ?>

<!-- Bắt đầu phần hiển thị sản phẩm chính (Sử dụng class 'colorlib-product' của mẫu Minishop) -->
<div class="colorlib-product">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar (Tùy chọn: Bộ lọc sản phẩm) -->
            <div class="col-sm-12 col-md-12 col-lg-3">
                <?php 
                /**
                 * get_sidebar('shop') thường được dùng để hiển thị các widget lọc
                 * Nếu bạn chưa tạo file sidebar-shop.php, chỉ cần giữ get_sidebar()
                 */
                get_sidebar(); 
                ?>
            </div>

            <!-- Khu vực hiển thị lưới sản phẩm -->
            <div class="col-sm-12 col-md-12 col-lg-9">
                <div class="row row-pb-lg">
                    
                    <?php 
                    // Bắt đầu vòng lặp chuẩn của WooCommerce
                    if ( woocommerce_product_loop() ) {
                        
                        /**
                         * Hàm woocommerce_product_loop_start() mở thẻ <ul>
                         * Nếu bạn muốn dùng cấu trúc Minishop/Bootstrap, bạn phải tự mở thẻ <div>
                         * Tuy nhiên, theo chuẩn WooCommerce, chúng ta nên giữ các hooks và class mặc định.
                         */
                        
                        // Hook trước khi vòng lặp bắt đầu (ví dụ: phân trang trên)
                        do_action( 'woocommerce_before_shop_loop' );

                        // Bắt đầu vòng lặp sản phẩm chính
                        woocommerce_product_loop_start();

                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();

                                /**
                                 * Hàm wc_get_template_part( 'content', 'product' ) sẽ tải file
                                 * content-product.php, file này sẽ định hình HTML cho TỪNG SẢN PHẨM.
                                 * Chúng ta sẽ cần tạo hoặc override file content-product.php sau.
                                 */
                                wc_get_template_part( 'content', 'product' );
                            }
                        }

                        // Kết thúc vòng lặp sản phẩm
                        woocommerce_product_loop_end();

                        // Hook sau khi vòng lặp kết thúc (ví dụ: phân trang dưới)
                        do_action( 'woocommerce_after_shop_loop' );
                    }
                    ?>
                
                </div> <!-- Đóng row row-pb-lg -->
                
                <!-- Phân trang (Pagination) -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <?php 
                        /**
                         * Hàm hiển thị phân trang
                         */
                        woocommerce_pagination(); 
                        ?>
                    </div>
                </div>

            </div> <!-- Đóng col-lg-9 (Lưới sản phẩm) -->

        </div> <!-- Đóng row -->
    </div> <!-- Đóng container -->
</div> <!-- Đóng colorlib-product -->

<?php get_footer(); ?>