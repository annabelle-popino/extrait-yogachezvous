<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since Twenty Nineteen 1.0
 */

get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

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

            <?php

            // Start the Loop.
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content/content', 'single' );

                if ( is_singular( 'attachment' ) ) {
                    // Parent post navigation.
                    the_post_navigation(
                        array(
                            /* translators: %s: Parent post link. */
                            'prev_text' => sprintf( __( '<span class="meta-nav">Published in</span><span class="post-title">%s</span>', 'twentynineteen' ), '%title' ),
                        )
                    );

                }

            endwhile; // End the loop.
            ?>

        <div class="container-article-recents">
                <h3>Articles récents</h3>
            <section class="page-blog">

                <style type="text/css">
                    figure.snip1205 {
                        background-color:<?php the_field('couleur-hover-video', 'option'); ?>;
                    }
                </style>

                    <?php
                    $exclude_post = $post->ID;

                    $post_lists = get_posts([
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'numberposts' => 4,
                        'orderby'   => 'date',
                        'order' => 'DESC',
                        'post__not_in' => array($exclude_post)
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
                                            <!--<p class="category-event">#</?php $category_detail= get_the_category($post_list);//$post->ID
                                                foreach($category_detail as $cd){
                                                    echo $cd->cat_name;
                                                } ?></p>-->
                                            <div class="container-title-video"><i class="fas fa-arrow-right"></i><h4><?php echo get_the_title($post_list); ?></h4></div>
                                            <p class="text-video"><?php $summary = get_the_excerpt($post_list);
                                                echo substr($summary, 0, 180); ?>...</p>
                                        </div>
                                    </div>
                                </a>
                            </article>

                        <?php endforeach;
                    endif; ?>
            </section>
        </div>
    </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
