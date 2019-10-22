    <footer class="container_footer">
        <!-- gibt das aktuelle Jahr und den Namen der Webseite aus -->
        <p>Copyright 2018 - <?php echo date('Y'); ?> - <?php bloginfo('name'); ?></p>
    </footer>
</div> <!-- die Classe "container_blog" wird hier wieder geschlossen -->

    <!-- Wird für die Adminleiste geladen (wp_head() wird auch benötigt)) -->
    <?php wp_footer();?> 
</body>
</html>
