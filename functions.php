<?php
    /* Navigations Menü */
    //Navigation Funktion wird aufgerufen
    add_action( 'after_setup_theme', 'wpftb_register_navibar' );

    //Die Funktion wird Deklariert
    function wpftb_register_navibar() {
      register_nav_menu('navibar_main','Navigation in der Kopfzeile');
    }

    /* Widgets Initialisierung */
    //Widgets in die Seitenleiste einbinden
    add_action( 'widgets_init','fototechnikblog_widgets_inits');

    function fototechnikblog_widgets_inits() {
      register_sidebar( 
        array(
            'name' => 'Seitenleiste rechts', //Anzeige Name im Widget Menü
            'id' => 'sidebar_widget', //Die ID für die Widgets
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widgettitle">',
            'after_title'   => '</h5>',
          )
      );
      register_sidebar( 
        array(
            'name' => 'Footer-Abschnitt', //Anzeige Name im Widget Menü
            'id' => 'footer_widget', //Die ID für die Widgets
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h5 class="widgettitle">',
            'after_title'   => '</h5>',
          )
      );
    }

?>
