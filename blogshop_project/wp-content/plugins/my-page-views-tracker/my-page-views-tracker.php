<?php
/**
 * Plugin Name: Custom Post Views (Đồ Án)
 * Description: Đếm và hiển thị số lượt xem cho bài viết và sản phẩm (sử dụng post meta).
 * Version: 1.0.1
 * Author: Your Name
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Thoát nếu truy cập trực tiếp
}

// Định nghĩa Meta Key để lưu trữ số lượt xem
define( 'CUSTOM_POST_VIEWS_META_KEY', 'custom_post_views_count' );

/**
 * 1. Hàm chính để tăng số lượt xem.
 * Gắn vào Hook 'wp_head' để đảm bảo nó chạy sau khi tất cả các bài viết được tải.
 */
function custom_set_post_views() {
    // Chỉ chạy trên các trang hiển thị một bài viết/sản phẩm duy nhất (is_single)
    if ( is_single() ) {
        $post_id = get_the_ID();
        
        // Lấy số lượt xem hiện tại từ database, mặc định là 0
        $count = (int) get_post_meta( $post_id, CUSTOM_POST_VIEWS_META_KEY, true );
        
        // Tăng số đếm lên 1
        $new_count = $count + 1;
        
        // Cập nhật lại vào database (bảng wp_postmeta)
        // Dùng update_post_meta sẽ tự động add nếu chưa có
        update_post_meta( $post_id, CUSTOM_POST_VIEWS_META_KEY, $new_count );
    }
}
// Gắn hàm này vào Hook 'wp_head'
add_action( 'wp_head', 'custom_set_post_views' );

/**
 * 2. Hàm lấy số lượt xem. Không tăng đếm, chỉ đọc từ DB.
 *
 * @param int $post_id ID của bài viết. Mặc định là bài viết hiện tại.
 * @return int Số lượt xem.
 */
function custom_get_post_views( $post_id = null ) {
    if ( $post_id === null ) {
        $post_id = get_the_ID();
    }
    // Lấy số lượt xem, trả về 0 nếu chưa có.
    $count = (int) get_post_meta( $post_id, CUSTOM_POST_VIEWS_META_KEY, true );
    return $count;
}

/**
 * 3. Hàm hiển thị số lượt xem ra màn hình.
 *
 * @param string $prefix Văn bản tiền tố (ví dụ: 'Lượt xem: ').
 * @param string $suffix Văn bản hậu tố (ví dụ: ' lần').
 */
function custom_the_post_views( $prefix = 'Lượt xem: ', $suffix = ' lần' ) {
    $views = custom_get_post_views();
    
    if ( $views >= 0 ) {
        echo '<span class="custom-post-views-display">';
        echo wp_kses_post( $prefix ); 
        echo number_format_i18n( $views ); 
        echo wp_kses_post( $suffix ); 
        echo '</span>';
    }
}

/**
 * 4. Tạo cột hiển thị lượt xem trong trang Quản lý Bài viết/Sản phẩm (WP-Admin)
 */
function custom_views_column( $columns ) {
    // Thêm cột 'post_views' vào mảng $columns
    $columns[ 'post_views' ] = 'Lượt Xem';
    return $columns;
}
add_filter( 'manage_posts_columns', 'custom_views_column' ); // Cho Bài viết (post)
add_filter( 'manage_pages_columns', 'custom_views_column' ); // Cho Trang (page)

// Nếu WooCommerce đang hoạt động, thêm cột cho Sản phẩm
if ( class_exists( 'WooCommerce' ) ) {
    // Hook chuẩn để thêm cột vào trang danh sách Sản phẩm (post type 'product')
    add_filter( 'manage_edit-product_columns', 'custom_views_column' );
}

/**
 * 5. Hiển thị giá trị lượt xem trong cột vừa tạo
 */
function custom_views_column_content( $column_name, $post_id ) {
    if ( $column_name == 'post_views' ) {
        $views = custom_get_post_views( $post_id );
        echo number_format_i18n( $views );
    }
}
// Action cho Bài viết (post) và Trang (page)
add_action( 'manage_posts_custom_column', 'custom_views_column_content', 10, 2 );
add_action( 'manage_pages_custom_column', 'custom_views_column_content', 10, 2 );

// Nếu WooCommerce đang hoạt động, hiển thị nội dung cột cho Sản phẩm
if ( class_exists( 'WooCommerce' ) ) {
    // Action chuẩn để hiển thị nội dung cột cho Sản phẩm
    add_action( 'manage_product_posts_custom_column', 'custom_views_column_content', 10, 2 );
}