<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main home">

        <section class="slider-home">
            <div class="slider-title">
                <style type="text/css">
                    .slide-lien-bouton {
                        background-color: <?php the_field('couleur_du_bouton_slider', 'option'); ?>;
                    }

                    .slide-lien-bouton:hover {
                        background-color: <?php the_field('couleur_du_bouton_slider_hover', 'option'); ?>;
                    }
                </style>
                <h1 class="slide-title-principal"><?php the_field( 'Slide_titre_principal', 'option'); ?></h1>
                <h2 class="slide-title-secondaire"><?php the_field( 'slide_titre_secondaire', 'option'); ?></h2>
                <a class="slide-lien-bouton" href="<?php the_field( 'slide_lien_bouton', 'option'); ?>"><?php the_field( 'slide_titre_bouton', 'option'); ?></a>
            </div>
            <?php
            echo do_shortcode('[smartslider3 slider="3"]');
            ?>
        </section>

        <section class="section-discipline">
            <h3 class="title-discipline textleft"><?php the_field( 'titre_du_bloc_discipline'); ?></h3>
            <p class="text-intro-discipline textleft"><?php the_field( 'texte_dintroduction_discipline'); ?></p>
            <div class="repeteur-disciplines">
                <?php
                if( have_rows('repeteur_disciplines') ):

                    while ( have_rows('repeteur_disciplines') ) : the_row();

                        ?>
                        <a class="link-bloc" href="<?php the_sub_field( 'lien_vers_la_discipline'); ?>">
                            <article>
                                <div class="bloc-container-discipline">

                                        <?php
                                        $image = get_sub_field('image_de_la_discipline');
                                        $size = 'custom-discipline';
                                        ?>
                                        <?php echo wp_get_attachment_image($image, $size) ?>
                                    <div class="container-img-discipline"></div>
                                    <div class="bloc-discipline">
                                        <p class="container-title-bloc-discipline">
                                            <span class="title-bloc-discipline"><?php the_sub_field('titre_de_la_discipline'); ?></span>
                                        </p>
                                        <p class="text-bloc-discipline"><?php the_sub_field('texte_dintro_de_la_discipline'); ?></p>
                                    </div>
                                </div>
                            </article>
                        </a>
                    <?php
                    endwhile;
                else :

                    // no rows found

                endif;

                ?>
            </div>
        </section>

        <section class="container-abonnement-home">
            <div class="container-infos-abonnement">
                <h3>S'abonner</h3>

                <div class="container-abonnement">

                    <?php
                    $abo1 = get_field('abonnement1', 'option');
                    if( $abo1 ): ?>
                    <div class="june-mensuel">
                        <div class="container-abonnement-title">
                            <p class="abonnement-title"><?php echo $abo1['titre_de_labonnement1']; ?></p>
                        </div>
                        <div class="container-description-abo">
                            <p class="abonnement-price"><?php echo $abo1['prix_de_labonnement1']; ?></p>
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
                    <div class="june-annuel">
                        <div class="container-abonnement-title">
                            <p class="abonnement-title"><?php echo $abo2['titre_de_labonnement2']; ?></p>
                        </div>
                        <div class="container-description-abo">
                            <p class="abonnement-price"><?php echo $abo2['prix_de_labonnement2']; ?></p>
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
            </div>
        </section>

        <div class="container-title-video-home">
            <h3 class="textleft">Les dernières vidéos</h3>
        </div>
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

        <?php
        $videos = get_posts([
            'post_type' => 'videos',
            'numberposts' => 3,
            'order' => 'DESC',
            'post_status' => array('publish', 'private'),

        ]);

        ?>
        <?php
        if(!empty($videos)):
            foreach($videos as $video):
                ?>

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
            <?php endforeach;
        endif; ?>

            <div class="container-lien-quisommesnous margin-container">
                <a class="lien-quisommenous"href="http://localhost:8888/chezjune/les-cours/" ?>Voir toutes les vidéos</a>
            </div>

        </section>

        <section class="section-quisommesnous">

            <style type="text/css">
                .lien-quisommenous {
                    background-color: <?php the_field('couleur-lien-qui'); ?>;
                    color:<?php the_field('couleur_du_texte_du_bouton'); ?>;
                }

                .lien-quisommenous:hover {
                    background-color: <?php the_field('couleur_du_lien_au_hover'); ?>;
                    color:<?php the_field('couleur_du_texte_au_hover');?>;
                    transition:0.5s;
                }
            </style>

                <?php
                $image = get_field('image-qui');
                $size = 'custom-quisommesnous';
                ?>
                <?php echo wp_get_attachment_image($image, $size) ?>

            <div class="bloc-text-qui">
                <h3 class="title-discipline"><?php the_field( 'titre-qui'); ?></h3>
                <p class="text-quisommenous"><?php the_field( 'texte_de_presentation_qui'); ?></p>
                <div class="container-lien-quisommesnous">
                    <a class="lien-quisommenous"href="<?php the_field('lien-qui'); ?>"><?php the_field('lien-titre-qui'); ?></a>
                </div>
                <div class="repeteur-rs-qui">
                <?php
                if( have_rows('logo-rs-qui') ):
                    while ( have_rows('logo-rs-qui') ) : the_row();
                        ?>
                            <a href="<?php the_sub_field('lien-rs-qui'); ?>">

                                    <?php
                                    $image = get_sub_field('image-logo-rs-qui');
                                    $size = 'thumbnail';
                                    ?>
                                    <?php echo wp_get_attachment_image($image, $size) ?>
                            </a>
                    <?php
                    endwhile;
                endif;
                ?>
                </div>
            </div>
        </section>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
