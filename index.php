<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

    <section class="intro-page">
        <?php
        $image = get_field('image_de_la_page', 191);
        $size = 'custom-image-page'; // (thumbnail, medium, large, full or custom size)
        if( $image ) {
            echo wp_get_attachment_image( $image, $size );
        }
        ?>
        <div class="container-intro-text">
            <h3><?php the_field('titre_de_la_page', 191); ?></h3>
            <p class="sous-titre-page"><?php the_field('sous-titre-page', 191); ?></p>
            <p class="texte_introduction_page"><?php the_field('texte_introduction_page', 191); ?></p>
        </div>
    </section>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">


            <section class="page-blog">

                <style type="text/css">
                    figure.snip1205 {
                        background-color:<?php the_field('couleur-hover-video', 'option'); ?>;
                    }
                </style>
                <?php

                $post_lists = get_posts([
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'numberposts' => -1,
                    'orderby'   => 'date',
                    'order' => 'DESC',
                    'posts_per_page' => 15,
                    'paged' => get_query_var('paged'),
                ]);

                ?>

                <?php
                if(!empty($post_lists)):
                    foreach($post_lists as $post_list):
                        ?>

                        <article class="article" id="post-<?php the_ID(); ?>">
                            <a href="<?php echo esc_url( get_permalink($post_list)); ?>">
                                <div class="actu-back">
                                    <div class="actu-img">
                                        <figure class="snip1205 green">
                                        <?php echo get_the_post_thumbnail($post_list, 'custom-article'); ?>
                                            <i class="fas fa-feather-alt"></i>
                                        </figure>
                                    </div>
                                    <div class="id-actu">
                                        <div class="container-title-video"><i class="fas fa-arrow-right"></i><h4><?php echo get_the_title($post_list); ?></h4></div>
                                        <p class="text-video"><?php $summary = get_the_excerpt($post_list);
                                        echo substr($summary, 0, 180); ?>...</p>
                                    </div>
                                </div>
                            </a>
                        </article>

                    <?php endforeach;
                endif;
                ?>

            </section>

            <?php the_posts_pagination( array( 'mid_size' => 2 ) );

            wp_reset_postdata();?>

        </main><!-- .site-main -->
    </div><!-- .content-area -->

<?php
get_footer();
