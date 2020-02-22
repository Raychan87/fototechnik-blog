        <div class="footer-copyright">
            <?php /* gibt das aktuelle Jahr und den Namen der Webseite aus */?>
            <p><?php bloginfo('name');?> - Copyright 2018 - <?php echo date('Y'); ?></p>
        </div>
    </footer>
</div> <?php /* die Classe "container_blog" wird hier wieder geschlossen */

/* Wird für die Adminleiste geladen (wp_head() wird auch benötigt)) */
wp_footer();?>
</body>
</html>