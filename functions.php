    <!-- Sicherheits Funktion -->
    <?php function fototechnikblog_safety_function(){
        add_filter('the_generator', create_function( '$x', 'return;'));  /* Wordpress Version ausblenden */
        add_filter('login_errors', create_function('$a',"return null;")); /* Login Fehler deaktivieren */
        add_filter('xmlrpc_enabled', '__return_false' ); /* XML-RPC Schnittstelle deaktivieren */
        add_filter('rest_enabled', '__return_false');   /* REST API Schnittstelle deaktivieren */
        add_filter('rest_jsonp_enabled', '__return_false'); /* REST API Schnittstelle deaktivieren */
        add_filter('json_enabled', '__return_false');   /* WP-JSON Schnittstelle deaktivieren */
        add_filter('json_jsonp_enabled', '__return_false'); /* WP-JSON Schnittstelle deaktivieren */
        remove_action('wp_head', 'wp_resource_hints', 2); /* DNS Prefatch entfernen */
        /* Mit dem RSD Verweis wird eine XML-Datei mit allen Services des WordPress Blogs bereitgestellt. */
        remove_action('wp_head', 'rsd_link'); /* RSD Verweis entfernen */
        /* Das WLW Manifest dient als Beschreibung für externe Editoren, um auf den WordPress Blog zugreifen zu können. */
        remove_action('wp_head', 'wlwmanifest_link' ); /* WLW Manifest entfernen */
        remove_action('wp_head', 'print_emoji_detection_script', 7 ); /* Emoticons deaktivieren */
        remove_action('admin_print_scripts', 'print_emoji_detection_script' ); /* Emoticons deaktivieren */
        remove_action('wp_print_styles', 'print_emoji_styles' ); /* Emoticons deaktivieren */
        remove_action('admin_print_styles', 'print_emoji_styles' ); /* Emoticons deaktivieren */
        remove_filter('the_content_feed', 'wp_staticize_emoji' ); /* Emoticons deaktivieren */
        remove_filter('comment_text_rss', 'wp_staticize_emoji' ); /* Emoticons deaktivieren */
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email' ); /* Emoticons deaktivieren */
        add_filter('tiny_mce_plugins', 'disable_emojis_tinymce' ); /* Emoticons deaktivieren */ 
    } 
    add_action('init','fototechnikblog_safety_function'); ?>
    <!-- Hiermit wird die direkte Verbindung von xmlrpc.php und x-pingback entfernt -->
    <?php function fototechnikblog_remove_x_pingback( $headers ){
        unset( $headers['X-Pingback'] );
        return $headers;
    }
    add_filter( 'wp_headers', 'fototechnikblog_remove_x_pingback' ); ?>
               
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
            
    
    
            
            
