<?php
/**
 * blogshop-doan functions and definitions
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Khai báo HỖ TRỢ cho WooCommerce và các tính năng khác
function blogshop_setup()
{
    // Hỗ trợ WooCommerce
    add_theme_support('woocommerce');

    // Hỗ trợ Post Thumbnails (Featured Images)
    add_theme_support('post-thumbnails');

    // Hỗ trợ Title Tag
    add_theme_support('title-tag');

    // Hỗ trợ HTML5
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

    // Hỗ trợ Custom Logo
    add_theme_support('custom-logo', array(
        'height' => 50,
        'width' => 200,
        'flex-height' => true,
        'flex-width' => true,
    ));

    // Đăng ký menu
    register_nav_menus(array(
        'primary' => esc_html__('Main Menu', 'blogshop'),
        'header-menu' => __('Menu Header', 'blogshop-doan'),
    ));

    // Đăng ký các kích thước hình ảnh
    add_image_size('blog-thumbnail', 350, 250, true);
    add_image_size('blog-large', 800, 500, true);
}
add_action('after_setup_theme', 'blogshop_setup');

// 2. Đăng ký CSS và JS
function blogshop_enqueue_assets()
{
    $theme_uri = get_template_directory_uri();

    // CSS
    wp_enqueue_style('blogshop-open-iconic-bootstrap', $theme_uri . '/css/open-iconic-bootstrap.min.css');
    wp_enqueue_style('blogshop-animate', $theme_uri . '/css/animate.css');
    wp_enqueue_style('blogshop-owl-carousel', $theme_uri . '/css/owl.carousel.min.css');
    wp_enqueue_style('blogshop-owl-theme-default', $theme_uri . '/css/owl.theme.default.min.css');
    wp_enqueue_style('blogshop-magnific-popup', $theme_uri . '/css/magnific-popup.css');
    wp_enqueue_style('blogshop-aos', $theme_uri . '/css/aos.css');
    wp_enqueue_style('blogshop-ionicons', $theme_uri . '/css/ionicons.min.css');
    wp_enqueue_style('blogshop-bootstrap-datepicker', $theme_uri . '/css/bootstrap-datepicker.css');
    wp_enqueue_style('blogshop-jquery-timepicker', $theme_uri . '/css/jquery.timepicker.css');
    wp_enqueue_style('blogshop-flaticon', $theme_uri . '/css/flaticon.css');
    wp_enqueue_style('blogshop-icomoon', $theme_uri . '/css/icomoon.css');
    wp_enqueue_style('blogshop-style', $theme_uri . '/css/style.css');

    // JS - Sử dụng jQuery của WordPress
    wp_enqueue_script('jquery');
    wp_enqueue_script('blogshop-popper', $theme_uri . '/js/popper.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-bootstrap', $theme_uri . '/js/bootstrap.min.js', array('jquery', 'blogshop-popper'), '1.0', true);
    wp_enqueue_script('blogshop-jquery-easing', $theme_uri . '/js/jquery.easing.1.3.js', array('jquery'), '1.3', true);
    wp_enqueue_script('blogshop-jquery-waypoints', $theme_uri . '/js/jquery.waypoints.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-jquery-stellar', $theme_uri . '/js/jquery.stellar.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-owl-carousel', $theme_uri . '/js/owl.carousel.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-magnific-popup', $theme_uri . '/js/jquery.magnific-popup.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-aos', $theme_uri . '/js/aos.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-jquery-animateNumber', $theme_uri . '/js/jquery.animateNumber.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-bootstrap-datepicker', $theme_uri . '/js/bootstrap-datepicker.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-scrollax', $theme_uri . '/js/scrollax.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('blogshop-main', $theme_uri . '/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'blogshop_enqueue_assets');



// 5. Ẩn loader trên trang checkout
function blogshop_hide_checkout_loader()
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        ?>
        <style>
            #ftco-loader {
                display: none !important;
            }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var loader = document.getElementById('ftco-loader');
                if (loader) loader.style.display = 'none';
            });
        </script>
        <?php
    }
}
add_action('wp_head', 'blogshop_hide_checkout_loader');

// 6. Tách payment method khỏi order review
function blogshop_remove_payment_from_review()
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);
    }
}
add_action('wp', 'blogshop_remove_payment_from_review');

// 7. Bootstrap Nav Walker
require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';

// 8. WooCommerce Customizations
function blogshop_woocommerce_customizations()
{
    // Ẩn breadcrumb mặc định
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    // Tag archive chỉ hiển thị blog posts
    function blogshop_tag_archive_only_posts($query)
    {
        if (!is_admin() && $query->is_main_query() && is_tag()) {
            $query->set('post_type', 'post');
        }
    }
    add_action('pre_get_posts', 'blogshop_tag_archive_only_posts');
}
add_action('after_setup_theme', 'blogshop_woocommerce_customizations');

// 9. Custom Logo CSS
function blogshop_custom_logo_css()
{
    ?>
    <style>
        .custom-logo {
            max-height: 50px !important;
            width: auto !important;
            height: auto !important;
        }

        .custom-logo-link {
            display: inline-block;
        }
    </style>
    <?php
}
add_action('wp_head', 'blogshop_custom_logo_css');

// 10. Contact Form Handler
function blogshop_handle_contact_form()
{
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'contact_form_nonce')) {
        wp_redirect(add_query_arg('sent', 'error', wp_get_referer()));
        exit;
    }

    $name = sanitize_text_field($_POST['contact_name']);
    $email = sanitize_email($_POST['contact_email']);
    $subject = sanitize_text_field($_POST['contact_subject']);
    $message = sanitize_textarea_field($_POST['contact_message']);

    $to = get_option('admin_email');
    $email_subject = "Contact Form: $subject";
    $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = array('Content-Type: text/html; charset=UTF-8', "From: $name <$email>");

    if (wp_mail($to, $email_subject, nl2br($email_body), $headers)) {
        wp_redirect(add_query_arg('sent', 'success', wp_get_referer()));
    } else {
        wp_redirect(add_query_arg('sent', 'error', wp_get_referer()));
    }
    exit;
}
add_action('admin_post_nopriv_contact_form_submit', 'blogshop_handle_contact_form');
add_action('admin_post_contact_form_submit', 'blogshop_handle_contact_form');

// 11. Contact Settings
function blogshop_contact_settings()
{
    register_setting('general', 'contact_address');
    register_setting('general', 'contact_phone');
    register_setting('general', 'contact_phone_display');
    register_setting('general', 'contact_email');
    register_setting('general', 'contact_map_embed');

    add_settings_section('contact_section', 'Contact Information', null, 'general');

    add_settings_field('contact_address', 'Address', function () {
        echo '<input type="text" name="contact_address" value="' . esc_attr(get_option('contact_address')) . '" class="regular-text" />';
    }, 'general', 'contact_section');

    add_settings_field('contact_phone', 'Phone (Link)', function () {
        echo '<input type="text" name="contact_phone" value="' . esc_attr(get_option('contact_phone')) . '" class="regular-text" placeholder="+1235235598" />';
    }, 'general', 'contact_section');

    add_settings_field('contact_phone_display', 'Phone (Display)', function () {
        echo '<input type="text" name="contact_phone_display" value="' . esc_attr(get_option('contact_phone_display')) . '" class="regular-text" placeholder="+ 1235 2355 98" />';
    }, 'general', 'contact_section');

    add_settings_field('contact_email', 'Contact Email', function () {
        echo '<input type="email" name="contact_email" value="' . esc_attr(get_option('contact_email')) . '" class="regular-text" />';
    }, 'general', 'contact_section');

    add_settings_field('contact_map_embed', 'Google Map Embed URL', function () {
        echo '<input type="url" name="contact_map_embed" value="' . esc_attr(get_option('contact_map_embed')) . '" class="large-text" />';
        echo '<p class="description">Paste Google Maps embed URL here</p>';
    }, 'general', 'contact_section');
}
add_action('admin_init', 'blogshop_contact_settings');

// 12. Flush rewrite rules khi kích hoạt theme
function blogshop_flush_rewrites()
{
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'blogshop_flush_rewrites');

// 13. Debug template (tùy chọn - có thể xóa sau khi fix xong)
function blogshop_debug_template()
{
    if (is_checkout()) {
        error_log('=== CHECKOUT TEMPLATE DEBUG ===');
        error_log('Current template: ' . get_page_template());
        error_log('Is checkout: ' . (is_checkout() ? 'yes' : 'no'));
        error_log('Is endpoint: ' . (is_wc_endpoint_url() ? 'yes' : 'no'));
    }
}
add_action('wp_head', 'blogshop_debug_template');
// TỰ ĐỘNG sử dụng page-checkout.php cho trang checkout
function blogshop_auto_checkout_template($template)
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        $checkout_template = get_stylesheet_directory() . '/page-checkout.php';
        if (file_exists($checkout_template)) {
            return $checkout_template;
        }
    }
    return $template;
}
add_filter('template_include', 'blogshop_auto_checkout_template', 99);

// Thêm CSS custom cho trang checkout
// Thêm CSS fix khẩn cấp cho checkout
function blogshop_checkout_emergency_css()
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        wp_enqueue_style('blogshop-checkout-fix', get_template_directory_uri() . '/css/checkout-fix.css');
    }
}
add_action('wp_enqueue_scripts', 'blogshop_checkout_emergency_css', 999);

// Debug checkout template
function blogshop_checkout_debug()
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        error_log('=== CHECKOUT DEBUG ===');
        error_log('Template: ' . get_page_template());
        error_log('Current Filter: template_include');

        // Kiểm tra xem CSS có được load không
        $styles = wp_styles();
        error_log('Enqueued Styles: ' . print_r($styles->queue, true));
    }
}
add_action('wp_head', 'blogshop_checkout_debug');

// Load custom checkout CSS
function blogshop_checkout_css()
{
    if (is_checkout() && !is_wc_endpoint_url()) {
        wp_enqueue_style('blogshop-checkout-style', get_template_directory_uri() . '/css/checkout-style.css', array(), '1.0');
    }
}
add_action('wp_enqueue_scripts', 'blogshop_checkout_css', 100);

function blogshop_enqueue_minishop_assets()
{
    $theme_uri = get_template_directory_uri();

    // FILE CHÍNH - Template CSS
    wp_enqueue_style('blogshop-style', $theme_uri . '/css/style.css');

    // Các CSS support khác
    wp_enqueue_style('blogshop-open-iconic-bootstrap', $theme_uri . '/css/open-iconic-bootstrap.min.css');
    wp_enqueue_style('blogshop-animate', $theme_uri . '/css/animate.css');
    // ... rest of CSS files
}

add_filter('woocommerce_enable_order_notes_field', '__return_false');
// SỬA LỖI BỐ CỤC FORM CHECKOUT: ÁP DỤNG CLASS BOOTSTRAP

add_filter('woocommerce_checkout_fields', 'blogshop_apply_bootstrap_classes');

function blogshop_apply_bootstrap_classes($fields)
{

    // 1. Định nghĩa các trường cần 6 cột (nửa dòng)
    $half_fields = [
        'billing_first_name',
        'billing_last_name',
        'billing_phone',
        'billing_email',
        'billing_city',
        'billing_postcode', // Thường là City và Postcode
        'billing_state', // Tỉnh/thành phố
        'billing_address_1', // Địa chỉ dòng 1 (nếu muốn chia)
        'billing_address_2', // Địa chỉ dòng 2 (nếu muốn chia)

        // Nếu có Shipping fields
        'shipping_first_name',
        'shipping_last_name',
        'shipping_phone',
        'shipping_email',
        'shipping_city',
        'shipping_postcode',
        'shipping_state',
        'shipping_address_1',
        'shipping_address_2',
    ];

    // 2. Lặp qua các nhóm trường (billing, shipping, order)
    foreach ($fields as $group => $field_group) {
        foreach ($field_group as $key => $field) {

            if (in_array($key, $half_fields)) {
                // Áp dụng class col-md-6
                $fields[$group][$key]['class'] = ['col-md-6'];
            } else {
                // Áp dụng class col-md-12 (Full width: Country, Company, Order Notes)
                $fields[$group][$key]['class'] = ['col-md-12'];
            }

            // Xóa các class cũ của WooCommerce gây xung đột
            $fields[$group][$key]['class'][] = 'form-group'; // Thêm form-group cho CSS tùy chỉnh
            $fields[$group][$key]['input_class'] = ['form-control']; // Áp dụng form-control cho input
        }
    }

    return $fields;
}

// 3. Ghi đè Template trường để sử dụng DIV thay vì P
// Điều này rất quan trọng để class col-md-x hoạt động
// Sửa lỗi Warning: Undefined array key "input_html"
add_filter('woocommerce_form_field_args', 'blogshop_field_to_div', 10, 3);
function blogshop_field_to_div($args, $key, $value)
{

    // THÊM ĐIỀU KIỆN KIỂM TRA (Fix lỗi Undefined array key)
    if (!isset($args['input_html'])) {
        return $args;
    }

    // 1. Thay thế <p> tag bằng <div> tag
    // Lỗi Deprecated (Null) xảy ra vì $args['input_html'] có thể là null.
    // Việc kiểm tra isset() ở trên đã fix lỗi này.
    $args['input_html'] = str_replace('<p', '<div', $args['input_html']);
    $args['input_html'] = str_replace('</p', '</div', $args['input_html']);

    // 2. Bỏ các class form-row-xxx cũ để chỉ giữ lại col-md-x
    $args['class'] = array_diff($args['class'], ['form-row', 'form-row-wide', 'form-row-first', 'form-row-last']);

    return $args;
}
// ẨN thông báo "Product successfully added to your cart"
function blogshop_hide_add_to_cart_notice($message)
{
    // Chỉ ẩn thông báo thành công (woocommerce-message)
    if (strpos($message, 'has been added to your cart') !== false) {
        return null;
    }
    return $message;
}
// Hook vào filter hiển thị thông báo
add_filter('wc_add_to_cart_message_html', 'blogshop_hide_add_to_cart_notice');

// Hiển thị với style đẹp

// Tùy chỉnh CSS cho trang My Account
function custom_myaccount_styles()
{
    if (is_account_page()) {
        ?>
        <style>
            /* Ẩn elements không cần thiết */
            .page-title,
            .addtoany_share_save_container,
            .page-excerpt>.addtoany_share_save_container {
                display: none !important;
            }

            /* Container */
            .woocommerce {
                max-width: 1200px;
                margin: 60px auto;
                padding: 0 15px;
            }

            /* Layout 2 cột */
            #customer_login {
                display: flex;
                gap: 40px;
                margin: 0 !important;
            }

            .u-column1,
            .u-column2 {
                flex: 1;
                background: #fff;
                padding: 40px;
                border-radius: 10px;
                box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
                margin: 0 !important;
            }

            /* Tiêu đề form */
            .u-column1 h2,
            .u-column2 h2 {
                margin-top: 0;
                margin-bottom: 30px;
                padding-bottom: 15px;
                border-bottom: 2px solid #007bff;
                color: #333;
                font-size: 24px;
            }

            /* Form fields */
            .woocommerce-form-row {
                margin-bottom: 20px;
            }

            .woocommerce-form-row label {
                display: block;
                margin-bottom: 8px;
                font-weight: 600;
                color: #333;
                font-size: 14px;
            }

            .woocommerce-Input {
                width: 100% !important;
                padding: 12px 15px !important;
                border: 1px solid #ddd !important;
                border-radius: 5px !important;
                font-size: 14px !important;
                transition: border-color 0.3s ease;
                box-sizing: border-box;
            }

            .woocommerce-Input:focus {
                border-color: #007bff !important;
                outline: none !important;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.3) !important;
            }

            /* Checkbox */
            .woocommerce-form__label-for-checkbox {
                display: flex;
                align-items: center;
                font-weight: normal !important;
            }

            .woocommerce-form__input-checkbox {
                width: auto !important;
                margin-right: 8px !important;
            }

            /* Buttons */
            .woocommerce-button,
            .woocommerce-Button {
                background: #007bff !important;
                color: #fff !important;
                padding: 12px 30px !important;
                border: none !important;
                border-radius: 5px !important;
                cursor: pointer !important;
                font-size: 16px !important;
                transition: all 0.3s ease !important;
                width: 100% !important;
                margin-top: 10px !important;
            }

            .woocommerce-button:hover,
            .woocommerce-Button:hover {
                background: #0056b3 !important;
                transform: translateY(-2px);
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2) !important;
            }

            /* Lost password */
            .woocommerce-LostPassword {
                text-align: center;
                margin-top: 20px;
            }

            .woocommerce-LostPassword a {
                color: #007bff;
                text-decoration: none;
                font-size: 14px;
            }

            .woocommerce-LostPassword a:hover {
                text-decoration: underline;
            }

            /* Error/Success messages */
            .woocommerce-error,
            .woocommerce-message,
            .woocommerce-info {
                padding: 15px;
                border-radius: 5px;
                margin-bottom: 30px;
                list-style: none;
                border-left: 4px solid;
            }

            .woocommerce-error {
                background: #f8d7da;
                color: #721c24;
                border-left-color: #f5c6cb;
            }

            .woocommerce-message {
                background: #d4edda;
                color: #155724;
                border-left-color: #c3e6cb;
            }

            .woocommerce-error li {
                margin: 0;
            }

            /* Privacy policy */
            .woocommerce-privacy-policy-text {
                font-size: 13px;
                color: #666;
                margin: 20px 0;
                line-height: 1.6;
            }

            .woocommerce-privacy-policy-text a {
                color: #007bff;
            }

            /* Newsletter checkbox */
            .mailchimp-newsletter {
                margin: 20px 0;
            }

            /* Required */
            .required {
                color: #dc3545;
            }

            /* Responsive */
            @media (max-width: 768px) {
                #customer_login {
                    flex-direction: column;
                    gap: 30px;
                }

                .u-column1,
                .u-column2 {
                    padding: 30px 20px;
                }

                .woocommerce {
                    margin: 30px auto;
                }
            }
        </style>
        <?php
    }
}
add_action('wp_head', 'custom_myaccount_styles');

// Ẩn share buttons trên trang My Account
function hide_share_buttons_myaccount($content)
{
    if (is_account_page()) {
        remove_filter('the_content', 'A2A_SHARE_SAVE_add_to_content', 98);
    }
    return $content;
}
add_filter('the_content', 'hide_share_buttons_myaccount', 1);

// Ẩn page title trên My Account
function hide_myaccount_page_title($title)
{
    if (is_account_page() && in_the_loop()) {
        return '';
    }
    return $title;
}
add_filter('the_title', 'hide_myaccount_page_title');
// Remove share buttons hoàn toàn khỏi My Account
function remove_addtoany_myaccount()
{
    if (is_account_page()) {
        wp_dequeue_script('addtoany');
        wp_dequeue_style('addtoany');
    }
}
add_action('wp_enqueue_scripts', 'remove_addtoany_myaccount', 999);

// Custom wrapper cho My Account content
function custom_myaccount_wrapper_start()
{
    echo '<div class="custom-myaccount-container">';
}
add_action('woocommerce_account_content', 'custom_myaccount_wrapper_start', 5);

function custom_myaccount_wrapper_end()
{
    echo '</div>';
}
add_action('woocommerce_account_content', 'custom_myaccount_wrapper_end', 999);

/**
 * ========================================
 * 20+ CUSTOMIZER OPTIONS - ĐỒ ÁN
 * Thêm code này vào functions.php
 * ========================================
 */

function blogshop_customize_register($wp_customize) {
    
    // ====================================
    // 1. HEADER SETTINGS
    // ====================================
    $wp_customize->add_section('header_settings', array(
        'title' => '1. Header Settings',
        'priority' => 30,
    ));
    
    // 1.1 Header Background Color
    $wp_customize->add_setting('header_bg_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bg_color', array(
        'label' => 'Header Background Color',
        'section' => 'header_settings',
    )));
    
    // 1.2 Header Text Color
    $wp_customize->add_setting('header_text_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_text_color', array(
        'label' => 'Header Text Color',
        'section' => 'header_settings',
    )));
    
    // 1.3 Show/Hide Search Bar
    $wp_customize->add_setting('show_search_bar', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_search_bar', array(
        'label' => 'Show Search Bar',
        'section' => 'header_settings',
        'type' => 'checkbox',
    ));
    
    // 1.4 Header Phone Number
    $wp_customize->add_setting('header_phone', array(
        'default' => '1900 xxxx',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('header_phone', array(
        'label' => 'Header Phone Number',
        'section' => 'header_settings',
        'type' => 'text',
    ));
    
    // 1.5 Header Email
    $wp_customize->add_setting('header_email', array(
        'default' => 'info@hfashion.vn',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('header_email', array(
        'label' => 'Header Email',
        'section' => 'header_settings',
        'type' => 'email',
    ));
    
    // ====================================
    // 2. FOOTER SETTINGS
    // ====================================
    $wp_customize->add_section('footer_settings', array(
        'title' => '2. Footer Settings',
        'priority' => 31,
    ));
    
    // 2.1 Footer Background Color
    $wp_customize->add_setting('footer_bg_color', array(
        'default' => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bg_color', array(
        'label' => 'Footer Background Color',
        'section' => 'footer_settings',
    )));
    
    // 2.2 Footer Text Color
    $wp_customize->add_setting('footer_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_text_color', array(
        'label' => 'Footer Text Color',
        'section' => 'footer_settings',
    )));
    
    // 2.3 Footer Copyright Text
    $wp_customize->add_setting('footer_copyright', array(
        'default' => 'Copyright © 2025 H-Fashion. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('footer_copyright', array(
        'label' => 'Footer Copyright Text',
        'section' => 'footer_settings',
        'type' => 'textarea',
    ));
    
    // 2.4 Show/Hide Footer Logo
    $wp_customize->add_setting('show_footer_logo', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_footer_logo', array(
        'label' => 'Show Footer Logo',
        'section' => 'footer_settings',
        'type' => 'checkbox',
    ));
    
    // ====================================
    // 3. SOCIAL MEDIA SETTINGS
    // ====================================
    $wp_customize->add_section('social_media', array(
        'title' => '3. Social Media',
        'priority' => 32,
    ));
    
    // 3.1 Facebook URL
    $wp_customize->add_setting('facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('facebook_url', array(
        'label' => 'Facebook URL',
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // 3.2 Instagram URL
    $wp_customize->add_setting('instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('instagram_url', array(
        'label' => 'Instagram URL',
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // 3.3 Twitter URL
    $wp_customize->add_setting('twitter_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('twitter_url', array(
        'label' => 'Twitter URL',
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // 3.4 YouTube URL
    $wp_customize->add_setting('youtube_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('youtube_url', array(
        'label' => 'YouTube URL',
        'section' => 'social_media',
        'type' => 'url',
    ));
    
    // ====================================
    // 4. THEME COLORS
    // ====================================
    $wp_customize->add_section('theme_colors', array(
        'title' => '4. Theme Colors',
        'priority' => 33,
    ));
    
    // 4.1 Primary Color
    $wp_customize->add_setting('primary_color', array(
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_color', array(
        'label' => 'Primary Color',
        'section' => 'theme_colors',
    )));
    
    // 4.2 Secondary Color
    $wp_customize->add_setting('secondary_color', array(
        'default' => '#6c757d',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_color', array(
        'label' => 'Secondary Color',
        'section' => 'theme_colors',
    )));
    
    // 4.3 Link Color
    $wp_customize->add_setting('link_color', array(
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label' => 'Link Color',
        'section' => 'theme_colors',
    )));
    
    // 4.4 Button Background Color
    $wp_customize->add_setting('button_bg_color', array(
        'default' => '#007bff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_bg_color', array(
        'label' => 'Button Background Color',
        'section' => 'theme_colors',
    )));
    
    // 4.5 Button Text Color
    $wp_customize->add_setting('button_text_color', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'button_text_color', array(
        'label' => 'Button Text Color',
        'section' => 'theme_colors',
    )));
    
    // ====================================
    // 5. TYPOGRAPHY SETTINGS
    // ====================================
    $wp_customize->add_section('typography_settings', array(
        'title' => '5. Typography',
        'priority' => 34,
    ));
    
    // 5.1 Body Font Size
    $wp_customize->add_setting('body_font_size', array(
        'default' => '15',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('body_font_size', array(
        'label' => 'Body Font Size (px)',
        'section' => 'typography_settings',
        'type' => 'number',
        'input_attrs' => array('min' => 12, 'max' => 24),
    ));
    
    // 5.2 Heading Font Size
    $wp_customize->add_setting('heading_font_size', array(
        'default' => '32',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('heading_font_size', array(
        'label' => 'Heading Font Size (px)',
        'section' => 'typography_settings',
        'type' => 'number',
        'input_attrs' => array('min' => 20, 'max' => 50),
    ));
    
    // ====================================
    // 6. HOMEPAGE SETTINGS
    // ====================================
    $wp_customize->add_section('homepage_settings', array(
        'title' => '6. Homepage Options',
        'priority' => 35,
    ));
    
    // 6.1 Show Featured Products
    $wp_customize->add_setting('show_featured_products', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_featured_products', array(
        'label' => 'Show Featured Products',
        'section' => 'homepage_settings',
        'type' => 'checkbox',
    ));
    
    // 6.2 Number of Products to Show
    $wp_customize->add_setting('homepage_products_count', array(
        'default' => '8',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('homepage_products_count', array(
        'label' => 'Number of Products',
        'section' => 'homepage_settings',
        'type' => 'number',
        'input_attrs' => array('min' => 4, 'max' => 20),
    ));
    
    // 6.3 Homepage Banner Text
    $wp_customize->add_setting('homepage_banner_text', array(
        'default' => 'Chào mừng đến với H-Fashion',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('homepage_banner_text', array(
        'label' => 'Homepage Banner Text',
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // 6.4 Homepage Banner Subtext
    $wp_customize->add_setting('homepage_banner_subtext', array(
        'default' => 'Style Your Story',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('homepage_banner_subtext', array(
        'label' => 'Homepage Banner Subtext',
        'section' => 'homepage_settings',
        'type' => 'text',
    ));
    
    // ====================================
    // 7. SHOP/PRODUCT SETTINGS
    // ====================================
    $wp_customize->add_section('shop_settings', array(
        'title' => '7. Shop Settings',
        'priority' => 36,
    ));
    
    // 7.1 Products Per Page
    $wp_customize->add_setting('products_per_page', array(
        'default' => '12',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('products_per_page', array(
        'label' => 'Products Per Page',
        'section' => 'shop_settings',
        'type' => 'number',
        'input_attrs' => array('min' => 8, 'max' => 24),
    ));
    
    // 7.2 Show Product Views Count
    $wp_customize->add_setting('show_product_views', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_product_views', array(
        'label' => 'Show Product Views Count',
        'section' => 'shop_settings',
        'type' => 'checkbox',
    ));
    
    // 7.3 Show Sale Badge
    $wp_customize->add_setting('show_sale_badge', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_sale_badge', array(
        'label' => 'Show Sale Badge',
        'section' => 'shop_settings',
        'type' => 'checkbox',
    ));
    
    // ====================================
    // 8. BLOG SETTINGS
    // ====================================
    $wp_customize->add_section('blog_settings', array(
        'title' => '8. Blog Settings',
        'priority' => 37,
    ));
    
    // 8.1 Blog Layout
    $wp_customize->add_setting('blog_layout', array(
        'default' => 'grid',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('blog_layout', array(
        'label' => 'Blog Layout',
        'section' => 'blog_settings',
        'type' => 'select',
        'choices' => array(
            'grid' => 'Grid',
            'list' => 'List',
            'masonry' => 'Masonry',
        ),
    ));
    
    // 8.2 Show Post Date
    $wp_customize->add_setting('show_post_date', array(
        'default' => true,
        'sanitize_callback' => 'blogshop_sanitize_checkbox_strict',
    ));
    $wp_customize->add_control('show_post_date', array(
        'label' => 'Show Post Date',
        'section' => 'blog_settings',
        'type' => 'checkbox',
    ));
    
    // 8.3 Show Post Author
    $wp_customize->add_setting('show_post_author', array(
        'default' => true,
        'sanitize_callback' => 'blogshop_sanitize_checkbox_strict',
    ));
    $wp_customize->add_control('show_post_author', array(
        'label' => 'Show Post Author',
        'section' => 'blog_settings',
        'type' => 'checkbox',
    ));
    
    // ====================================
    // 9. CONTACT INFO SETTINGS
    // ====================================
    $wp_customize->add_section('contact_info', array(
        'title' => '9. Contact Info',
        'priority' => 38,
    ));
    
    // 9.1 Company Address
    $wp_customize->add_setting('company_address', array(
        'default' => '123 Nguyễn Văn Linh, Q.7, TP.HCM',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('company_address', array(
        'label' => 'Company Address',
        'section' => 'contact_info',
        'type' => 'textarea',
    ));
    
    // 9.2 Company Phone
    $wp_customize->add_setting('company_phone', array(
        'default' => '1900 xxxx',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('company_phone', array(
        'label' => 'Company Phone',
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // 9.3 Company Email
    $wp_customize->add_setting('company_email', array(
        'default' => 'info@hfashion.vn',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('company_email', array(
        'label' => 'Company Email',
        'section' => 'contact_info',
        'type' => 'email',
    ));
    
    // 9.4 Working Hours
    $wp_customize->add_setting('working_hours', array(
        'default' => 'Mon - Fri: 9:00 - 18:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('working_hours', array(
        'label' => 'Working Hours',
        'section' => 'contact_info',
        'type' => 'text',
    ));
    
    // ====================================
    // 10. PROMOTIONAL BANNER
    // ====================================
    $wp_customize->add_section('promo_banner', array(
        'title' => '10. Promotional Banner',
        'priority' => 39,
    ));
    
    // 10.1 Show Promo Banner
    $wp_customize->add_setting('show_promo_banner', array(
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_promo_banner', array(
        'label' => 'Show Promotional Banner',
        'section' => 'promo_banner',
        'type' => 'checkbox',
    ));
    
    // 10.2 Promo Banner Text
    $wp_customize->add_setting('promo_banner_text', array(
        'default' => 'Sale up to 50% OFF!',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('promo_banner_text', array(
        'label' => 'Promo Banner Text',
        'section' => 'promo_banner',
        'type' => 'text',
    ));
    
    // 10.3 Promo Banner Link
    $wp_customize->add_setting('promo_banner_link', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('promo_banner_link', array(
        'label' => 'Promo Banner Link',
        'section' => 'promo_banner',
        'type' => 'url',
    ));
    // ====================================
    // 11. SIDEBAR SETTINGS
    // ====================================
    $wp_customize->add_section('sidebar_settings', array(
        'title' => '11. Sidebar Settings',
        'priority' => 40,
    ));
    
    // 11.1 Sidebar Position
    $wp_customize->add_setting('sidebar_position', array(
        'default' => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('sidebar_position', array(
        'label' => 'Sidebar Position',
        'section' => 'sidebar_settings',
        'type' => 'select',
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
            'none' => 'No Sidebar',
        ),
    ));
    
    // 11.2 Sidebar Width
    $wp_customize->add_setting('sidebar_width', array(
        'default' => '30',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('sidebar_width', array(
        'label' => 'Sidebar Width (%)',
        'section' => 'sidebar_settings',
        'type' => 'number',
        'input_attrs' => array('min' => 20, 'max' => 40),
    ));
    
    // ====================================
    // 12. BREADCRUMB SETTINGS
    // ====================================
    $wp_customize->add_section('breadcrumb_settings', array(
        'title' => '12. Breadcrumb Settings',
        'priority' => 41,
    ));
    
    // 12.1 Show Breadcrumb
    $wp_customize->add_setting('show_breadcrumb', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_breadcrumb', array(
        'label' => 'Show Breadcrumb',
        'section' => 'breadcrumb_settings',
        'type' => 'checkbox',
    ));
    
    // 12.2 Breadcrumb Separator
    $wp_customize->add_setting('breadcrumb_separator', array(
        'default' => '/',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('breadcrumb_separator', array(
        'label' => 'Breadcrumb Separator',
        'section' => 'breadcrumb_settings',
        'type' => 'text',
    ));
    
    // ====================================
    // 13. LOADING ANIMATION
    // ====================================
    $wp_customize->add_section('loading_animation', array(
        'title' => '13. Loading Animation',
        'priority' => 42,
    ));
    
    // 13.1 Show Loading Screen
    $wp_customize->add_setting('show_loading_screen', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_loading_screen', array(
        'label' => 'Show Loading Screen',
        'section' => 'loading_animation',
        'type' => 'checkbox',
    ));
    
    // 13.2 Loading Animation Type
    $wp_customize->add_setting('loading_animation_type', array(
        'default' => 'spinner',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('loading_animation_type', array(
        'label' => 'Animation Type',
        'section' => 'loading_animation',
        'type' => 'select',
        'choices' => array(
            'spinner' => 'Spinner',
            'dots' => 'Dots',
            'bars' => 'Bars',
        ),
    ));
    
    // ====================================
    // 14. SCROLL TO TOP BUTTON
    // ====================================
    $wp_customize->add_section('scroll_to_top', array(
        'title' => '14. Scroll to Top',
        'priority' => 43,
    ));
    
    // 14.1 Show Scroll Button
    $wp_customize->add_setting('show_scroll_top', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('show_scroll_top', array(
        'label' => 'Show Scroll to Top Button',
        'section' => 'scroll_to_top',
        'type' => 'checkbox',
    ));
    
    // 14.2 Button Position
    $wp_customize->add_setting('scroll_button_position', array(
        'default' => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('scroll_button_position', array(
        'label' => 'Button Position',
        'section' => 'scroll_to_top',
        'type' => 'select',
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
        ),
    ));
    
    // ====================================
    // 15. NEWSLETTER POPUP
    // ====================================
    $wp_customize->add_section('newsletter_popup', array(
        'title' => '15. Newsletter Popup',
        'priority' => 44,
    ));
    
    // 15.1 Enable Newsletter Popup
    $wp_customize->add_setting('enable_newsletter_popup', array(
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('enable_newsletter_popup', array(
        'label' => 'Enable Newsletter Popup',
        'section' => 'newsletter_popup',
        'type' => 'checkbox',
    ));
    
    // 15.2 Popup Title
    $wp_customize->add_setting('newsletter_popup_title', array(
        'default' => 'Subscribe to Newsletter',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('newsletter_popup_title', array(
        'label' => 'Popup Title',
        'section' => 'newsletter_popup',
        'type' => 'text',
    ));
    
    // 15.3 Popup Delay (seconds)
    $wp_customize->add_setting('newsletter_popup_delay', array(
        'default' => '5',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('newsletter_popup_delay', array(
        'label' => 'Popup Delay (seconds)',
        'section' => 'newsletter_popup',
        'type' => 'number',
        'input_attrs' => array('min' => 0, 'max' => 30),
    ));
}
add_action('customize_register', 'blogshop_customize_register');

/**
 * ========================================
 * OUTPUT CSS FROM CUSTOMIZER
 * ========================================
 */
function blogshop_customizer_css() {
    ?>
    <style type="text/css">
        /* Header Colors */
        .navbar {
            background-color: <?php echo get_theme_mod('header_bg_color', '#ffffff'); ?>;
            color: <?php echo get_theme_mod('header_text_color', '#000000'); ?>;
        }
        
        /* Footer Colors */
        footer {
            background-color: <?php echo get_theme_mod('footer_bg_color', '#000000'); ?>;
            color: <?php echo get_theme_mod('footer_text_color', '#ffffff'); ?>;
        }
        
        /* Theme Colors */
        .btn-primary,
        .woocommerce-button {
            background-color: <?php echo get_theme_mod('button_bg_color', '#007bff'); ?> !important;
            color: <?php echo get_theme_mod('button_text_color', '#ffffff'); ?> !important;
        }
        
        a {
            color: <?php echo get_theme_mod('link_color', '#007bff'); ?>;
        }
        
        /* Typography */
        body {
            font-size: <?php echo get_theme_mod('body_font_size', '15'); ?>px;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-size: <?php echo get_theme_mod('heading_font_size', '32'); ?>px;
        }
    </style>
    <?php
}
add_action('wp_head', 'blogshop_customizer_css');

/**
 * Apply Customizer Settings to Frontend
 */
function blogshop_apply_customizer_settings() {
    ?>
    <style type="text/css">
        /* Apply all customizer colors and settings */
        :root {
            --primary-color: <?php echo get_theme_mod('primary_color', '#007bff'); ?>;
            --secondary-color: <?php echo get_theme_mod('secondary_color', '#6c757d'); ?>;
            --link-color: <?php echo get_theme_mod('link_color', '#007bff'); ?>;
            --button-bg: <?php echo get_theme_mod('button_bg_color', '#007bff'); ?>;
            --button-text: <?php echo get_theme_mod('button_text_color', '#ffffff'); ?>;
        }
        
        /* Typography */
        body {
            font-size: <?php echo get_theme_mod('body_font_size', '15'); ?>px !important;
        }
        
        h1 { font-size: calc(<?php echo get_theme_mod('heading_font_size', '32'); ?>px * 1.5); }
        h2 { font-size: calc(<?php echo get_theme_mod('heading_font_size', '32'); ?>px * 1.2); }
        h3 { font-size: <?php echo get_theme_mod('heading_font_size', '32'); ?>px; }
        
        /* Links */
        a {
            color: var(--link-color);
        }
        
        /* Buttons */
        .btn-primary,
        .woocommerce-button,
        button[type="submit"] {
            background-color: var(--button-bg) !important;
            color: var(--button-text) !important;
            border-color: var(--button-bg) !important;
        }
        
        /* Sidebar */
        <?php if (get_theme_mod('sidebar_position', 'right') == 'none') : ?>
        .sidebar {
            display: none;
        }
        .main-content {
            width: 100% !important;
        }
        <?php endif; ?>
        
        /* Breadcrumb */
        <?php if (!get_theme_mod('show_breadcrumb', true)) : ?>
        .breadcrumbs {
            display: none;
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'blogshop_apply_customizer_settings');

/**
 * Register Footer Menu
 */
function blogshop_register_footer_menu() {
    register_nav_menus(array(
        'footer-menu' => __('Footer Menu', 'blogshop'),
    ));
}
add_action('after_setup_theme', 'blogshop_register_footer_menu');

/**
 * Display Breadcrumb with Custom Separator
 */
function blogshop_breadcrumb() {
    if (!get_theme_mod('show_breadcrumb', true)) {
        return;
    }
    
    $separator = get_theme_mod('breadcrumb_separator', '/');
    
    if (function_exists('woocommerce_breadcrumb')) {
        woocommerce_breadcrumb(array(
            'delimiter' => ' <span>' . esc_html($separator) . '</span> ',
        ));
    }
}

/**
 * Apply Products Per Page Setting
 */
function blogshop_products_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        $query->set('posts_per_page', get_theme_mod('products_per_page', '12'));
    }
}
add_action('pre_get_posts', 'blogshop_products_per_page');

/**
 * Show Product Views if Enabled
 */
function blogshop_display_product_views() {
    if (get_theme_mod('show_product_views', true) && function_exists('custom_get_post_views')) {
        $views = custom_get_post_views();
        echo '<div class="product-views" style="color: #666; font-size: 14px; margin: 10px 0;">';
        echo '👁️ <strong>' . number_format_i18n($views) . '</strong> lượt xem';
        echo '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'blogshop_display_product_views', 15);

/**
 * Đảm bảo giá trị trả về của Checkbox là TRUE hoặc FALSE.
 * Nếu không có giá trị nào được gửi đến Customizer (khi unchecked), 
 * hàm sẽ trả về FALSE.
 */
function blogshop_sanitize_checkbox_strict($checked) {
    // Nếu biến $checked tồn tại VÀ giá trị của nó là true, thì trả về true, ngược lại trả về false.
    // Điều này xử lý trường hợp khi checkbox bị unchecked thì $checked không tồn tại.
    return ( (isset($checked) && true == $checked) ? true : false );
}

// Custom Add to Cart button class
add_filter('woocommerce_loop_add_to_cart_link', 'custom_add_to_cart_class', 10, 2);
function custom_add_to_cart_class($html, $product) {
    $html = str_replace('class="button', 'class="add-to-cart text-center py-2 mr-1', $html);
    return $html;
}
?>