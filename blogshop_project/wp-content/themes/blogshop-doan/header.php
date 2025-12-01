<?php
/**
 * The header for our theme
 * Chứa phần HTML mở đầu, Meta, CSS (qua wp_head) và Navbar
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <!-- Các thẻ meta đã được thay thế bằng hàm WordPress -->
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title('|', true, 'right'); ?></title>

    <!-- Link Font Google (chuyển sang PHP để đảm bảo Theme hoạt động) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <?php wp_head(); ?> <!-- BẮT BUỘC: Đặt trước </head> để load CSS/JS -->
    <style>
        .header-contact {
            /* Giảm gap giữa các thành phần liên hệ */
            gap: 10px;
            font-size: 13px;
            /* Thu nhỏ font */
        }

        /* Giảm margin giữa các mục liên hệ (từ 10px xuống 5px) */
        .header-contact span {
            margin: 0 5px;
        }

        /* Thu gọn thanh tìm kiếm */
        .header-search form {
            display: flex;
            align-items: center;
        }

        .header-search input[type="search"] {
            max-width: 120px;
            /* Giới hạn chiều rộng input tìm kiếm */
            padding: 5px 8px;
            /* Giảm padding */
            font-size: 14px;
        }

        /* Quan trọng: Giảm Padding của Navbar */
        .navbar-nav .nav-link {
            padding-right: 8px !important;
            padding-left: 8px !important;
            font-size: 14px;
            /* Thu nhỏ font menu */
        }

        /* Đảm bảo Menu và các thành phần khác được sắp xếp gọn gàng */
        .collapse.navbar-collapse {
            /* Cho phép Menu, Contact và Search cùng nằm trên 1 hàng */
            display: flex !important;
            justify-content: space-between;
        }
    </style>

</head>

<body <?php body_class('goto-here'); ?>>

    <?php wp_body_open(); ?>
    <?php
    // 1. Lấy giá trị từ Customizer
    $show_banner = get_theme_mod('show_promo_banner', false);
    $banner_text = get_theme_mod('promo_banner_text', 'Sale up to 50% OFF!');
    $banner_link = get_theme_mod('promo_banner_link', '');

    // 2. Kiểm tra nếu banner được bật
    if ($show_banner):
        ?>
        <div class="promo-banner text-center py-2 bg-danger text-white">
            <?php if (!empty($banner_link)): ?>
                <a href="<?php echo esc_url($banner_link); ?>" class="text-white" style="text-decoration: none;">
                    <?php echo esc_html($banner_text); ?>
                </a>
            <?php else: ?>
                <span><?php echo esc_html($banner_text); ?></span>
            <?php endif; ?>
        </div>
    <?php
    endif;
    ?>

    <!-- LOADER (Giữ nguyên vị trí ban đầu của HTML mẫu) -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>
    <!-- END LOADER -->

    <!-- MAIN NAVIGATION (Chuyển sang PHP để lấy Menu động) -->

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
            <?php
            // Hiển thị logo nếu có, nếu không thì hiển thị tên site
            if (function_exists('the_custom_logo') && has_custom_logo()) {
                the_custom_logo();
            } else {
                bloginfo('name');
            }
            ?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <!-- Sử dụng hàm WP để hiển thị menu đã đăng ký trong functions.php -->
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary', // Sử dụng vị trí menu đã đăng ký
                'depth' => 2,
                'container' => false,
                'menu_class' => 'navbar-nav ml-auto',
                'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                'walker' => new WP_Bootstrap_Navwalker(), // Cần cài Bootstrap Navwalker nếu muốn menu dropdown
            ));
            ?>
            <div class="header-contact" style="color: <?php echo get_theme_mod('header_text_color', '#000000'); ?>;">
                <?php if (get_theme_mod('header_phone')): ?>
                    <span class="header-phone">
                        📞 <?php echo esc_html(get_theme_mod('header_phone', '1900 xxxx')); ?>
                    </span>
                <?php endif; ?>

                <?php if (get_theme_mod('header_email')): ?>
                    <span class="header-email">
                        ✉️ <?php echo esc_html(get_theme_mod('header_email', 'info@hfashion.vn')); ?>
                    </span>
                <?php endif; ?>
            </div>
            <!-- Search Bar -->
            <?php if (get_theme_mod('show_search_bar', true)): ?>
                <div class="header-search">
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>



        </div>
    </nav>
    <!-- END MAIN NAVIGATION -->
    <style>
        /* Apply Customizer Colors */
        .navbar {
            background-color:
                <?php echo get_theme_mod('header_bg_color', '#ffffff'); ?>
                !important;
        }

        .navbar-brand,
        .navbar-nav .nav-link {
            color:
                <?php echo get_theme_mod('header_text_color', '#000000'); ?>
                !important;
        }

        .btn-primary,
        .woocommerce-button {
            background-color:
                <?php echo get_theme_mod('button_bg_color', '#007bff'); ?>
                !important;
            color:
                <?php echo get_theme_mod('button_text_color', '#ffffff'); ?>
                !important;
        }

        a {
            color:
                <?php echo get_theme_mod('link_color', '#007bff'); ?>
            ;
        }

        body {
            font-size:
                <?php echo get_theme_mod('body_font_size', '15'); ?>
                px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size:
                <?php echo get_theme_mod('heading_font_size', '32'); ?>
                px;
        }

        /* Promo Banner */
        .promo-banner {
            font-weight: 600;
            z-index: 9999;
            position: relative;
        }

        /* Header Contact */
        .header-contact {
            display: flex;
            gap: 20px;
            font-size: 14px;
        }

        .header-contact span {
            margin: 0 10px;
        }

        @media (max-width: 768px) {
            .header-contact {
                display: none;
            }
        }
    </style>
    <!-- Bắt đầu phần nội dung chính -->
    <div id="main-content">