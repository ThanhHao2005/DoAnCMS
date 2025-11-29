<?php
if (!defined('ABSPATH')) {
    exit;
}

$checkout = WC()->checkout();

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}
?>

<style>
/* =======================================
   1. FIX BỐ CỤC 2 CỘT (QUAN TRỌNG)
   Ép buộc lớp bọc trường form phải là Flexbox để col-md-6 hoạt động
   ======================================= */
.woocommerce-billing-fields__field-wrapper {
    display: flex !important; /* Biến thành Flex container */
    flex-wrap: wrap !important; /* Cho phép các trường xuống dòng */
    justify-content: space-between !important; /* Phân bổ khoảng cách */
    padding: 0 !important;
    margin: 0 !important;
}

/* =======================================
   2. FIX TÁCH BIỆT LABEL VÀ INPUT
   Ép buộc input xuống dòng dưới label
   ======================================= */
.woocommerce-input-wrapper {
    display: block !important;
    width: 100% !important;
    margin-top: 5px; /* Tạo khoảng cách giữa label và input */
}

.billing-form label {
    display: block; 
}

/* Khắc phục xung đột float cũ */
.woocommerce-form-row {
    float: none !important; 
    clear: both !important;
    /* Đảm bảo col-md-6 hoạt động bằng cách reset width/margin */
    width: auto !important; 
    margin: 0 !important;
}
</style>
<form name="checkout" method="post" class="billing-form" action="<?php echo esc_url(wc_get_checkout_url()); ?>"
    enctype="multipart/form-data">

    <?php if ($checkout->get_checkout_fields()): ?>

        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

        <div class="billing-form">
            <h3 class="mb-4 billing-heading"><?php esc_html_e('Billing Details', 'woocommerce'); ?></h3>
            
            <div class="row align-items-end"> 
                <?php do_action('woocommerce_checkout_billing'); ?> 
                
                <?php do_action('woocommerce_checkout_shipping'); ?>

                </div> 
        </div>
        <?php do_action('woocommerce_checkout_after_customer_details'); ?>

    <?php endif; ?>

    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

    <!-- Cart Total & Payment Method - 2 Columns Layout -->
    <div class="row mt-5 pt-3 d-flex">
        <?php do_action('woocommerce_checkout_before_order_review'); ?>

        <!-- Cart Total Column -->
        <div class="col-md-6 d-flex">
            <div class="cart-detail cart-total bg-light p-3 p-md-4 w-100">
                <h3 class="billing-heading mb-4"><?php esc_html_e('Cart Total', 'woocommerce'); ?></h3>

                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php wc_get_template('checkout/review-order.php', array('checkout' => $checkout)); ?>
                </div>
            </div>
        </div>

        <!-- Payment Method Column -->
        <div class="col-md-6">
            <div class="cart-detail bg-light p-3 p-md-4">
                <h3 class="billing-heading mb-4"><?php esc_html_e('Payment Method', 'woocommerce'); ?></h3>

                <?php woocommerce_checkout_payment(); ?>
            </div>
        </div>

        <?php do_action('woocommerce_checkout_after_order_review'); ?>
    </div>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>