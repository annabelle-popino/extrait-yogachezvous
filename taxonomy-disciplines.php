<?php
/**
 * The template for displaying archive pages
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
    $image = get_field('image_de_la_page', 21);
    $size = 'custom-image-page'; // (thumbnail, medium, large, full or custom size)
    if( $image ) {
        echo wp_get_attachment_image( $image, $size );
    }
    ?>
    <div class="container-intro-text">
        <h3><?php the_field('titre_de_la_page', 21); ?></h3>
        <p class="sous-titre-page"><?php the_field('sous-titre-page', 21); ?></p>
        <p class="texte_introduction_page"><?php the_field('texte_introduction_page', 21); ?></p>
    </div>
</section>

<section class="filter">
    <h4>Filtrer</h4>
    <?php echo do_shortcode( '[searchandfilter submit_label="Ok" fields="private" types="publish, private" post_types="videos" fields="durees,niveaux,disciplines"]' );?>
</section>

<?php if ( have_posts() ) : ?>

<section class="section-video section-lescours">

    <style type="text/css">
        .cat-discipline-video {
            background-color: <?php the_field('background-couleur-categorie', 'option'); ?>;
            color: <?php the_field('text-couleur-categorie', 'option'); ?>;
        }

        figure.snip1205 {
            background-color:<?php the_field('couleur-hover-video', 'option'); ?>;
        }
    </style>

    <?php $terms = wp_get_post_terms( $post->ID, 'disciplines');?>
    <?php $args = array(
        'post_type' => 'videos', // le CTP
        'showposts' => -1, // Nombre de post à montrer
        'order' => 'DESC',
        'post_status' => array('publish', 'private'),
        'tax_query' => array(
                array(
                'taxonomy' => 'disciplines', // le custom vocabulary des taxonomies
                'field'    => 'slug',
                'terms'    => array($terms[0]->slug), // prend le premier slug
                ),
                ),
                );?>

        <?php
        query_posts( $args ); while ( have_posts() ) :the_post();

        include('loop-videos.php');?>
            <?php endwhile; ?>

        <?php wp_reset_query(); ?>

    <?php
    // End the loop.
    // If no content, include the "No posts found" template.
    else :?>

        <div class="container-noresult">
            <p class="sous-titre-page">Pour l'instant, il n'y a pas de vidéos correspondantes !</p>
            <a class="lien-return" href="http://localhost:8888/chezjune/les-cours/">Retourner sur la page des cours</a>
        </div>
    <?php
    endif;
    ?>

<?php
get_footer();
?>
