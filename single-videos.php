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
        <main id="main" class="site-main single-video">
                <section class="single-video-container">
                    <style type="text/css">
                        .cat-discipline-video {
                            background-color: <?php the_field('background-couleur-categorie', 'option'); ?>;
                            color: <?php the_field('text-couleur-categorie', 'option'); ?>;
                        }
                    </style>
                    <?php
                    // Start the Loop.
                    while ( have_posts() ) :
                    the_post();

                    get_template_part( 'template-parts/content/content', 'single' );?>

                    <section class="section-intro-video">
                        <div class="relation-prof">
                            <?php
                            $featured_posts = get_field('professeur-relation');
                            if( $featured_posts ): ?>
                                <?php foreach( $featured_posts as $post ):
                                    setup_postdata($post); ?>
                                    <p>par <?php the_title(); ?></p>
                                <?php endforeach; ?>
                                <?php
                                // Reset the global post object so that the rest of the page works correctly.
                                wp_reset_postdata(); ?>
                            <?php endif; ?>
                        </div>

                        <div class="category-single-video">
                            <?php $post_terms = get_the_terms($video->ID, 'disciplines' ); ?>
                            <p class="container-cat-discipline-single-video"><span class="cat-discipline-video"><?php echo $post_terms[0]->name; ?></span></p>
                            <?php $post_terms = get_the_terms($video->ID, 'niveaux' ); ?>
                            <p class="container-cat-discipline-single-video"><span class="cat-discipline-video"><?php echo $post_terms[0]->name; ?></span></p>
                        </div>
                    </section>

                    <iframe id="id-frame" src="https://player.vimeo.com/video/<?php the_field( 'id_vimeo');?>?title=0&byline=0&portrait=0&loop=1" frameborder="0"  allow="autoplay; fullscreen" allowfullscreen></iframe>

                    <div>
                        <p class="text-video">
                            <?php the_field('texte_video');?>
                    </div>
                </section>

                <section class="section-single-prof">
                    <div class="container-single-prof">
                        <?php
                        $featured_posts = get_field('professeur-relation');
                        if( $featured_posts ): ?>
                            <?php foreach( $featured_posts as $post ):
                                setup_postdata($post); ?>
                                <?php
                                $image = get_field('photo_prof', $prof->ID);
                                $size = 'custom-team';
                                if( $image ) {
                                    echo wp_get_attachment_image( $image, $size );
                                }
                                ?>
                                <div class="text-prof-video">
                                    <p class="title-video-prof"><?php the_title(); ?></p>
                                    <p class="text-video-prof"><?php the_content(); ?></p>
                                    <div class="container-lien-quisommesnous">
                                        <a class="lien-quisommenous" href="<?php echo esc_url( get_permalink($video->ID)); ?>">Voir les autres cours de <?php the_title(); ?></a>
                                    </div>
                                </div>


                            <?php endforeach; ?>
                            <?php
                            // Reset the global post object so that the rest of the page works correctly.
                            wp_reset_postdata(); ?>
                        <?php endif; ?>

                    </div>
                </section>
<?php
            endwhile; // End the loop.
            ?>

            <div class="section-similaire">
                <p class="title-video-similaire">Vous aimerez aussi...</p>
                <section class="section-video">

                    <style type="text/css">
                        .cat-discipline-video {
                            background-color: <?php the_field('background-couleur-categorie', 'option'); ?>;
                            color: <?php the_field('text-couleur-categorie', 'option'); ?>;
                        }

                        figure.snip1205 {
                            background-color:<?php the_field('couleur-hover-video', 'option'); ?>;
                        }
                    </style>
                    <?php $exclude_post = $post->ID;?>
                    <?php $terms = wp_get_post_terms( $post->ID, 'disciplines');?>
                    <?php $args = array(
                        'post_type' => 'videos', // le CTP
                        'order' => 'DESC',
                        'post__not_in' => array($exclude_post),
                        'showposts' => 3,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'disciplines', // le custom vocabulary des taxonomies
                                'field'    => 'slug',
                                'terms'    => array($terms[0]->slug), // prend le premier slug
                            ),
                        ),
                    );?>

                    <?php
                    query_posts( $args ); while ( have_posts() ) :the_post(); ?>

                            <article id="post-<?php the_ID(); ?>">
                                <a href="<?php echo esc_url( get_permalink($video->ID)); ?>">
                                    <figure class="snip1205 green">
                                        <?php
                                        $image = get_field('image_de_la_video', $video->ID);
                                        $size = 'custom-video'; // (thumbnail, medium, large, full or custom size)
                                        if( $image ) {
                                            echo wp_get_attachment_image( $image, $size );
                                        }
                                        ?>
                                        <i class="fas fa-video"></i>
                                    </figure>
                                    <div>
                                        <?php $post_terms = get_the_terms($video->ID, 'disciplines' ); ?>
                                        <p class="container-cat-discipline-video"><span class="cat-discipline-video"><?php echo $post_terms[0]->name; ?></span></p>
                                        <div class="container-title-video"><i class="fas fa-arrow-right"></i><h4><?php the_field( 'titre_de_la_video', $video->ID);?></h4></div>
                                        <p class="text-video">
                                            <?php $summary = get_field('texte_video', $video->ID);
                                            echo substr($summary, 0, 180); ?>...</p>
                                    </div>
                                </a>
                            </article>
                       <?php
                  endwhile;?>


                <?php
                wp_reset_query();?>

                </section>

            </div>

        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
