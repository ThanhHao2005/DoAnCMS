<?php
if (!defined('ABSPATH')) {
    exit;
}

// Get header
get_header();
?>
<!-- Hero Section -->
<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></span> 
                    <span>Contact</span>
                </p>
                <h1 class="mb-0 bread"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</div>

<?php
// In ra thông báo nếu có
wc_print_notices();

// Kiểm tra giỏ hàng trống
do_action('woocommerce_before_checkout_form_cart_notices');
do_action('woocommerce_check_cart_items');

if (WC()->cart->is_empty() && !is_customize_preview() && apply_filters('woocommerce_checkout_redirect_empty_cart', true)) {
    get_footer();
    return;
}

// Load form checkout template
wc_get_template('checkout/form-checkout.php', array('checkout' => WC()->checkout()));

// Get footer
get_footer();
?>