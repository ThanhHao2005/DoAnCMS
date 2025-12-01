<?php
/**
 * Template Name: Checkout Page
 * Template for WooCommerce Checkout
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<!-- EMERGENCY CHECKOUT CSS -->
<!-- <style>
    /* FINAL CHECKOUT LAYOUT - No debug colors */
    .woocommerce-billing-fields__field-wrapper {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        grid-template-rows: repeat(7, auto) !important;
        gap: 20px !important;
        margin-bottom: 20px !important;
        /* REMOVE background color */
    }

    /* Reset form rows */
    .woocommerce-billing-fields__field-wrapper .form-row {
        all: unset !important;
        display: block !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        float: none !important;
        clear: none !important;
        /* REMOVE background color */
    }

    /* Grid positioning */
    #billing_first_name_field {
        grid-column: 1;
        grid-row: 1;
    }

    #billing_last_name_field {
        grid-column: 2;
        grid-row: 1;
    }

    #billing_company_field {
        grid-column: 1 / -1;
        grid-row: 2;
    }

    #billing_country_field {
        grid-column: 1 / -1;
        grid-row: 3;
    }

    #billing_address_1_field {
        grid-column: 1 / -1;
        grid-row: 4;
    }

    #billing_address_2_field {
        grid-column: 1 / -1;
        grid-row: 5;
    }

    #billing_city_field {
        grid-column: 1;
        grid-row: 6;
    }

    #billing_postcode_field {
        grid-column: 2;
        grid-row: 6;
    }

    #billing_phone_field {
        grid-column: 1;
        grid-row: 7;
    }

    #billing_email_field {
        grid-column: 2;
        grid-row: 7;
    }

    /* Cart & Payment layout */
    .row.mt-5.pt-3.d-flex {
        display: flex !important;
        flex-wrap: nowrap !important;
        gap: 30px !important;
    }

    .row.mt-5.pt-3.d-flex .col-md-6 {
        flex: 1 !important;
        min-width: 0 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .woocommerce-billing-fields__field-wrapper {
            grid-template-columns: 1fr !important;
        }

        .row.mt-5.pt-3.d-flex {
            flex-wrap: wrap !important;
        }
    }
</style> -->
<div class="hero-wrap hero-bread"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <span class="mr-2"><a href="<?php echo home_url(); ?>">Home</a></span>
                    <span>Checkout</span>
                </p>
                <h1 class="mb-0 bread">Checkout</h1>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 ftco-animate">
                <?php
                // Hiển thị thông báo WooCommerce
                wc_print_notices();

                // Kiểm tra nếu giỏ hàng trống
                if (WC()->cart->is_empty()) {
                    echo '<div class="woocommerce-info">';
                    echo '<p>' . esc_html__('Your cart is currently empty.', 'woocommerce') . '</p>';
                    echo '<p class="return-to-shop">';
                    echo '<a class="button wc-backward" href="' . esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))) . '">';
                    echo esc_html__('Return to shop', 'woocommerce');
                    echo '</a>';
                    echo '</p>';
                    echo '</div>';
                } else {
                    // Hiển thị form checkout WooCommerce với custom template
                    wc_get_template('checkout/form-checkout.php', array('checkout' => WC()->checkout()));
                }
                ?>
            </div> <!-- .col-md-8 -->
        </div>
    </div>
</section>
<!-- <script>
    // GIỮ LAYOUT - Chống JavaScript override
    jQuery(document).ready(function ($) {
        function maintainCheckoutLayout() {
            var wrapper = $('.woocommerce-billing-fields__field-wrapper');
            if (wrapper.length) {
                // Force grid layout mỗi 100ms
                wrapper.css({
                    'display': 'grid',
                    'grid-template-columns': '1fr 1fr',
                    'gap': '20px'
                });

                // Reset form rows
                wrapper.find('.form-row').css({
                    'float': 'none',
                    'width': 'auto',
                    'display': 'block'
                });
            }
        }

        // Chạy ngay lập tức
        maintainCheckoutLayout();

        // Chạy lại sau mỗi 100ms để chống override
        setInterval(maintainCheckoutLayout, 100);

        // Chạy lại khi có sự kiện WooCommerce
        $(document).on('updated_checkout', maintainCheckoutLayout);
    });
</script> -->
<?php
get_footer();
?>