<?php
/**
 * Template Name: Contact Page
 * Template cho trang liên hệ
 */

get_header(); ?>

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

<!-- Contact Section -->
<section class="ftco-section contact-section bg-light">
    <div class="container">
        <!-- Contact Info -->
        <div class="row d-flex mb-5 contact-info">
            <div class="w-100"></div>
            
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Address:</span> <?php echo get_option('contact_address', '198 West 21th Street, Suite 721 New York NY 10016'); ?></p>
                </div>
            </div>
            
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Phone:</span> <a href="tel:<?php echo get_option('contact_phone', '+1235235598'); ?>"><?php echo get_option('contact_phone_display', '+ 1235 2355 98'); ?></a></p>
                </div>
            </div>
            
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Email:</span> <a href="mailto:<?php echo get_option('contact_email', 'info@yoursite.com'); ?>"><?php echo get_option('contact_email', 'info@yoursite.com'); ?></a></p>
                </div>
            </div>
            
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Website:</span> <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo str_replace(array('http://', 'https://'), '', home_url()); ?></a></p>
                </div>
            </div>
        </div>

        <!-- Contact Form & Map -->
        <div class="row block-9">
            <!-- Contact Form -->
            <div class="col-md-6 order-md-last d-flex">
                <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" class="bg-white p-5 contact-form">
                    <input type="hidden" name="action" value="contact_form_submit">
                    <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                    
                    <div class="form-group">
                        <input type="text" name="contact_name" class="form-control" placeholder="Your Name" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="contact_email" class="form-control" placeholder="Your Email" required>
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="contact_subject" class="form-control" placeholder="Subject" required>
                    </div>
                    
                    <div class="form-group">
                        <textarea name="contact_message" cols="30" rows="7" class="form-control" placeholder="Message" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                    </div>
                    
                    <?php if (isset($_GET['sent']) && $_GET['sent'] == 'success'): ?>
                        <div class="alert alert-success">Your message has been sent successfully!</div>
                    <?php endif; ?>
                    
                    <?php if (isset($_GET['sent']) && $_GET['sent'] == 'error'): ?>
                        <div class="alert alert-danger">There was an error sending your message. Please try again.</div>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Google Map -->
            <div class="col-md-6 d-flex">
                <div id="map" class="bg-white" style="width: 100%; height: 100%; min-height: 400px;">
                    <iframe 
                        src="<?php echo get_option('contact_map_embed', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.0967739814894!2d105.78252731476292!3d21.028812993682913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab4bd70dc0db%3A0x94dc54e6e908a45!2sHanoi%2C%20Vietnam!5e0!3m2!1sen!2s!4v1234567890'); ?>" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>