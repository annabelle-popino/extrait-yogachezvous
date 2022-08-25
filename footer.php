<?php

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <?php get_template_part( 'template-parts/footer/footer', 'widgets' ); ?>
    <div class="site-info-footer">

            <style type="text/css">
                .site-info-footer {
                    background-color: <?php the_field('couleur-background-footer', 'option'); ?>;
                    color:<?php the_field('couleur-text-footer', 'option'); ?>;
                }

                .footer-navigation ul li a {
                    color:<?php the_field('couleur-text-footer', 'option'); ?>;
                }
            </style>

            <div class="footer-col1">
                <?php
                $image = get_field('logo-footer', 'option');
                $size = 'custom-logo-footer';
                ?>
                <?php echo wp_get_attachment_image($image, $size) ?>
                <div class="footer-col1-text">
                    <p><?php the_field('adresse-footer', 'option'); ?></p>
                    <p><?php the_field('copyright-footer', 'option'); ?></p>
                </div>
            </div>

            <div class="footer-col2">
            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'twentynineteen' ); ?>">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_class'     => 'footer-menu',
                            'depth'          => 1,
                        )
                    );
                    ?>
                </nav><!-- .footer-navigation -->
            <?php endif; ?>
            </div>
            <div class="footer-col3">
                <p class="newsletter-title">S'inscrire à la newsletter</p>
                <?php echo do_shortcode('[mailpoet_form id="1"]'); ?>
            </div>
    </div><!-- .site-info -->
</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
