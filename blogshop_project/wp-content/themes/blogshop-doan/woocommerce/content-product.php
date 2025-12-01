<?php
/**
 * The template for displaying product content within loops.
 *
 * Điều này ghi đè (override) template gốc tại: woocommerce/templates/content-product.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Thoát nếu truy cập trực tiếp.
}

global $product;

// Đặt class CSS cho item sản phẩm
// Ví dụ: post-ID product type-product status-publish has-post-thumbnail ...
// Class 'col-lg-4' hoặc 'col-md-6' nên được thêm vào thẻ cha của vòng lặp (ví dụ: woocommerce_product_loop_start)
?>
<li <?php wc_product_class(); ?>>
    
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     * Thường là mở thẻ <a> bao quanh toàn bộ sản phẩm.
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    
    /**
     * Hook: woocommerce_before_shop_loop_item_title.
     * Thường chứa ảnh sản phẩm.
     * Mặc định: woocommerce_template_loop_product_thumbnail
     */
    do_action( 'woocommerce_before_shop_loop_item_title' );

    /**
     * Hook: woocommerce_shop_loop_item_title.
     * Thường chứa tên sản phẩm.
     * Mặc định: woocommerce_template_loop_product_title
     */
    do_action( 'woocommerce_shop_loop_item_title' );

    /**
     * Hook: woocommerce_after_shop_loop_item_title.
     * Thường chứa đánh giá và giá sản phẩm.
     * Mặc định: woocommerce_template_loop_rating và woocommerce_template_loop_price
     */
    do_action( 'woocommerce_after_shop_loop_item_title' );

    /**
     * Hook: woocommerce_after_shop_loop_item.
     * Thường chứa nút "Thêm vào giỏ hàng".
     * Mặc định: woocommerce_template_loop_add_to_cart
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>

</li>