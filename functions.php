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
    <!-- Kommentar Funktion -->   
    <!-- Die Funktion für einen einzelnen Kommentar -->
    <?php function wpv_comments( $comment, $args, $depth ) { $GLOBALS['comment'] = $comment; ?>

    <li class="single-comment">
     <?php echo get_avatar( $comment, $size='90' ); ?> <!-- Benutzerbild wird ausgegeben von 90 Pixel-->
     <p><?php echo get_comment_author_link(); ?></p> <!-- der Link des Kommentierenden -->
     <p><?php echo get_comment_date("d.m.Y"); ?>, <?php echo get_comment_time(); ?> Uhr</p> <!-- Datum und Zeit -->
     <?php comment_text(); ?> <!-- Kommentar Text und der Name des Kommentierenden wird ausgegeben -->

    <?php }?>
?>
