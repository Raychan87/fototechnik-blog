<?php
/**
 * FotoTechnik-Blog Remove and Disable Function
 */

function fototechnik_blog_init(){
    /* Sicherheits Funktionen */
    /* add_filter('the_generator', create_function( '$x', 'return;'));  /* Wordpress Version ausblenden */
    /* add_filter('login_errors', create_function('$a',"return null;")); /* Login Fehler deaktivieren */
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
    
    wp_deregister_script('heartbeat'); /* den Wordpress Heartbeat deaktivieren */

    /* Emoticons deaktivieren */
    remove_action('wp_head', 'print_emoji_detection_script', 7 ); 
    remove_action('admin_print_scripts', 'print_emoji_detection_script' );
    remove_action('wp_print_styles', 'print_emoji_styles' ); 
    remove_action('admin_print_styles', 'print_emoji_styles' );
    remove_filter('the_content_feed', 'wp_staticize_emoji' );
    remove_filter('comment_text_rss', 'wp_staticize_emoji' ); 
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter('tiny_mce_plugins', 'disable_emojis_tinymce' );

    /* Embeds deaktivieren */
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );
    add_filter( 'embed_oembed_discover', '__return_false' );
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
    remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
} 
add_action('init','fototechnik_blog_init');

/* Deaktivieren einiger Funktionen */
/* Tinymce Plugin herrausfiltern (für Emoticons) */
function disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
      return array_diff( $plugins, array( 'wpemoji' ) );
    } else {
      return array();
    }
  }
  
  /* Embeds deaktivieren */
  function disable_embeds_tiny_mce_plugin($plugins) {
    return array_diff($plugins, array('wpembed'));
  } 
  function disable_embeds_rewrites($rules) {
    foreach($rules as $rule => $rewrite) {
      if(false !== strpos($rewrite, 'embed=true')) {
        unset($rules[$rule]);
      }
    }
    return $rules;
  }

  /* Deaktivieren der Feed Funktionen */
function fototechnik_blog_disable_feed() {
    wp_die('Keine RSS-Feed verfügbar, Bitte besuchen Sie meine Webseite.');
  }
  add_action('do_feed', 'itsme_disable_feed', 1);
  add_action('do_feed_rdf', 'itsme_disable_feed', 1);
  add_action('do_feed_rss', 'itsme_disable_feed', 1);
  add_action('do_feed_rss2', 'itsme_disable_feed', 1);
  add_action('do_feed_atom', 'itsme_disable_feed', 1);
  add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
  add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
  
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
  
  /* Aktuelle Version von jquery laden */
  /*
  function fototechnik_blog_replace_core_jquery_version( ) {
    wp_deregister_script( 'jquery' );
    wp_register_script(
        'jquery',
        "/wp-content/themes/fototechnik-blog/assets/js/jquery-3.5.1.min.js"
    );
  }
  add_action( 'wp_enqueue_scripts', 'fototechnik_blog_replace_core_jquery_version' );
  */