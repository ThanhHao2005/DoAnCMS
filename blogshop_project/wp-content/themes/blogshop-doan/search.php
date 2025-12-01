<?php
/**
 * Search Results Template
 */
get_header(); ?>
<style>
    /* Search Form Styles */
.woocommerce-product-search {
    margin: 20px 0;
}

.woocommerce-product-search .input-group {
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    border-radius: 50px;
    overflow: hidden;
}

.woocommerce-product-search .search-field {
    border: none;
    padding: 15px 25px;
    font-size: 16px;
}

.woocommerce-product-search .btn {
    padding: 15px 30px;
    border: none;
}

/* Search Results Page */
.search-results .product {
    margin-bottom: 30px;
}
/* =======================================
   PHÂN TRANG (PAGINATION) - Phiên bản Lớn và Nổi bật
   ======================================= */

/* 1. Thiết lập chung cho khối phân trang */
.col-md-12.text-center .pagination {
    margin-top: 40px; 
    margin-bottom: 60px; 
    display: inline-block;
    padding: 0;
}


/* 3. Thiết lập cho từng mục (li) và Tăng khoảng cách */
.page-numbers li {
    margin: 0 7px; /* Tăng khoảng cách giữa các số */
}

/* 4. Thiết lập cho Liên kết (a) và Văn bản (span) */
.page-numbers a,
.page-numbers span {
    display: block;
    padding: 10px 18px; /* Tăng Padding để nút to hơn */
    border: 2px solid #ced4da; /* Tăng độ dày viền */
    border-radius: 6px; /* Bo tròn nhẹ */
    text-decoration: none;
    font-size: 18px; /* Tăng Font size */
    font-weight: 600; /* Chữ đậm hơn */
    color: #343a40; /* Màu chữ tối */
    background-color: #ffffff; /* Thêm background trắng (hoặc màu nhẹ khác) */
    transition: all 0.3s ease;
}

/* 5. Trạng thái Hover (di chuột) */
.page-numbers a:hover {
    background-color: #e9ecef; /* Background xám nhạt khi hover */
    border-color: #6c757d; /* Viền tối hơn khi hover */
    color: #000;
}

/* 6. Trạng thái số trang HIỆN TẠI (Active/Current Page) */
.page-numbers .current {
    /* Màu nền chính (Primary color) */
    background-color: var(--primary, #007bff); 
    border-color: var(--primary, #007bff);
    color: #ffffff; 
    cursor: default;
    /* Thêm shadow nhẹ cho nổi bật */
    box-shadow: 0 2px 4px rgba(0, 123, 255, 0.4); 
}

/* 7. Thiết lập cho nút 'Trước' và 'Sau' */
.page-numbers .prev,
.page-numbers .next {
    font-weight: 700;
}
</style>
<section class="ftco-section bg-light">
    <div class="container">
        <!-- Header Search Results -->
        <div class="row justify-content-center mb-3 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">
                    <?php 
                    if (have_posts()) {
                        echo 'Kết quả tìm kiếm cho: "' . get_search_query() . '"';
                    } else {
                        echo 'Không tìm thấy kết quả cho: "' . get_search_query() . '"';
                    }
                    ?>
                </h2>
                <p>
                    <?php 
                    if (have_posts()) {
                        echo 'Tìm thấy ' . $wp_query->found_posts . ' sản phẩm';
                    }
                    ?>
                </p>
            </div>
        </div>

        <!-- Search Form lại -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url(home_url('/')); ?>">
                    <div class="input-group">
                        <input type="search" 
                               class="form-control search-field" 
                               placeholder="Tìm kiếm sản phẩm..." 
                               value="<?php echo get_search_query(); ?>" 
                               name="s" />
                        <input type="hidden" name="post_type" value="product" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="icon-search"></i> Tìm kiếm
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Results -->
        <div class="row">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    global $product;
                    
                    // Chỉ hiển thị nếu là sản phẩm
                    if (!is_a($product, 'WC_Product')) {
                        continue;
                    }
                    
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
                    
                    if ($is_on_sale && $product->get_regular_price() > 0) {
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
                                <h3>
                                    <a href="<?php echo esc_url($product_permalink); ?>">
                                        <?php echo esc_html($product_title); ?>
                                    </a>
                                </h3>
                                
                                <div class="pricing">
                                    <p class="price"><?php echo $price_html; ?></p>
                                </div>
                                
                                <p class="bottom-area d-flex px-3">
                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" 
                                       class="add-to-cart text-center py-2 mr-1"
                                       data-product_id="<?php echo esc_attr($product_id); ?>">
                                        <span class="ion-ios-cart"></span>
                                        <span><?php echo esc_html($product->add_to_cart_text()); ?></span>
                                    </a>
                                    <a href="<?php echo esc_url($product_permalink); ?>" 
                                       class="buy-now text-center py-2">
                                        Xem chi tiết
                                        <span><i class="ion-ios-arrow-forward"></i></span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                endwhile;
                
                // Pagination
                ?>
                <div class="col-md-12 text-center">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('« Trước', 'blogshop'),
                        'next_text' => __('Sau »', 'blogshop'),
                    ));
                    ?>
                </div>
                
                <?php
                wp_reset_postdata();
            else :
                ?>
                <div class="col-md-12 text-center ftco-animate">
                    <div class="alert alert-info" style="padding: 40px;">
                        <h3>Không tìm thấy sản phẩm nào</h3>
                        <p>Xin lỗi, chúng tôi không tìm thấy sản phẩm phù hợp với từ khóa "<?php echo get_search_query(); ?>"</p>
                        <p>Vui lòng thử lại với từ khóa khác hoặc:</p>
                        <a href="<?php echo get_permalink(wc_get_page_id('shop')); ?>" class="btn btn-primary">
                            Xem tất cả sản phẩm
                        </a>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>