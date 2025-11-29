<?php
/**
 * Template Name: About Page
 * Template cho trang About
 */
get_header(); ?>

<div class="hero-wrap hero-bread"
    style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <p class="breadcrumbs">
                    <?php
                    if (function_exists('woocommerce_breadcrumb')) {
                        woocommerce_breadcrumb([
                            'delimiter' => '<span> / </span>',
                            'wrap_before' => '<span class="mr-2">',
                            'wrap_after' => '</span>'
                        ]);
                    }
                    ?>
                </p>
                <h1 class="mb-0 bread"><?php the_title(); ?></h1>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
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

<!-- Main Content Section -->
<section class="ftco-section">
    <div class="container">
        <?php
        if (have_posts()):
            while (have_posts()):
                the_post();
                ?>
                <div class="row">
                    <div class="col-lg-6 mb-5 ftco-animate">
                        <label><strong>Ảnh 1</strong></label>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/about.jpg"
                            class="img-fluid rounded shadow-lg" alt="<?php the_title(); ?>">
                        <label><strong>Ảnh 2</strong></label>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/about1.jpg"
                            class="img-fluid rounded shadow-lg" alt="<?php the_title(); ?>">
                        <label><strong>Ảnh 3</strong></label>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/about2.jpg"
                            class="img-fluid rounded shadow-lg" alt="<?php the_title(); ?>">
                        <label><strong>Ảnh 4</strong></label>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/about3.jpg"
                            class="img-fluid rounded shadow-lg" alt="<?php the_title(); ?>">
                        <br>
                    </div>
                    <div class="col-lg-6 ftco-animate">
                        <h2 class="mb-4"><?php the_title(); ?></h2>
                        <div class="about-content">
                            <?php the_content(); ?>
                            <h3>🎯 Chào mừng đến với H Fashion!</h3>

                            H Fashion là điểm đến lý tưởng cho những ai yêu thích phong cách thời trang trẻ trung, năng động và
                            đầy cá tính. Với sứ mệnh mang đến sự tự tin và phong cách cho mọi người, chúng tôi tự hào là đối tác
                            đáng tin cậy của hàng ngàn khách hàng trên toàn quốc.

                            <div
                                style="background:#e7f3ff; padding:20px; border-radius:8px; border-left:4px solid #007bff; margin:20px 0;">
                                <strong>💡 Slogan:</strong> "Style Your Story - Tạo nên phong cách, kể câu chuyện của riêng bạn"
                            </div>

                            <h3>📖 Câu chuyện của chúng tôi</h3>

                            Được thành lập vào năm 2020 tại thành phố Hồ Chí Minh, H Fashion bắt đầu từ niềm đam mê bất tận với
                            thời trang và mong muốn mang đến cho giới trẻ Việt Nam những sản phẩm chất lượng cao với mức giá hợp
                            lý. Từ một cửa hàng nhỏ với vỏn vẹn 50 sản phẩm, chúng tôi đã không ngừng lớn mạnh và phát triển.

                            Trải qua hơn <strong>3 năm hoạt động</strong>, H Fashion đã phục vụ hơn <strong>50,000 khách
                                hàng</strong> trên toàn quốc, với hơn <strong>1,000+ mẫu sản phẩm</strong> đa dạng từ áo thun,
                            sơ mi, quần jean, đến phụ kiện thời trang. Mỗi sản phẩm đều được chọn lọc kỹ càng, đảm bảo chất
                            lượng và xu hướng thời trang hiện đại.

                            <h3>🎯 Giá trị cốt lõi</h3>

                            <strong>✓ Chất lượng là trên hết:</strong> Mọi sản phẩm đều được kiểm tra kỹ lưỡng qua 3 công đoạn
                            trước khi đến tay khách hàng. Vải cotton cao cấp, form dáng chuẩn, đường may tỉ mỉ.

                            <strong>✓ Giá cả hợp lý:</strong> Chúng tôi cam kết mang đến mức giá tốt nhất thị trường mà không hy
                            sinh chất lượng. Từ 149,000đ bạn đã có thể sở hữu một sản phẩm thời trang chất lượng.

                            <strong>✓ Giao hàng nhanh chóng:</strong> Đơn hàng được xử lý trong vòng 2 giờ và giao hàng toàn
                            quốc trong 24-48 giờ tại nội thành và 3-5 ngày với tỉnh thành khác.

                            <strong>✓ Dịch vụ tận tâm:</strong> Đội ngũ tư vấn viên giàu kinh nghiệm, nhiệt tình hỗ trợ 24/7 qua
                            Hotline, Facebook, Zalo.

                            <strong>✓ Xu hướng thời trang:</strong> Cập nhật liên tục các xu hướng thời trang mới nhất từ Hàn
                            Quốc, Nhật Bản và châu Âu.

                            <h3>🌟 Tại sao chọn H Fashion?</h3>

                            ✓ Hơn 1,000+ mẫu mã đa dạng, cập nhật liên tục hàng tuần<br>
                            ✓ Chính sách đổi trả trong 7 ngày không cần lý do<br>
                            ✓ Freeship toàn quốc cho đơn hàng từ 500,000đ<br>
                            ✓ Chương trình tích điểm thành viên - Ưu đãi độc quyền<br>
                            ✓ Hỗ trợ thanh toán đa dạng: COD, Banking, Ví điện tử<br>
                            ✓ Size chart chi tiết giúp bạn chọn size chuẩn nhất<br>
                            ✓ Đóng gói cẩn thận, giao hàng an toàn<br>
                            ✓ Bảo hành sản phẩm trong 30 ngày

                            <h3>💖 Cam kết của H Fashion</h3>

                            <strong>✓ 100% hàng chính hãng:</strong> Chúng tôi cam kết không bán hàng fake, hàng kém chất lượng.

                            <strong>✓ Kiểm tra kỹ trước khi giao:</strong> Mỗi đơn hàng đều được kiểm tra, đóng gói cẩn thận.

                            <strong>✓ Hỗ trợ đổi size miễn phí:</strong> Nếu sản phẩm không vừa, chúng tôi hỗ trợ đổi size hoàn
                            toàn miễn phí.

                            <strong>✓ Hoàn tiền 100%:</strong> Nếu sản phẩm lỗi do nhà sản xuất hoặc vận chuyển.

                            <div
                                style="background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); color:white; padding:30px; border-radius:10px; text-align:center; margin-top:30px;">
                                <h3 style="color:white; margin:0 0 15px 0;">🛍️ Hãy đến với H Fashion để trải nghiệm mua sắm
                                    tuyệt vời nhất!</h3>
                                <p style="margin:0;">Hotline: <strong>1900 xxxx</strong> | Email:
                                    <strong>support@hfashion.vn</strong>
                                </p>
                                <p style="margin:10px 0 0 0; font-size:14px;">Địa chỉ: 123 Nguyễn Văn Linh, Q.7, TP.HCM</p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
        endif;
        ?>
    </div>
</section>

<!-- Statistics Section -->
<section class="ftco-section ftco-counter img"
    style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/bg_3.jpg);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="50000">0</strong>
                                <span>Khách hàng</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="1000">0</strong>
                                <span>Sản phẩm</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="100">0</strong>
                                <span>Đối tác</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                        <div class="block-18 text-center">
                            <div class="text">
                                <strong class="number" data-number="99">0</strong>
                                <span>% Hài lòng</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="ftco-section testimony-section">
    <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
            <div class="col-md-12 heading-section text-center ftco-animate">
                <h2 class="mb-4">Khách hàng nói gì về chúng tôi</h2>
                <p>Những đánh giá chân thực từ khách hàng đã tin tựởng H Fashion</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
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
                                    Sản phẩm chất lượng tốt, giao hàng nhanh chóng.
                                    Tôi rất hài lòng với dịch vụ của H Fashion!
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
                                    Mẫu mã đa dạng, giá cả phải chăng.
                                    Đội ngũ tư vấn nhiệt tình. Sẽ ủng hộ lâu dài!
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
                                    Đã mua hơn 10 lần, chưa lần nào thất vọng.
                                    Shop uy tín, đáng tin cậy!
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

<!-- Custom CSS -->
<style>
    /* About Content Styling */
    .about-content {
        font-size: 15px;
        line-height: 1.8;
        color: #333;
    }

    .about-content h3 {
        color: #007bff;
        margin-top: 30px;
        margin-bottom: 15px;
        font-size: 22px;
        font-weight: 600;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
    }

    .about-content h3:first-child {
        margin-top: 0;
    }

    .about-content p {
        margin-bottom: 20px;
        text-align: justify;
    }

    .about-content strong {
        color: #007bff;
        font-weight: 600;
    }

    /* Statistics Counter */
    .ftco-counter {
        position: relative;
        background-size: cover;
        background-position: center;
        padding: 80px 0;
    }

    .ftco-counter:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.7);
    }

    .ftco-counter .container {
        position: relative;
        z-index: 1;
    }

    .ftco-counter .number {
        font-size: 48px;
        color: #fff;
        font-weight: 700;
        display: block;
        margin-bottom: 10px;
    }

    .ftco-counter span {
        color: #fff;
        font-size: 16px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .block-18 {
        padding: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .about-content h3 {
            font-size: 20px;
            margin-top: 20px;
        }

        .about-content {
            font-size: 14px;
        }

        .ftco-counter .number {
            font-size: 36px;
        }
    }
</style>

<?php get_footer(); ?>