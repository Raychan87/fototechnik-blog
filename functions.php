    <!-- Sicherheits Funktion -->
    <?php function fototechnik_blog_safety_function(){
        add_filter('the_generator', create_function( '$x', 'return;'));  /* Wordpress Version ausblenden */
        add_filter('login_errors', create_function('$a',"return null;")); /* Login Fehler deaktivieren */
        add_filter('xmlrpc_enabled', '__return_false' ); /* XML-RPC Schnittstelle deaktivieren */
    /*  add_filter('rest_enabled', '__return_false');   /* REST API Schnittstelle deaktivieren */ */
    /*  add_filter('rest_jsonp_enabled', '__return_false'); /* REST API Schnittstelle deaktivieren */ */
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
    add_action('init','fototechnik_blog_safety_function'); ?>

    <!-- Whitelist und Einstellen der REST API Schnittstelle -->
    <? function fototechnik_blog_rest_api() {
        $domain = "fototour-und-technik.de";					/* String der Domain */
        $ip_domain = gethostbyname($domain);					/* IP der Domain abfragen */

        $whitelist = [$ip_domain,'255.255.255.255', "::1" ];    /* IP Whitelist  */

        if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){		/* Wenn nicht auf der Whitelist */
            die('REST API is disabled.');
        }
    }
    add_action('rest_api_init','fototechnik_blog_rest_api'); ?>
  
    <!-- Hiermit wird die direkte Verbindung von xmlrpc.php und x-pingback entfernt -->
    <?php function fototechnik_blog_remove_x_pingback( $headers ){
        unset( $headers['X-Pingback'] );
        return $headers;
    }
    add_filter( 'wp_headers', 'fototechnik_blog_remove_x_pingback' ); ?>
               
    <!-- HTML5 Converter -->
    <?php add_theme_support ('html5', array('search-from','comment-form','comment-list','gallery','caption'));?> 

    <!-- Style des CSS Navigations Menü laden -->
    <?php function custom_navbar_styles() {  
        wp_enqueue_style( 'custom_navbar', get_template_directory_uri() . '/assets/css/custom_navbar.css');
      } 
    add_action('wp_enqueue_scripts','custom_navbar_styles'); ?>

    <!-- Navigations Menü aktivieren -->
    <?php function fototechnik_blog_register_navbar() {
      register_nav_menus(array('navbar' => __( 'Hauptmenü' ) ));
    }
    add_action('init','fototechnik_blog_register_navbar'); ?>

    <!-- Aktivierung der Beitragsformate -->
    <!-- https://wordpress.org/support/article/post-formats/ -->
    <?php add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status')); ?>

    <!-- Aktivierung der Beitragsbilder -->
    <?php add_theme_support(' post-thumbnails'); ?>

    <!-- Aktivierung des Headerbildes -->
    <?php $args = array(
      'width'         => 2000,
      'height'        => 450,
      'default-image' => get_template_directory_uri() . '/assets/images/headerbild.jpg',
      'uploads'       => true,
      'random-default'=> true, /* Wechselt zufällig die Headerbilder */
      'flex-width'    => true,
      'flex-height'    => true,
    );
    add_theme_support( 'custom-header', $args ); ?>

    <!-- Widgets Initialisierung -->
    <!-- Widgets in die Seitenleiste einbinden -->
    <?php function fototechnik_blog_widgets_inits() {
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
    add_action( 'widgets_init','fototechnik_blog_widgets_inits'); ?>

    <!-- Kommentar Funktion -->   
    <!-- Die Funktion für einen einzelnen Kommentar -->
    <?php function fototechnik_blog_comments( $comment, $args, $depth ) { 
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
            
    
    
            
            
