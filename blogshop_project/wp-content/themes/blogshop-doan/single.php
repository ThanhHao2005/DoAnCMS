<?php
/**
 * Template cho single post (chi tiết bài viết)
 */
get_header(); ?>

<div class="hero-wrap hero-bread" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/bg_6.jpg');">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs">
            <?php 
            if ( function_exists('woocommerce_breadcrumb') ) {
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

<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 ftco-animate">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        ?>
                        <h2 class="mb-3"><?php the_title(); ?></h2>
                        <p>
                            <img src="<?php 
                                if ( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail_url( get_the_ID(), 'large' );
                                } else {
                                    echo get_template_directory_uri() . '/images/image_1.jpg';
                                }
                            ?>" alt="" class="img-fluid">
                        </p>
                        <div class="meta mb-4">
                            <div><a href="<?php the_permalink(); ?>"><?php echo get_the_date(); ?></a></div>
                            <div><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php the_author(); ?></a></div>
                            <div><a href="<?php the_permalink(); ?>" class="meta-chat"><span class="icon-chat"></span> <?php comments_number( '0', '1', '%' ); ?></a></div>
                        </div>
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                        <div class="tag-widget post-tag-container mb-5 mt-5">
                            <div class="tagcloud">
                                <?php
                                $tags = get_the_tags();
                                if ( $tags ) {
                                    foreach ( $tags as $tag ) {
                                        echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tag-cloud-link">' . esc_html( $tag->name ) . '</a>';
                                    }
                                }
                                ?>
                            </div>
                        </div>

                        <div class="about-author d-flex p-4 bg-light">
                            <div class="bio mr-5">
                                <img src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => 100 ) ); ?>" alt="Image placeholder" class="img-fluid mb-4">
                            </div>
                            <div class="desc">
                                <h3><?php the_author(); ?></h3>
                                <p><?php echo get_the_author_meta( 'description' ); ?></p>
                            </div>
                        </div>

                        <?php
                        // Comments
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>

                        <?php
                    endwhile;
                endif;
                ?>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 sidebar ftco-animate">
                <div class="sidebar-box">
                    <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="search-form">
                        <div class="form-group">
                            <span class="icon ion-ios-search"></span>
                            <input type="text" name="s" class="form-control" placeholder="Type a keyword and hit enter" value="<?php echo get_search_query(); ?>">
                        </div>
                    </form>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Categories</h3>
                    <ul class="categories">
                        <?php
                        $categories = get_categories();
                        foreach ( $categories as $category ) {
                            echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . ' <span>(' . $category->count . ')</span></a></li>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Recent Blog</h3>
                    <?php
                    $recent_posts = new WP_Query( array(
                        'posts_per_page' => 5,
                        'post_type' => 'post',
                        'post__not_in' => array( get_the_ID() ),
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ) );
                    if ( $recent_posts->have_posts() ) :
                        ?>
                        <?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); ?>
                            <div class="block-21 mb-4 d-flex">
                                <a class="blog-img mr-4" style="background-image: url('<?php 
                                    if ( has_post_thumbnail() ) {
                                        echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' );
                                    } else {
                                        echo get_template_directory_uri() . '/images/image_1.jpg';
                                    }
                                ?>');"></a>
                                <div class="text">
                                    <h3 class="heading-1"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <div class="meta">
                                        <div><a href="<?php the_permalink(); ?>"><span class="icon-calendar"></span> <?php echo get_the_date(); ?></a></div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>

                <div class="sidebar-box ftco-animate">
                    <h3 class="heading">Tag Cloud</h3>
                    <div class="tagcloud">
                        <?php
                        $tags = get_tags();
                        foreach ( $tags as $tag ) {
                            echo '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '" class="tag-cloud-link">' . esc_html( $tag->name ) . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>

