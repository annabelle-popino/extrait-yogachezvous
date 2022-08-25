<style type="text/css">
    .cat-discipline-video {
        background-color: <?php the_field('background-couleur-categorie', 'option'); ?>;
        color: <?php the_field('text-couleur-categorie', 'option'); ?>;
    }

    figure.snip1205 {
        background-color:<?php the_field('couleur-hover-video', 'option'); ?>;
    }
</style>

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
