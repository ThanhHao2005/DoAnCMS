<?php
/**
 * The template for displaying the footer
 * Chứa phần Footer, các JS scripts (qua wp_footer) và thẻ đóng </body>, </html>
 */
?>

<section class="ftco-gallery">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 heading-section text-center mb-4 ftco-animate">
        <h2 class="mb-4">Follow Us On Instagram</h2>
        <p>
          Far far away, behind the word mountains, far from the countries
          Vokalia and Consonantia, there live the blind texts. Separated
          they live in
        </p>
      </div>
    </div>
  </div>
  <div class="container-fluid px-0">
    <div class="row no-gutters">
      <div class="col-md-4 col-lg-2 ftco-animate">
        <a href="images/gallery-1.jpg" class="gallery image-popup img d-flex align-items-center"
          style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/gallery-1.jpg);">
          <div class="icon mb-4 d-flex align-items-center justify-content-center">
            <span class="icon-instagram"></span>
          </div>
        </a>
      </div>
      <div class="col-md-4 col-lg-2 ftco-animate">
        <a href="images/gallery-2.jpg" class="gallery image-popup img d-flex align-items-center"
          style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/gallery-2.jpg);">
          <div class="icon mb-4 d-flex align-items-center justify-content-center">
            <span class="icon-instagram"></span>
          </div>
        </a>
      </div>
      <div class="col-md-4 col-lg-2 ftco-animate">
        <a href="images/gallery-3.jpg" class="gallery image-popup img d-flex align-items-center"
          style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/gallery-3.jpg);">
          <div class="icon mb-4 d-flex align-items-center justify-content-center">
            <span class="icon-instagram"></span>
          </div>
        </a>
      </div>
      <div class="col-md-4 col-lg-2 ftco-animate">
        <a href="images/gallery-4.jpg" class="gallery image-popup img d-flex align-items-center"
          style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/gallery-4.jpg);">
          <div class="icon mb-4 d-flex align-items-center justify-content-center">
            <span class="icon-instagram"></span>
          </div>
        </a>
      </div>
      <div class="col-md-4 col-lg-2 ftco-animate">
        <a href="images/gallery-5.jpg" class="gallery image-popup img d-flex align-items-center"
          style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/gallery-5.jpg);">
          <div class="icon mb-4 d-flex align-items-center justify-content-center">
            <span class="icon-instagram"></span>
          </div>
        </a>
      </div>
      <div class="col-md-4 col-lg-2 ftco-animate">
        <a href="images/gallery-6.jpg" class="gallery image-popup img d-flex align-items-center"
          style="background-image: url(<?php echo get_template_directory_uri(); ?>/images/gallery-6.jpg);">
          <div class="icon mb-4 d-flex align-items-center justify-content-center">
            <span class="icon-instagram"></span>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
</div><!-- #main-content - Đóng thẻ mở ở header.php -->

<!-- FOOTER HTML Tĩnh (Giữ nguyên từ mẫu) -->
<?php
/**
 * Thêm vào footer.php
 * Thay thế phần footer hiện tại
 */
?>

<footer class="ftco-footer ftco-section" style="background-color: <?php echo get_theme_mod('footer_bg_color', '#000000'); ?>; 
               color: <?php echo get_theme_mod('footer_text_color', '#ffffff'); ?>;">
  <div class="container">
    <div class="row">
      <!-- Column 1: About -->
      <div class="col-md-4 mb-4">
        <?php if (get_theme_mod('show_footer_logo', true) && has_custom_logo()): ?>
          <div class="footer-logo mb-3">
            <?php the_custom_logo(); ?>
          </div>
        <?php else: ?>
          <h2 class="footer-heading-2" style="color: <?php echo get_theme_mod('footer_text_color', '#ffffff'); ?>;">
            <?php bloginfo('name'); ?>
          </h2>
        <?php endif; ?>

        <p><?php bloginfo('description'); ?></p>

        <!-- Social Media Links -->
        <?php if (
          get_theme_mod('facebook_url') || get_theme_mod('instagram_url') ||
          get_theme_mod('twitter_url') || get_theme_mod('youtube_url')
        ): ?>
          <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-3">
            <?php if (get_theme_mod('facebook_url')): ?>
              <li class="ftco-animate">
                <a href="<?php echo esc_url(get_theme_mod('facebook_url')); ?>" target="_blank">
                  <span class="icon-facebook"></span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_theme_mod('instagram_url')): ?>
              <li class="ftco-animate">
                <a href="<?php echo esc_url(get_theme_mod('instagram_url')); ?>" target="_blank">
                  <span class="icon-instagram"></span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_theme_mod('twitter_url')): ?>
              <li class="ftco-animate">
                <a href="<?php echo esc_url(get_theme_mod('twitter_url')); ?>" target="_blank">
                  <span class="icon-twitter"></span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_theme_mod('youtube_url')): ?>
              <li class="ftco-animate">
                <a href="<?php echo esc_url(get_theme_mod('youtube_url')); ?>" target="_blank">
                  <span class="icon-youtube"></span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        <?php endif; ?>
      </div>

      <!-- Column 2: Contact Info -->
      <div class="col-md-4 mb-4">
        <h2 class="footer-heading-2" style="color: <?php echo get_theme_mod('footer_text_color', '#ffffff'); ?>;">
          Thông tin liên hệ
        </h2>
        <div class="block-23 mb-3">
          <ul>
            <?php if (get_theme_mod('company_address')): ?>
              <li>
                <span class="icon icon-map-marker"></span>
                <span class="text"><?php echo esc_html(get_theme_mod('company_address')); ?></span>
              </li>
            <?php endif; ?>

            <?php if (get_theme_mod('company_phone')): ?>
              <li>
                <a href="tel:<?php echo esc_attr(str_replace(' ', '', get_theme_mod('company_phone'))); ?>">
                  <span class="icon icon-phone"></span>
                  <span class="text"><?php echo esc_html(get_theme_mod('company_phone')); ?></span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_theme_mod('company_email')): ?>
              <li>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('company_email')); ?>">
                  <span class="icon icon-envelope"></span>
                  <span class="text"><?php echo esc_html(get_theme_mod('company_email')); ?></span>
                </a>
              </li>
            <?php endif; ?>

            <?php if (get_theme_mod('working_hours')): ?>
              <li>
                <span class="icon icon-clock-o"></span>
                <span class="text"><?php echo esc_html(get_theme_mod('working_hours')); ?></span>
              </li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <!-- Column 3: Quick Links -->
      <div class="col-md-4 mb-4">
        <h2 class="footer-heading-2" style="color: <?php echo get_theme_mod('footer_text_color', '#ffffff'); ?>;">
          Liên kết nhanh
        </h2>
        <?php
        wp_nav_menu(array(
          'theme_location' => 'footer-menu',
          'container' => false,
          'menu_class' => 'list-unstyled',
          'fallback_cb' => false,
        ));
        ?>
      </div>
    </div>

    <!-- Copyright Row -->
    <div class="row">
      <div class="col-md-12 text-center">
        <p style="color: <?php echo get_theme_mod('footer_text_color', '#ffffff'); ?>;">
          <?php
          echo esc_html(get_theme_mod('footer_copyright', 'Copyright © 2025 H-Fashion. All rights reserved.'));
          ?>
        </p>
      </div>
    </div>
  </div>
</footer>

<!-- Scroll to Top Button -->
<?php if (get_theme_mod('show_scroll_top', true)): ?>
  <a href="#" class="scroll-to-top" style="position: fixed; 
          bottom: 20px; 
          <?php echo get_theme_mod('scroll_button_position', 'right'); ?>: 20px;
          background: <?php echo get_theme_mod('primary_color', '#007bff'); ?>;
          color: white;
          width: 40px;
          height: 40px;
          text-align: center;
          line-height: 40px;
          border-radius: 50%;
          display: none;
          z-index: 9999;">
    <i class="icon-chevron-up"></i>
  </a>

  <script>
    jQuery(document).ready(function ($) {
      // Show/hide scroll to top button
      $(window).scroll(function () {
        if ($(this).scrollTop() > 200) {
          $('.scroll-to-top').fadeIn();
        } else {
          $('.scroll-to-top').fadeOut();
        }
      });

      // Scroll to top on click
      $('.scroll-to-top').click(function (e) {
        e.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 600);
      });
    });
  </script>
<?php endif; ?>

<!-- Newsletter Popup -->
<?php if (get_theme_mod('enable_newsletter_popup', false)): ?>
  <div id="newsletter-popup"
    style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); 
     background: white; padding: 40px; border-radius: 10px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); z-index: 99999; max-width: 500px;">
    <button class="close-popup"
      style="position: absolute; top: 10px; right: 10px; background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
    <h3><?php echo esc_html(get_theme_mod('newsletter_popup_title', 'Subscribe to Newsletter')); ?></h3>
    <p>Nhận thông tin ưu đãi mới nhất từ chúng tôi!</p>
    <form method="post">
      <input type="email" placeholder="Email của bạn" required
        style="width: 100%; padding: 12px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px;">
      <button type="submit" class="btn btn-primary"
        style="width: 100%; background: <?php echo get_theme_mod('primary_color', '#007bff'); ?>;">
        Đăng ký
      </button>
    </form>
  </div>
  <div id="newsletter-overlay"
    style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 99998;">
  </div>

  <script>
    jQuery(document).ready(function ($) {
      // Show newsletter popup after delay
      setTimeout(function () {
        if (!localStorage.getItem('newsletter_closed')) {
          $('#newsletter-popup, #newsletter-overlay').fadeIn();
        }
      }, <?php echo get_theme_mod('newsletter_popup_delay', '5'); ?> * 1000);

      // Close popup
      $('.close-popup, #newsletter-overlay').click(function () {
        $('#newsletter-popup, #newsletter-overlay').fadeOut();
        localStorage.setItem('newsletter_closed', 'true');
      });
    });
  </script>
<?php endif; ?>

<style>
  footer * {
    color:
      <?php echo get_theme_mod('footer_text_color', '#ffffff'); ?>
    ;
  }

  footer a:hover {
    color:
      <?php echo get_theme_mod('primary_color', '#007bff'); ?>
    ;
  }

  .ftco-footer-social li a {
    background:
      <?php echo get_theme_mod('primary_color', '#007bff'); ?>
    ;
  }

  .scroll-to-top:hover {
    background:
      <?php echo get_theme_mod('secondary_color', '#0056b3'); ?>
      !important;
  }
</style>

<?php wp_footer(); ?>
</body>

</html>