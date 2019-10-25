<?php

    //Navigation Funktion wird aufgerufen
    add_action( 'after_setup_theme', 'wpftb_register_navibar' );
    
    //Die Funktion wird Deklariert
    function wpftb_register_navibar() {
      register_nav_menu('navibar_menu','Navigation in der Kopfzeile');
      register_nav_menu('navibar_side','Navigation in der Seitenleiste');
      register_nav_menu('navibar_footer','Navigation in der Fußzeile');
    }
?>
