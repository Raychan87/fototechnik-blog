<nav class="container_navibar_main">
    <?php 
    
    $args = array(
        'theme_location' => 'navibar_main', /* Navigationsbereich zuweisen */
        'depth' => 5, /* maximale Tiefe des Menüs */
        'container' => ''
    );
    
    wp_nav_menu($args);?>
</nav>
 
 
 
 
