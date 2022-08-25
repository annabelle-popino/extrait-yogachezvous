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

<section class="page-contact">

    <?php echo do_shortcode( '[contact-form-7 id="311" title="Formulaire de contact"]' ); ?>
</section>

<?php
get_footer();
?>