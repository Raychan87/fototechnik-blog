<footer class="container_footer">
    <?php /* Wenn der PostType 'galerie' geladen wird, dann... */
    if (get_post_type() == 'galerie') : ?>
        <div class="footer-widget">
            <?php /* Wenn der Footer kein Widget hat, wird dieses Feld ausgeblendet */
            if( is_active_sidebar('footer_widget') ):
                /* Bindet die Widgets in den Footer ein */
                dynamic_sidebar('footer_widget');
            endif;
        ?></div><?php
    endif;
        ?><div class="footer-copyright">
            <?php /* gibt das aktuelle Jahr und den Namen der Webseite aus */?>
            <p><?php bloginfo('name');?> - Copyright 2018 - <?php echo date('Y'); ?></p>
        </div>
    </footer>
</div> <?php /* die Classe "container_blog" wird hier wieder geschlossen */

/* Wird für die Adminleiste geladen (wp_head() wird auch benötigt)) */
wp_footer();?>
</body>
</html>