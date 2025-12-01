<?php

global $product; // Khai báo $product là biến global

// Nếu $product chưa được load, cố gắng load nó dựa trên ID của bài viết hiện tại.
if ( empty( $product ) ) {
    $product = wc_get_product( get_the_ID() );
}
// Lấy danh sách các tab của sản phẩm (Description, Additional Information, Reviews)
$product_tabs = apply_filters('woocommerce_product_tabs', array());

if (!empty($product_tabs)) : ?>

    <div class="col-md-12 nav-link-wrap">
        <div class="nav nav-pills d-flex text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">

            <?php foreach ($product_tabs as $key => $product_tab) : ?>
                <?php
                // Xác định class active cho tab đầu tiên
                $active_class = (array_key_first($product_tabs) === $key) ? 'active' : '';
                ?>
                <a class="nav-link ftco-animate mr-lg-1 fadeInUp ftco-animated <?php echo esc_attr($active_class); ?>" 
                   id="v-pills-<?php echo esc_attr($key); ?>-tab"
                   data-toggle="pill" 
                   href="#tab-<?php echo esc_attr($key); ?>"
                   role="tab" 
                   aria-controls="tab-<?php echo esc_attr($key); ?>"
                   aria-selected="<?php echo ($active_class) ? 'true' : 'false'; ?>">
                    <?php echo wp_kses_post($product_tab['title']); ?>
                    <?php if ($key === 'reviews' && $product) : ?>
                        (<?php echo $product->get_review_count(); ?>)
                    <?php endif; ?>
                </a>
            <?php endforeach; ?>

        </div>
    </div>

    <div class="tab-content ftco-animate" id="v-pills-tabContent">

        <?php foreach ($product_tabs as $key => $product_tab) : ?>
            <?php
            // Xác định class active cho nội dung tab đầu tiên
            $active_class = (array_key_first($product_tabs) === $key) ? 'active show' : '';
            ?>
            <div class="tab-pane fade <?php echo esc_attr($active_class); ?>" id="tab-<?php echo esc_attr($key); ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo esc_attr($key); ?>-tab">
                <?php if (isset($product_tab['callback'])) {
                    call_user_func($product_tab['callback'], $key, $product_tab);
                } ?>
            </div>
        <?php endforeach; ?>

    </div>

<?php endif; ?>