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
        /* Das WLW Manifest dient als Beschreibung fuer externe Editoren, um auf den WordPress Blog zugreifen zu koennen. */
        remove_action('wp_head', 'wlwmanifest_link' ); /* WLW Manifest entfernen */
        remove_action('wp_head', 'print_emoji_detection_script', 7 ); /* Emoticons deaktivieren */
        remove_action('admin_print_scripts', 'print_emoji_detection_script' ); /* Emoticons deaktivieren */
        remove_action('wp_print_styles', 'print_emoji_styles' ); /* Emoticons deaktivieren */
        remove_action('admin_print_styles', 'print_emoji_styles' ); /* Emoticons deaktivieren */
        remove_filter('the_content_feed', 'wp_staticize_emoji' ); /* Emoticons deaktivieren */
        remove_filter('comment_text_rss', 'wp_staticize_emoji' ); /* Emoticons deaktivieren */
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email' ); /* Emoticons deaktivieren */
        add_filter('tiny_mce_plugins', 'disable_emojis_tinymce' ); /* Emoticons deaktivieren */ 
        wp_deregister_script('wp-embed'); /* Deaktivieren von Embed https://fastwp.de/magazin/wordpress-embeds-und-responsive-images-deaktivieren/ */
    } 
    add_action('init','fototechnik_blog_safety_function');

    /* Tinymce Plugin herrausfiltern */
    function disable_emojis_tinymce( $plugins ) {
      if ( is_array( $plugins ) ) {
        return array_diff( $plugins, array( 'wpemoji' ) );
      } else {
        return array();
      }
    }

    /* Der Heartbeat ist für den Autosafe im Beitrageditor usw.widget
    https://fastwp.de/magazin/wordpress-heartbeat-api-deaktivieren/ */
    function stop_heartbeat() {
	    wp_deregister_script('heartbeat');
    }
    add_action('init', 'stop_heartbeat', 1);

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

    /* Zeigt den Titel im Browser Tab an */
    add_theme_support( 'title-tag' );

    /* Content Width gibt die Maximale des Inhaltsbereich ohne Rahmen an */
    function fototechnik_blog_content_width() {
      $GLOBALS['content_width'] = apply_filters( 'fototechnik_blog_content_width', 1320 );
    }
    add_action( 'after_setup_theme', 'fototechnik_blog_content_width', 0 );

    /* Deaktivieren der Feed Funktionen */
    function fototechnik_blog_disable_feed() {
      wp_die(__('<p>Feed nicht verfügbar. Schau mal hier: <a href="'.get_bloginfo('url').'">Homepage</a>!</p>'));
     }
     add_action('do_feed', 'fototechnik_blog_disable_feed', 1);
     add_action('do_feed_rdf', 'fototechnik_blog_disable_feed', 1);
     add_action('do_feed_rss', 'fototechnik_blog_disable_feed', 1);
     add_action('do_feed_rss2', 'fototechnik_blog_disable_feed', 1);
     add_action('do_feed_atom', 'fototechnik_blog_disable_feed', 1);

    /* Aktivierung der Beitragsformate */
     add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status'));

    /* CSS Styles importieren */
    function styles_imports() {  
      /* Style.css laden */
      wp_enqueue_style( 'style', get_stylesheet_uri() );
      /* normalize.css laden */
      wp_enqueue_style( 'normalize', get_template_directory_uri() . '/assets/css/normalize.css');
      /* Wordpress Core laden */
      wp_enqueue_style( 'wordpress_core', get_template_directory_uri() . '/assets/css/wordpress_core.css');
      /* Navigations Menue laden */
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

    /* Navigations Menue aktivieren */
    function fototechnik_blog_register_navbar() {
      register_nav_menus(array('navbar' => ( 'Hauptmenü' ) ));
    }
    add_action('init','fototechnik_blog_register_navbar');

    /* Aktivierung der Beitragsbilder */
    add_theme_support('post-thumbnails');
    
    /* Hinzufuegen von Bildergroessen */
    add_image_size('fototechnik-blog-thumbnail', 120, 90, true);
    add_image_size('fototechnik-blog-post-nav', 250);
    add_image_size('fototechnik-blog-post-900', 900);

    /* Aktivierung des Headerbildes */
    $args = array(
      'width'         => 2000,
      'height'        => 450,
      'default-image' => get_template_directory_uri() . '/assets/images/headerbild.jpg',
      'uploads'       => true,
      'random-default'=> true, /* Wechselt zufaellig die Headerbilder */
      'flex-width'    => true,
      'flex-height'   => true,
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
            'name' => 'Seitenleiste rechts', //Anzeige Name im Widget Menue
            'id' => 'sidebar_widget', //Die ID fuer die Widgets
            'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			      'after_widget'	 => '</div>',
			      'before_title'	 => '<div class="widget-title"><h3>',
			      'after_title'	   => '</h3></div>',
          )
      );
      /* Footer Abschnitt */
      register_sidebar( 
        array(
            'name' => 'Footer-Abschnitt', //Anzeige Name im Widget Menue
            'id' => 'footer_widget', //Die ID fuer die Widgets
            'before_widget'	 => '<div id="%1$s" class="widget %2$s">',
			      'after_widget'	 => '</div>',
			      'before_title'	 => '<div class="widget-title"><h3>',
			      'after_title'	   => '</h3></div>',
          )
      );
    } 
    add_action( 'widgets_init','fototechnik_blog_widgets_inits');
    require get_template_directory() . '/assets/widgets/custom_recent_posts.php';

    /* Naechster und Vorheriger Beitrag */
    function fototechnik_blog_post_next_prev(){

      /* Setzt die Flag ob ein Vorheriger oder Naechster Beitrag vorhanden ist */
      $previousPostFlag = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
      $nextPostFlag     = get_adjacent_post( false, '', false );

      /* Wenn es keine neuen Beitraege und aelterne Beitraege gibt, wird die Funktion abgebrochen */
      if ( ! $nextPostFlag && ! $previousPostFlag ) {
        return;
      }

      /* Variablen fuer das Beitragsbild */
      $nextPost          = get_next_post();
      $nextThumbnail     = get_the_post_thumbnail( $nextPost->ID, $size = 'fototechnik-blog-post-nav' );
      $previousPost      = get_previous_post();
      $previousThumbnail = get_the_post_thumbnail( $previousPost->ID, $size = 'fototechnik-blog-post-nav' );
      
      ?><div class="fototechnik-blog-post-other-posts"><?php
        /* Naechster Beitrag */
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
    /* Die Funktion fuer einen einzelnen Kommentar */
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
    add_action('wp_head','fototechnik_blog_font');

    /* SEO funktion */
    /* https://fastwp.de/magazin/automatische-seo-meta-tags/ */
    function FastWP_seo() {
    global $page, $paged, $post;
    $default_keywords = 'asien,tokyo,tokio,osaka,kyoto,japan,kamera,camera,natur,landschaft,fotografie,foto,photo,synology,diskstation,wordpress,raspberry,pi,deutschland,deutsch,html,css,php,webseite,website,';
    $output = '';

    $description = get_bloginfo('description', 'display');
    $pagedata = get_post($post->ID);
    if (is_singular()) {
    if (!empty($pagedata)) {
        $content = apply_filters('the_content', $pagedata->post_content);
        $content = substr(trim(strip_tags($content)), 0, 145) . '...';
        $content = preg_replace('#\n#', ' ', $content);
        $content = preg_replace('#\s{2,}#', ' ', $content);
      } 
    } else {
      $content = $description;	
    }
    $output .= '' . "\n";

    $cats = get_the_category();
      if (!empty($cats)) foreach($cats as $cat) $keys .= $cat->name . ', ';
      $keys .= $default_keywords;
    $output .= "\t\t" . '' . "\n";

    if (is_category()) {
      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      if ($paged > 1) {
        $output .=  "\t\t" . '' . "\n";
      } else {
        $output .=  "\t\t" . '' . "\n";
      }
    } else if (is_home() || is_singular()) {
      $output .=  "\t\t" . '' . "\n";
    } else {
      $output .= "\t\t" . '' . "\n";
    }

    $url = ltrim(esc_url($_SERVER['REQUEST_URI']), '/');
    $name = get_bloginfo('name', 'display');
    $title = trim(wp_title('', false));
    $cat = single_cat_title('', false);
    $search = get_search_query();

    if ($paged >= 2 || $page >= 2) $page_number = ' | ' . sprintf('Seite %s', max($paged, $page));
    else $page_number = '';

    if (is_home() || is_front_page()) $seo_title = $name . ' | ' . $description;
    elseif (is_singular())            $seo_title = $title . ' | ' . $name;
    elseif (is_category())            $seo_title = '' . $cat . ' | ' . $name;
    elseif (is_archive())             $seo_title = ' ' . $title . ' | ' . $name;
    elseif (is_search())              $seo_title = '' . $search . ' | ' . $name;
    elseif (is_404())                 $seo_title = '' . $url . ' | ' . $name;
    else                              $seo_title = $name . ' | ' . $description;

    $output .= "\t\t" . '' . "\n";

    return $output;
  }
