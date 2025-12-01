<?php
/**
 * The base configuration for WordPress
 * @package WordPress
 */
define( 'WP_DEBUG', true );// Bật Debug
define( 'WP_DEBUG_LOG', true ); // Ghi lỗi vào log file
define( 'WP_DEBUG_DISPLAY', true );
// ** Database settings - You can get this info from your web host ** //
define( 'DB_NAME', 'blogshop_db_proj' );
define( 'DB_USER', 'root' );      // THAY ĐỔI: User mặc định của XAMPP
define( 'DB_PASSWORD', '' );       // THAY ĐỔI: Password mặc định của XAMPP (trống)
define( 'DB_HOST', 'localhost' );  // THAY ĐỔI: Host là localhost
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 * (Giữ nguyên các khóa bảo mật)
 * ...
 */
define( 'AUTH_KEY','**************************************************' );
define( 'SECURE_AUTH_KEY', '**************************************************' );
define( 'LOGGED_IN_KEY', '**************************************************' );
define( 'NONCE_KEY', '**************************************************' );
define( 'AUTH_SALT', '**************************************************' );
define( 'SECURE_AUTH_SALT','**************************************************' );
define( 'LOGGED_IN_SALT', '**************************************************' );
define( 'NONCE_SALT',     '**************************************************' );

/**#@-*/

/**
 * WordPress database table prefix.
 * ...
 */
$table_prefix = 'wp_';


// ***************************************************************
//              PHẦN TỐI ƯU VÀ DEBUG CẦN THIẾT
// ***************************************************************

/**
 * THIẾT LẬP LẠI DEBUG VÀ QUERY MONITOR
 * (Đã xóa cấu hình Redis và FS_METHOD của Docker)
 */

 // Không hiển thị lỗi ra màn hình
@ini_set( 'display_errors', 0 ); // Tắt hiển thị lỗi PHP
define( 'SAVEQUERIES', true ); // Ghi lại các truy vấn DB (Quan trọng cho Query Monitor)


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';