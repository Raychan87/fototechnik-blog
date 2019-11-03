    <!-- Sicherheits Funktion -->
    <?php function fototechnik_blog_safety_function(){
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
    add_action('init','fototechnik_blog_safety_function'); ?>

    <!-- Hiermit wird die direkte Verbindung von xmlrpc.php und x-pingback entfernt -->
    <?php function fototechnik_blog_remove_x_pingback( $headers ){
        unset( $headers['X-Pingback'] );
        return $headers;
    }
    add_filter( 'wp_headers', 'fototechnik_blog_remove_x_pingback' ); ?>
               
    <!-- HTML5 Converter -->
    <?php add_theme_support ('html5', array('search-from','comment-form','comment-list','gallery','caption'));?> 







<!-- http://cssmenumaker.com/blog/wordpress-3-drop-down-menu-tutorial/ -->



    <?php add_action('wp_enqueue_scripts', 'cssmenumaker_scripts_styles' );

    function cssmenumaker_scripts_styles() {  
        wp_enqueue_style( 'cssmenu-styles', get_template_directory_uri() . '/assets/css/cssmenu_styles.css');
    } ?>

<?php
class CSS_Menu_Maker_Walker extends Walker {

var $db_fields = array( 'parent' => 'menu_item_parent', 'id' => 'db_id' );

function start_lvl( &$output, $depth = 0, $args = array() ) {
  $indent = str_repeat("\t", $depth);
  $output .= "\n$indent<ul>\n";
}

function end_lvl( &$output, $depth = 0, $args = array() ) {
  $indent = str_repeat("\t", $depth);
  $output .= "$indent</ul>\n";
}

function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

  global $wp_query;
  $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
  $class_names = $value = '';        
  $classes = empty( $item->classes ) ? array() : (array) $item->classes;

  /* Add active class */
  if(in_array('current-menu-item', $classes)) {
    $classes[] = 'active';
    unset($classes['current-menu-item']);
  }

  /* Check for children */
  $children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
  if (!empty($children)) {
    $classes[] = 'has-sub';
  }

  $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
  $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

  $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
  $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

  $output .= $indent . '<li' . $id . $value . $class_names .'>';

  $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
  $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
  $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
  $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

  $item_output = $args->before;
  $item_output .= '<a'. $attributes .'><span>';
  $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
  $item_output .= '</span></a>';
  $item_output .= $args->after;

  $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
}

function end_el( &$output, $item, $depth = 0, $args = array() ) {
  $output .= "</li>\n";
}
}?>












    <!-- Aktivierung der Beitragsformate -->
    <!-- https://wordpress.org/support/article/post-formats/ -->
    <!-- Training Kapitel 6.4 -->
    <?php add_theme_support( 'post-formats', array( 'aside', 'gallery', 'image', 'quote', 'status')); ?>

    <!-- Aktivierung der Beitragsbilder -->
    <?php add_theme_support(' post-thumbnails'); ?>
    
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
            
    
    
            
            
