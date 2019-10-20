    <footer>
        <!-- gibt das aktuelle Jahr und den Namen der Webseite aus -->
        <p>Copyright 2018 - <?php echo date('Y'); ?> - <?php bloginfo('name'); ?></p>
    </footer>

    <!-- Wird für die Adminleiste geladen (wp_head() wird auch benötigt)) -->
    <?php wp_footer();?> 
</body>
</html>
