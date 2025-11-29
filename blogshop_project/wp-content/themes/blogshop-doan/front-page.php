<?php
/**
 * The main template file - với Customizer Options
 */
get_header(); ?>

<!-- Hero Slider Section với Customizer -->
<section id="home-section" class="hero">
    <div class="home-slider owl-carousel">
        <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-md-flex no-gutters slider-text align-items-center justify-content-end"
                    data-scrollax-parent="true">
                    <img class="one-third order-md-last img-fluid"
                        src="<?php echo get_template_directory_uri(); ?>/images/bg_1.png" alt="" />
                    <div class="one-forth d-flex align-items-center ftco-animate"
                        data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading">#New Arrival</span>
                            <div class="horizontal">
                                <!-- ✅ Sử dụng Customizer Option -->
                                <h1 class="mb-4 mt-3">
                                    <?php echo esc_html(get_theme_mod('homepage_banner_text', 'Chào mừng đến với H-Fashion')); ?>
                                </h1>
                                <p class="mb-4">
                                    <?php echo esc_html(get_theme_mod('homepage_banner_subtext', 'Style Your Story')); ?>
                                </p>
                                <p><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>"
                                        class="btn-custom">Khám phá ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item js-fullheight">
            <div class="overlay"></div>
            <div class="container-fluid p-0">
                <div class="row d-flex no-gutters slider-text align-items-center justify-content-end"
                    data-scrollax-parent="true">
                    <img class="one-third order-md-last img-fluid"
                        src="<?php echo get_template_directory_uri(); ?>/images/bg_2.png" alt="" />
                    <div class="one-forth d-flex align-items-center ftco-animate"
                        data-scrollax=" properties: { translateY: '70%' }">
                        <div class="text">
                            <span class="subheading">#Hot Sale</span>
                            <div class="horizontal">
                                <h1 class="mb-4 mt-3">Bộ Sưu Tập Mới 2025</h1>
                                <p class="mb-4">Khám phá phong cách thời trang hiện đại, trẻ trung</p>
                                <p><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn-custom">Mua
                                        ngay</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="ftco-section ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row no-gutters ftco-services">
            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-bag"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Miễn phí vận chuyển</h3>
                        <p>Freeship cho đơn hàng từ 500,000đ trên toàn quốc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-customer-service"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Hỗ trợ 24/7</h3>
                        <p>Đội ngũ tư vấn nhiệt tình, sẵn sàng hỗ trợ mọi lúc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                <div class="media block-6 services p-4 py-md-5">
                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                        <span class="flaticon-payment-security"></span>
                    </div>
                    <div class="media-body">
                        <h3 class="heading">Thanh toán an toàn</h3>
                        <p>Bảo mật thông tin, đa dạng phương thức thanh toán</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Section với Customizer -->
<?php if (get_theme_mod('show_featured_products', true)): ?>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Sản Phẩm Nổi Bật</h2>
                    <p>Khám phá những sản phẩm thời trang hot nhất hiện nay</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <?php
                // ✅ Sử dụng Customizer Option cho số lượng sản phẩm
                $products_count = get_theme_mod('homepage_products_count', '8');

                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => $products_count,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_visibility',
                            'field' => 'name',
                            'terms' => 'exclude-from-catalog',
                            'operator' => 'NOT IN',
                        ),
                    )
                );
                $latest_products = new WP_Query($args);

                if ($latest_products->have_posts()):
                    while ($latest_products->have_posts()):
                        $latest_products->the_post();

                        global $product;
                        $product_id = $product->get_id();
                        $product_permalink = get_permalink();
                        $product_title = get_the_title();
                        $price_html = $product->get_price_html();
                        $image_url = get_the_post_thumbnail_url($product_id, 'woocommerce_thumbnail');

                        if (!$image_url) {
                            $image_url = 'https://placehold.co/300x300/e9ecef/212529?text=Product+Image';
                        }

                        $is_on_sale = $product->is_on_sale();
                        $sale_tag = '';

                        // ✅ Kiểm tra Customizer Option
                        if (get_theme_mod('show_sale_badge', true) && $is_on_sale && $product->get_regular_price() > 0) {
                            $regular_price = $product->get_regular_price();
                            $sale_price = $product->get_sale_price();
                            $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                            $sale_tag = '<span class="sale">Sale ' . $discount_percentage . '%</span>';
                        }
                        ?>
                        <div class="col-sm-6 col-md-6 col-lg-3 ftco-animate d-flex">
                            <div class="product d-flex flex-column">
                                <a href="<?php echo esc_url($product_permalink); ?>" class="img-prod">
                                    <img class="img-fluid" src="<?php echo esc_url($image_url); ?>"
                                        alt="<?php echo esc_attr($product_title); ?>">
                                    <?php echo $sale_tag; ?>
                                    <div class="overlay"></div>
                                </a>

                                <div class="text py-3 pb-4 px-3">
                                    <div class="d-flex">
                                        <div class="cat">
                                            <span><?php echo wc_get_product_category_list($product_id, ', '); ?></span>
                                        </div>
                                        <div class="rating">
                                            <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                                        </div>
                                    </div>
                                    <h3><a
                                            href="<?php echo esc_url($product_permalink); ?>"><?php echo esc_html($product_title); ?></a>
                                    </h3>

                                    <div class="pricing">
                                        <p class="price"><?php echo $price_html; ?></p>
                                    </div>

                                    <!-- ✅ Hiển thị Product Views nếu bật -->
                                    <?php if (get_theme_mod('show_product_views', true) && function_exists('custom_get_post_views')): ?>
                                        <div class="product-views-small" style="font-size: 12px; color: #666; margin: 5px 0;">
                                            👁️ <?php echo number_format_i18n(custom_get_post_views($product_id)); ?> lượt xem
                                        </div>
                                    <?php endif; ?>

                                    <p class="bottom-area d-flex px-3">
                                        <?php woocommerce_template_loop_add_to_cart(); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<div class="col-md-12 text-center ftco-animate">Chưa có sản phẩm nào.</div>';
                endif;
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Categories Section -->
<section class="ftco-section ftco-choose ftco-no-pb ftco-no-pt">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-4">
                <div class="choose-wrap divider-one img p-5 d-flex align-items-end"
                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/choose-1.jpg)">
                    <div class="text text-center text-white px-2">
                        <span class="subheading">Nam</span>
                        <h2>Bộ Sưu Tập Nam</h2>
                        <p>Phong cách nam tính, mạnh mẽ và lịch lãm</p>
                        <?php
                        $term_link_nam = get_term_link('men', 'product_cat');
                        $link_nam = is_wp_error($term_link_nam) ? '#' : esc_url($term_link_nam);
                        ?>
                        <p><a href="<?php echo $link_nam; ?>" class="btn btn-black px-3 py-2">Xem ngay</a></p>

                        <?php
                        $term_link_nu = get_term_link('Bags', 'product_cat');
                        $link_nu = is_wp_error($term_link_nu) ? '#' : esc_url($term_link_nu);
                        ?>
                        <p><a href="<?php echo $link_nu; ?>" class="btn btn-black px-3 py-2">Xem ngay</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row no-gutters choose-wrap divider-two align-items-stretch">
                    <div class="col-md-12">
                        <div class="choose-wrap full-wrap img align-self-stretch d-flex align-item-center justify-content-end"
                            style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/choose-2.jpg)">
                            <div class="col-md-7 d-flex align-items-center">
                                <div class="text text-white px-5">
                                    <span class="subheading">Nữ</span>
                                    <h2>Bộ Sưu Tập Nữ</h2>
                                    <p>Thời trang nữ thanh lịch, quyến rũ</p>
                                    <p><a href="<?php echo get_term_link('Booking', 'product_cat'); ?>"
                                            class="btn btn-black px-3 py-2">Xem ngay</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row no-gutters">
                            <div class="col-md-6">
                                <div class="choose-wrap wrap img align-self-stretch bg-light d-flex align-items-center">
                                    <div class="text text-center px-5">
                                        <span class="subheading">Khuyến mãi</span>
                                        <h2>Giảm đến 50%</h2>
                                        <p>Sale khủng cho các sản phẩm hot nhất</p>
                                        <p><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>?on_sale=1"
                                                class="btn btn-black px-3 py-2">Mua ngay</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="choose-wrap wrap img align-self-stretch d-flex align-items-center"
                                    style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/choose-3.jpg)">
                                    <div class="text text-center text-white px-5">
                                        <span class="subheading">Phổ biến</span>
                                        <h2>Bán chạy nhất</h2>
                                        <p>Sản phẩm được yêu thích nhất</p>
                                        <p><a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>?orderby=popularity"
                                                class="btn btn-black px-3 py-2">Xem ngay</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Deal Section -->
<section class="ftco-section ftco-deal"
    style="background-color: <?php echo get_theme_mod('primary_color', '#007bff'); ?>;">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo get_template_directory_uri(); ?>/images/prod-1.png" class="img-fluid" alt="" />
            </div>
            <div class="col-md-6">
                <div class="heading-section heading-section-white">
                    <span class="subheading">Deal trong tháng</span>
                    <h2 class="mb-3">Ưu đãi đặc biệt</h2>
                </div>
                <div id="timer" class="d-flex mb-4">
                    <div class="time" id="days"></div>
                    <div class="time pl-4" id="hours"></div>
                    <div class="time pl-4" id="minutes"></div>
                    <div class="time pl-4" id="seconds"></div>
                </div>
                <div class="text-deal">
                    <h2><a href="#">Sản phẩm Hot</a></h2>
                    <p class="price">
                        <span class="mr-2 price-dc">500,000đ</span>
                        <span class="price-sale">250,000đ</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="ftco-section testimony-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="services-flow">
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-bag"></span>
                        </div>
                        <div class="text">
                            <h3>Miễn phí vận chuyển</h3>
                            <p class="mb-0">Freeship toàn quốc cho đơn từ 500k</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-heart-box"></span>
                        </div>
                        <div class="text">
                            <h3>Quà tặng giá trị</h3>
                            <p class="mb-0">Ưu đãi độc quyền cho thành viên</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-payment-security"></span>
                        </div>
                        <div class="text">
                            <h3>Thanh toán an toàn</h3>
                            <p class="mb-0">Bảo mật thông tin 100%</p>
                        </div>
                    </div>
                    <div class="services-2 p-4 d-flex ftco-animate">
                        <div class="icon">
                            <span class="flaticon-customer-service"></span>
                        </div>
                        <div class="text">
                            <h3>Hỗ trợ 24/7</h3>
                            <p class="mb-0">Tư vấn nhiệt tình mọi lúc</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="heading-section ftco-animate mb-5">
                    <h2 class="mb-4">Khách hàng nói gì về chúng tôi</h2>
                    <p>Những đánh giá chân thực từ khách hàng đã tin tưởng H Fashion</p>
                </div>
                <div class="carousel-testimony owl-carousel">
                    <div class="item">
                        <div class="testimony-wrap">
                            <div class="user-img mb-4"
                                style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/person_1.jpg)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text">
                                <p class="mb-4 pl-4 line">
                                    Sản phẩm chất lượng tốt, giao hàng nhanh. Rất hài lòng với H Fashion!
                                </p>
                                <p class="name">Nguyễn Văn A</p>
                                <span class="position">Khách hàng thân thiết</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap">
                            <div class="user-img mb-4"
                                style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/person_2.jpg)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text">
                                <p class="mb-4 pl-4 line">
                                    Mẫu mã đẹp, giá cả hợp lý. Sẽ tiếp tục ủng hộ shop!
                                </p>
                                <p class="name">Trần Thị B</p>
                                <span class="position">Fashionista</span>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-wrap">
                            <div class="user-img mb-4"
                                style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/person_3.jpg)">
                                <span class="quote d-flex align-items-center justify-content-center">
                                    <i class="icon-quote-left"></i>
                                </span>
                            </div>
                            <div class="text">
                                <p class="mb-4 pl-4 line">
                                    Dịch vụ tuyệt vời, sẽ giới thiệu cho bạn bè!
                                </p>
                                <p class="name">Lê Văn C</p>
                                <span class="position">VIP Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>