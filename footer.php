    <footer class="container_footer">
        <div class="container_widget_footer">
            <!-- Wenn der Footer kein Widget hat, wird dieses Feld ausgeblendet -->
            <?php if ( is_active_sidebar( 'footer_widget' )): ?>
                <!-- Bindet die Widgets in den Footer ein -->
                <?php dynamic_sidebar( 'footer_widget' ); ?>
            <?php endif; ?>
        </div>
        <!-- gibt das aktuelle Jahr und den Namen der Webseite aus -->
        <p>Copyright 2018 - <?php echo date('Y'); ?> - <?php bloginfo('name'); ?></p>
    </footer>
</div> <!-- die Classe "container_blog" wird hier wieder geschlossen -->

    <!-- Wird für die Adminleiste geladen (wp_head() wird auch benötigt)) -->
    <?php wp_footer();?> 
</body>
</html>
