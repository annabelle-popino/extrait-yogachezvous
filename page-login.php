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

    <section class="intro-page">
        <?php
        $image = get_field('image_de_la_page');
        $size = 'custom-image-page'; // (thumbnail, medium, large, full or custom size)
        if( $image ) {
            echo wp_get_attachment_image( $image, $size );
        }
        ?>
        <div class="container-intro-text">
            <h3><?php the_field('titre_de_la_page'); ?></h3>
            <p class="sous-titre-page"><?php the_field('sous-titre-page'); ?></p>
            <p class="texte_introduction_page"><?php the_field('texte_introduction_page'); ?></p>
        </div>
    </section>
    <div id="primary" class="content-area">
        <main id="main" class="site-main page-login">

            <?php

            // Start the Loop.
            while ( have_posts() ) :
                the_post();

                get_template_part( 'template-parts/content/content', 'page' );

                // If comments are open or we have at least one comment, load up the comment template.
                if ( comments_open() || get_comments_number() ) {
                    comments_template();
                }

            endwhile; // End the loop.
            ?>


            <section class="noabonnement">
                <style type="text/css">
            .lien-noabo {
                background-color: <?php the_field('couleur-button-abonnement', 'option'); ?>;
            }

            .lien-noabo:hover {
                background-color: <?php the_field('couleur-button-abonnement-hover', 'option'); ?>;
            }
        </style>
                <p class="title-noabo">Vous n'avez pas d'abonnement ?</p>
                <p class="text-noabo">Choisissez votre formule et profitez de nos cours en illimité ! </p>

                <div class="container-abonnement">

                    <?php
                    $abo1 = get_field('abonnement1', 'option');
                    if( $abo1 ): ?>
                    <div class="june-mensuel june-mensuel-login">
                        <div class="container-abonnement-title">
                            <p class="abonnement-title title-login"><?php echo $abo1['titre_de_labonnement1']; ?></p>
                        </div>
                        <div class="container-description-abo abo-page abo-page-login">
                            <p class="abonnement-price price-login"><?php echo $abo1['prix_de_labonnement1']; ?></p>
                            <p class="abonnement-description"><?php echo $abo1['description_de_labonnement1']; ?></p>
                            <a href="http://localhost:8888/chezjune/compte-dadherent/paiement-dadhesion/?level=1">Je choisis</a>
                        </div>
                        <style type="text/css">
                                .june-mensuel a {
                                    background-color: <?php echo esc_attr( $abo1['couleur_de_labonnement1'] ); ?>;
                                }
                                .june-mensuel .abonnement-price {
                                    color: <?php echo esc_attr( $abo1['couleur_de_labonnement1'] ); ?>;
                                }
                                .june-mensuel .abonnement-title {
                                    background-color: <?php echo esc_attr( $abo1['couleur_de_labonnement1'] ); ?>;
                                }
                            </style>
                        <?php endif; ?>

                    </div>

                    <?php
                    $abo2 = get_field('abonnement2', 'option');
                    if( $abo2 ): ?>
                        <div class="june-annuel june-annuel-login">
                            <div class="container-abonnement-title">
                                <p class="abonnement-title title-login"><?php echo $abo2['titre_de_labonnement2']; ?></p>
                            </div>
                            <div class="container-description-abo abo-page abo-page-login">
                                <p class="abonnement-price price-login"><?php echo $abo2['prix_de_labonnement2']; ?></p>
                                <p class="abonnement-description"><?php echo $abo2['description_de_labonnement2']; ?></p>
                                <a href="http://localhost:8888/chezjune/compte-dadherent/paiement-dadhesion/?level=1">Je choisis</a>
                            </div>
                        </div>
                        <style type="text/css">
                                .june-annuel a {
                                    background-color: <?php echo esc_attr( $abo2['couleur_de_labonnement2'] ); ?>;
                                }
                                .june-annuel .abonnement-title {
                                    background-color: <?php echo esc_attr( $abo2['couleur_de_labonnement2'] ); ?>;
                                }
                                .june-annuel .abonnement-price {
                                    color: <?php echo esc_attr( $abo2['couleur_de_labonnement2'] ); ?>;
                                }
                            </style>
                    <?php endif; ?>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
