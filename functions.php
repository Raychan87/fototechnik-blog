<?php

    //Navigation Funktion wird aufgerufen
    add_action( 'after_setup_theme', 'wpftb_register_navbar' );
    
    //Die Funktion wird Deklariert
    function wpftb_register_navbar() {
      register_nav_menu('nav_main','Navigation in der Kopfzeile');
      register_nav_menu('nav_side','Navigation in der Seitenleiste');
      register_nav_menu('nav_footer','Navigation in der Fußzeile');
    }
?>
