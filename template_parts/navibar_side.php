<nav class="container_navibar_side">
    <?php 
    
    $args = array(
        'theme_location' => 'navibar_side' /* Navigationsbereich zuweisen */
        'depth' => 5; /* maximale Tiefe des Menüs */
    );
    
    wp_nav_menu($args);?>
</nav>
 
