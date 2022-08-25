<?php
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

    <section class="filter">
        <h4>Filtrer</h4>
        <?php echo do_shortcode( '[searchandfilter submit_label="Ok" post_types="videos" fields="durees,niveaux,disciplines,series"]' );?>
    </section>

    <section class="section-video section-lescours">

        <?php
        $projects = new WP_Query([
            'post_type' => 'videos',
            'posts_per_page' => -1,
            'post_status' => array('publish', 'private'),
        ]);
        ?>

        <?php if($projects->have_posts()): ?>
        <ul class="project-tiles">
                <?php
                while($projects->have_posts()) : $projects->the_post();
                    include('loop-videos.php');
                endwhile;
                ?>
        </ul>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>

    </section>

<?php
get_footer();
?>

