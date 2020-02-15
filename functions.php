<?php        
    /* Sicherheits Funktion */
    function fototechnik_blog_safety_function(){
        add_filter('the_generator', create_function( '$x', 'return;'));  /* Wordpress Version ausblenden */
        add_filter('login_errors', create_function('$a',"return null;")); /* Login Fehler deaktivieren */
        add_filter('xmlrpc_enabled', '__return_false' ); /* XML-RPC Schnittstelle deaktivieren */
    /*  add_filter('rest_enabled', '__return_false');   /* REST API Schnittstelle deaktivieren */ 
    /*  add_filter('rest_jsonp_enabled', '__return_false'); /* REST API Schnittstelle deaktivieren */ 
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
    add_action('init','fototechnik_blog_safety_function');

    /* Whitelist und Einstellen der REST API Schnittstelle */
    function fototechnik_blog_rest_api() {
        $domain = "fototour-und-technik.de";					/* String der Domain */
        $ip_domain = gethostbyname($domain);					/* IP der Domain abfragen */

        $whitelist = [$ip_domain,'255.255.255.255', "::1" ];    /* IP Whitelist  */

        if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){		/* Wenn nicht auf der Whitelist */
            die('REST API is disabled.');
        }
    }
    add_action('rest_api_init','fototechnik_blog_rest_api');
  
    /* Hiermit wird die direkte Verbindung von xmlrpc.php und x-pingback entfernt */
    function fototechnik_blog_remove_x_pingback( $headers ){
        unset( $headers['X-Pingback'] );
    return $headers;
    }
    add_filter( 'wp_headers', 'fototechnik_blog_remove_x_pingback' );  
    
    /* HTML5 Converter */
    add_theme_support ('html5', array('search-from','comment-form','comment-list','gallery','caption'));

    /* CSS Styles importieren */
    function styles_imports() {  
      /* Style.css laden */
      wp_enqueue_style( 'style', get_stylesheet_uri() );
      /* normalize.css laden */
      wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css');
      /* Navigations Menü laden */
      wp_enqueue_style( 'custom_navbar', get_template_directory_uri() . '/assets/css/custom_navbar.css');
      /* Betrags Style laden */
      wp_enqueue_style( 'custom_content', get_template_directory_uri() . '/assets/css/custom_content.css');
      /* Kommentar Style laden */
      wp_enqueue_style( 'custom_comment', get_template_directory_uri() . '/assets/css/custom_comment.css');
      /* Custom Recent Posts Widget Style laden */
      wp_enqueue_style( 'custom_recent_posts', get_template_directory_uri() . '/assets/css/custom_recent_posts.css');
      /* Custom Gallery Style laden */
      /* wp_enqueue_style( 'custom_gallery', get_template_directory_uri() . '/assets/css/custom_gallery.css'); */
    } 
    add_action('wp_enqueue_scripts','styles_imports');

    /* Skripts importieren */
    function scripts_import() {

      /* Um auf Kommentare zu antworten */
      if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
      }
    }
    add_action('wp_enqueue_scripts','scripts_import');

    /* Navigations Menü aktivieren */
    function fototechnik_blog_register_navbar() {
      register_nav_menus(array('navbar' => __( 'Hauptmenü' ) ));
    }
    add_action('init','fototechnik_blog_register_navbar');

    /* Aktivierung der Beitragsformate */
    add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status'));

    /* Aktivierung der Beitragsbilder */
    add_theme_support('post-thumbnails');
    
    /* Hinzufügen von Bildergrößen */
    add_image_size('fototechnik-blog-thumbnail', 120, 90, true);
    add_image_size('fototechnik-blog-post-nav', 250);
    add_image_size('fototechnik-blog-post-900', 900);
    

    /* Aktivierung des Headerbildes */
    $args = array(
      'width'         => 2000,
      'height'        => 450,
      'default-image' => get_template_directory_uri() . '/assets/images/headerbild.jpg',
      'uploads'       => true,
      'random-default'=> true, /* Wechselt zufällig die Headerbilder */
      'flex-width'    => true,
      'flex-height'    => true,
    );
    add_theme_support( 'custom-header', $args );

    /* Widgets Initialisierung */
    function fototechnik_blog_widgets_inits() {

      /* FotoTechnik-Blog custom_recent_posts.php */
      register_widget( 'fototechnik_blog_recent_posts' );

      /* FotoTechnik-Blog custom_gallery.php */
      /* register_widget( 'fototechnik_blog_gallery' ); */

      /* Widgets in die Seitenleiste einbinden */
      /* Seitenleiste Rechts */
      register_sidebar( 
        array(
            'name' => 'Seitenleiste rechts', //Anzeige Name im Widget Menü
            'id' => 'sidebar_widget', //Die ID für die Widgets
            'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			      'after_widget'	 => '</div>',
			      'before_title'	 => '<div class="widget-title"><h3>',
			      'after_title'	   => '</h3></div>',
          )
      );
      /* Footer Abschnitt */
      register_sidebar( 
        array(
            'name' => 'Footer-Abschnitt', //Anzeige Name im Widget Menü
            'id' => 'footer_widget', //Die ID für die Widgets
            'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			      'after_widget'	 => '</div>',
			      'before_title'	 => '<div class="widget-title"><h3>',
			      'after_title'	   => '</h3></div>',
          )
      );
    } 
    add_action( 'widgets_init','fototechnik_blog_widgets_inits');
    require get_template_directory() . '/assets/widgets/custom_recent_posts.php';

    /* Nächster und Vorheriger Beitrag */
    function fototechnik_blog_post_next_prev(){

      /* Setzt die Flag ob ein Vorheriger oder Nächster Beitrag vorhanden ist */
      $previousPostFlag = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
      $nextPostFlag     = get_adjacent_post( false, '', false );

      /* Wenn es keine neuen Beiträge und älterne Beiträge gibt, wird die Funktion abgebrochen */
      if ( ! $nextPostFlag && ! $previousPostFlag ) {
        return;
      }

      /* Variablen für das Beitragsbild */
      $nextPost          = get_next_post();
      $nextThumbnail     = get_the_post_thumbnail( $nextPost->ID, $size = 'fototechnik-blog-post-nav' );
      $previousPost      = get_previous_post();
      $previousThumbnail = get_the_post_thumbnail( $previousPost->ID, $size = 'fototechnik-blog-post-nav' );
      
      ?><div class="fototechnik-blog-post-other-posts"><?php
        /* Nächster Beitrag */
        if ( $nextPostFlag ) { 
          ?><div class="fototechnik-blog-post-next-post"><?php
            ?><div class="fototechnik-blog-post-next-picture"><?php
              /* Beitragsbild */
              next_post_link( '%link', $nextThumbnail );
              ?></div><?php
                ?><div class="fototechnik-blog-post-next-text"><?php
              /* Text */
              ?><a class="fototechnik-blog-post-next-title"
                href="<?php echo get_page_link($nextPost->ID); ?>">Nächster Beitrag</a><?php
              /* Beitragstitel */
              next_post_link( '%link' );
              /* Datum */
              ?><a href="<?php echo get_page_link($nextPost->ID); ?>">
                  <?php echo mysql2date('d F Y', $nextPost->post_date, false) ?></a><?php
            ?></div><?php
          ?></div><?php
        }
        /* Vorheriger Beitrag */
        if ( $previousPostFlag) {
          ?><div class="fototechnik-blog-post-prev-post"><?php  
            ?><div class="fototechnik-blog-post-prev-text"><?php
              /* Text */
              ?><a class="fototechnik-blog-post-prev-title"
                href="<?php echo get_page_link($nextPost->ID); ?>">Vorheriger Beitrag</a><?php
              /* Beitragstitel */
              previous_post_link( '%link' );
              /* Datum */
              ?><a href="<?php echo get_page_link($previousPost->ID); ?>">
                  <?php echo mysql2date('d F Y', $previousPost->post_date, false) ?></a><?php
            ?></div><?php
            ?><div class="fototechnik-blog-post-prev-picture"><?php
              /* Beitragsbild */
              previous_post_link( '%link', $previousThumbnail );
            ?></div><?php
          ?></div><?php
        }
      ?></div><?php
    }
    
    /* Kommentar Funktion */  
    /* Die Funktion für einen einzelnen Kommentar */
    function fototechnik_blog_comments( $comment, $args, $depth ) { 
        $GLOBALS['comment'] = $comment; ?>
        <li class="comment-single">
        <p class="comment-author"><?php echo get_comment_author_link(); ?> sagte:</p> <?php /* der Link des Kommentierenden */?>
        <p class="comment-date-time">am <?php echo get_comment_date("d.M.Y"); ?> um <?php echo get_comment_time(); ?> Uhr</p> <?php /* Datum und Zeit */?>
        <?php comment_text(); /* Kommentar Text und der Name des Kommentierenden wird ausgegeben */ ?>
        <div class="comment-reply-button">
            <?PHP /* Button um auf Kommentare zu antworten. */
            comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    <?php }
          
    /* Fonts Import */
    function fototechnik_blog_font() {?>
      <style>
        /* open-sans-regular - latin */
        @font-face {
          font-family: 'Open Sans';
          font-style: normal;
          font-weight: 400;
          src: local('Open Sans Regular'), local('OpenSans-Regular'),
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-regular.woff2) format('woff2'), 
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-regular.woff) format('woff'); 
        }
        /* open-sans-italic - latin */
        @font-face {
          font-family: 'Open Sans';
          font-style: italic;
          font-weight: 400;
          src: local('Open Sans Italic'), local('OpenSans-Italic'),
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-italic.woff2) format('woff2'), 
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-italic.woff) format('woff');
        }
        /* pt-sans-regular - latin */
        @font-face {
          font-family: 'PT Sans';
          font-style: normal;
          font-weight: 400;
          src: local('PT Sans'), local('PTSans-Regular'),
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/pt-sans/pt-sans-v11-latin-regular.woff2) format('woff2'), 
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/pt-sans/pt-sans-v11-latin-regular.woff) format('woff');
        }
        /* pt-sans-italic - latin */
        @font-face {
          font-family: 'PT Sans';
          font-style: italic;
          font-weight: 400;
          src: local('PT Sans Italic'), local('PTSans-Italic'),
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/pt-sans/pt-sans-v11-latin-italic.woff2) format('woff2'), 
              url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/pt-sans/pt-sans-v11-latin-italic.woff) format('woff');
        } 
         /* open-sans-light(300) - latin */
         @font-face {
        font-family: 'Open Sans Light';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'),
            url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-300.woff2) format('woff2'), 
            url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-300.woff) format('woff'); 
      }
      /* open-sans-semi-Blod(600) - latin */
      @font-face {
        font-family: 'Open Sans Light Bold';
        font-style: normal;
        font-weight: 600;
        src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'),
            url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-600.woff2) format('woff2'), 
            url(/wp-content/themes/FotoTechnik-Blog/assets/fonts/open-sans/open-sans-v17-latin-600.woff) format('woff'); 
      }
      </style>
    <?php }
    add_action('wp_head','fototechnik_blog_font'); ?>


