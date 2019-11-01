    <!-- HTML5 Converter -->
    <?php $args = array(
        'search-from',
        'comment-form'.
        'comment-list',
        'gallery',
        'caption'
    };
    add_theme_support ('html5', $args);?> 
   
    <!-- Navigations Menü -->
    <!-- Bootstrap Nav Walker wird geladen -->
    <?php function fototechnikblog_register_navwalker() {
    	require_once get_template_directory() . '/assets/lib/class-wp-bootstrap-navwalker.php';
    }
    add_action( 'after_setup_theme', 'fototechnikblog_register_navwalker' ); ?>
    <!-- Das Nav Walker Menü registrieren -->
    <?php register_nav_menus( array(
	    'primary' => __( 'Primary Menu', 'fototechnik-blog' ),
    ) ); ?>

    <!-- Navigation Funktion wird aufgerufen -->
    <?php function fototechnikblog_register_navibar() {
      register_nav_menu('navibar_main','Navigation in der Kopfzeile'); 
    }
    add_action( 'after_setup_theme', 'fototechnikblog_register_navibar' ); ?>

    <!-- Aktivierung der Beitragsformate -->
    <!-- https://wordpress.org/support/article/post-formats/ -->
    <!-- Training Kapitel 6.4 -->
    <?php add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status')); ?>

    <!-- Aktivierung der Beitragsbilder -->
    <?php add_theme_support(' post-thumbnails'); ?>
    
    <!-- Widgets Initialisierung -->
    <!-- Widgets in die Seitenleiste einbinden -->
    <?php function fototechnikblog_widgets_inits() {
      // Seitenleiste Rechts
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
      // Footer Abschnitt
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
    add_action( 'widgets_init','fototechnikblog_widgets_inits'); ?>

    <!-- Kommentar Funktion -->   
    <!-- Die Funktion für einen einzelnen Kommentar -->
    <?php function fototechnikblog_comments( $comment, $args, $depth ) { 
        $GLOBALS['comment'] = $comment; ?>

        <li class="single-comment">
        <!-- <?php echo get_avatar( $comment, $size='90' ); ?> --> <!-- Benutzerbild wird ausgegeben von 90 Pixel-->
        <p><?php echo get_comment_author_link(); ?></p> <!-- der Link des Kommentierenden -->
        <p><?php echo get_comment_date("d.m.Y"); ?>, <?php echo get_comment_time(); ?> Uhr</p> <!-- Datum und Zeit -->
        <?php comment_text(); ?> <!-- Kommentar Text und der Name des Kommentierenden wird ausgegeben -->
        <div class="reply">
            <!-- Button um auf Kommentare zu antworten. -->
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    <?php }?>
            
     <!-- Sicherheits Funktionen -->
     <!-- Wordpress Version ausblenden -->
     <?php function fototechnikblog_remove_generator(){
        add_filter( 'the_generator', create_function( '$x', 'return;'));
     }
     add_action('init','fototechnikblog_remove_generator'); ?>
     <!-- Login Fehler deaktivieren -->
     <?php add_filter('login_errors', create_function('$a',"return null;"));
            
