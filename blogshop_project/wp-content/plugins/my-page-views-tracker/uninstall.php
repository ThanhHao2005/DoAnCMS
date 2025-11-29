<?php
// Kiểm tra nếu tệp không được gọi từ WordPress (giữ bảo mật)
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    die;
}

// Xóa bảng Cơ sở dữ liệu (Database Table)
global $wpdb;
$table_name = $wpdb->prefix . 'post_views';

// Chuẩn bị câu lệnh SQL
$sql = "DROP TABLE IF EXISTS $table_name";

// Thực thi câu lệnh
$wpdb->query( $sql );

// Nếu bạn lưu trữ dữ liệu khác (ví dụ: tùy chọn trong wp_options), bạn cũng nên xóa ở đây.