<nav class="container_navibar">
    <?php 
    
    $args = array(
        'theme_location' => 'navibar_main' /* Navigationsbereich zuweisen */
        'depth' => 5; /* maximale Tiefe des Menüs */
    );
    
    wp_nav_menu($args);?>
</nav>
 
 
 
 
