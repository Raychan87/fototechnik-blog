<nav class="container_navibar_footer">
    <?php 
    
    $args = array(
        'theme_location' => 'navibar_footer' /* Navigationsbereich zuweisen */
        'depth' => 5; /* maximale Tiefe des Menüs */
    );
    
    wp_nav_menu($args);?>
</nav>
 
