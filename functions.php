<?php
/**
 * FotoTechnik Blog functions and definitions
 * 
 * @link https://github.com/Raychan87/fototechnik-blog
 * @package fototechnik-blog
 * @since 1.0
 * 
 */

/**
 * 
 * Theme Setup
 * 
 */
function fototechnik_blog_setup() {
  /* Theme Lang.
  /* load_theme_textdomain( 'head-blog', get_template_directory() . '/languages' ); */

  /* Fügt die RSS Feed Links für Beitraege und Kommentare ein */
  /* add_theme_support( 'automatic-feed-links' ); */

  /* Zeigt den Titel im Browser Tab an */
  add_theme_support( 'title-tag' );

  /* HTML5 Converter */
  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'script',
      'style',
    )
  );

  /* Hintergrund Bild oder Farbe */
  $args_background = array(
    'default-image' => get_template_directory_uri() . '/assets/images/background.png',
    'default-repeat'         => 'repeat',
	  'default-position-x'     => 'left',
    'default-position-y'     => 'top',
    'default-size'           => 'auto',
	  'default-attachment'     => 'scroll',
	  'wp-head-callback'       => '_custom_background_cb',
  );
  add_theme_support( 'custom-background', $args_background );

  /* Navigations Menue aktivieren */
  register_nav_menus(
    array(
      'navbar' => ( 'Hauptmenü' ) 
    )
  );

  /* Content Width gibt die Maximale des Inhaltsbereich ohne Rahmen an */
  global $content_width;
  if ( ! isset( $content_width ) ) {
    $content_width = 1320;
  }

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

  /* Aktivierung der Beitragsformate */
  add_theme_support( 'post-formats', array( 'aside', 'gallery'));
}
add_action( 'after_setup_theme', 'fototechnik_blog_setup' );

/**
 * 
 * Required Files
 * 
 */
/* Remove and disbale function */
require get_template_directory() . '/assets/inc/remove_and_disable.php';
/* Naechster und Vorheriger Beitrag */
require get_template_directory() . '/assets/inc/post_next_prev.php';
/* Numerische Seitenangabe Funktion */
require get_template_directory() . '/assets/inc/numeric_posts_nav.php';

/**
 * 
 * Register Styles and Scripts
 * 
 */
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

/**
 * 
 * Widgets Initialisierung
 * 
 */
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
  /* Footer Abschnitt nur für Posttype Galerie */
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
/* Widget Plugin */
require get_template_directory() . '/assets/widgets/custom_recent_posts.php';

/**
 * 
 * Custom Post Types
 * 
 */
/* Fotogalerie Bereich aktivieren */
function fototechnik_blog_create_post_type() {
  /* https://codex.wordpress.org/Function_Reference/register_post_type */
  $labels = array(
    'name'               => 'Fotogalerien', 'post type general name',
    'singular_name'      => 'Fotogalerie', 'post type singular name',
    'add_new'            => 'Neue Fotogalerie anlegen',
    'add_new_item'       => 'Neue Fotogalerie anlegen',
    'edit_item'          => 'Fotogalerie bearbeiten',
    'new_item'           => 'Neue Fotogalerie',
    'all_items'          => 'Alle Fotogalerien',
    'view_item'          => 'Fotogalerie ansehen',
    'search_items'       => 'Fotogalerien durchsuchen',
    'not_found'          => 'Keine Fotogalerie gefunden',
    'not_found_in_trash' => 'Keine Fotogalerie im Papierkorb gefunden',
    'parent_item_colon'  => '',
    'menu_name'          => 'Fotogalerie'
  );
  // Werte des neuen Custom Post Types werden zugewiesen
  $args = array(
      'labels'              => $labels,
      'description'         => 'Hier können Fotogalerien angelegt werden.',
      'hierarchical'        => false,
      'public'              => true,
      'show_ui'             => true,
      'show_in_menu'        => true,
      'show_in_nav_menus'   => true,
      'show_in_admin_bar'   => true,
      'publicly_queryable'  => true,
      'exclude_from_search' => true, /* Wird von der Suche ausgeschlossen */
      'supports'            => array( 'title','editor','thumbnail','revisions'),
      'has_archive'         => true,
      'can_export'          => true,
      'menu_position'       => 5,
      'capability_type'     => 'post',
      'rewrite'             => array('slug' => 'galerie' )
  );
  register_post_type( 'galerie', $args );
}
add_action( 'init', 'fototechnik_blog_create_post_type' );

// Ändert die Anzahl an Beiträge für die Fotogalerie
function fototechnik_blog_fotogalerie_query( $query ) {
  if ( $query->is_archive() && $query->is_main_query() && !is_admin() ) {
          $query->set( 'posts_per_page', 100 );
      }
  }
  add_action( 'pre_get_posts', 'fototechnik_blog_fotogalerie_query' );

/**
 * 
 * Kommentar Funktion
 * 
 */  
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
      
/**
 * 
 * Fonts Import
 * 
 */ 
function fototechnik_blog_font() {?>
  <style>
    /* open-sans-regular - latin */
    @font-face {
      font-family: 'Open Sans';
      font-style: normal;
      font-weight: 400;
      src: local('Open Sans Regular'), local('OpenSans-Regular'),
          url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-regular.woff2) format('woff2'), 
          url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-regular.woff) format('woff'); 
    }
    /* open-sans-italic - latin */
    @font-face {
      font-family: 'Open Sans';
      font-style: italic;
      font-weight: 400;
      src: local('Open Sans Italic'), local('OpenSans-Italic'),
          url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-italic.woff2) format('woff2'), 
          url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-italic.woff) format('woff');
    }
    /* pt-sans-regular - latin */
    @font-face {
      font-family: 'PT Sans';
      font-style: normal;
      font-weight: 400;
      src: local('PT Sans'), local('PTSans-Regular'),
          url(/wp-content/themes/fototechnik-blog/assets/fonts/pt-sans/pt-sans-v11-latin-regular.woff2) format('woff2'), 
          url(/wp-content/themes/fototechnik-blog/assets/fonts/pt-sans/pt-sans-v11-latin-regular.woff) format('woff');
    }
    /* pt-sans-italic - latin */
    @font-face {
      font-family: 'PT Sans';
      font-style: italic;
      font-weight: 400;
      src: local('PT Sans Italic'), local('PTSans-Italic'),
          url(/wp-content/themes/fototechnik-blog/assets/fonts/pt-sans/pt-sans-v11-latin-italic.woff2) format('woff2'), 
          url(/wp-content/themes/fototechnik-blog/assets/fonts/pt-sans/pt-sans-v11-latin-italic.woff) format('woff');
    } 
      /* open-sans-light(300) - latin */
      @font-face {
    font-family: 'Open Sans Light';
    font-style: normal;
    font-weight: 300;
    src: local('Open Sans Light'), local('OpenSans-Light'),
        url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-300.woff2) format('woff2'), 
        url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-300.woff) format('woff'); 
    }
    /* open-sans-semi-Blod(600) - latin */
    @font-face {
      font-family: 'Open Sans Light Bold';
      font-style: normal;
      font-weight: 600;
      src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'),
          url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-600.woff2) format('woff2'), 
          url(/wp-content/themes/fototechnik-blog/assets/fonts/open-sans/open-sans-v17-latin-600.woff) format('woff'); 
    }
    /* nothing-you-could-do-regular - latin */
    @font-face {
    font-family: 'Nothing You Could Do';
    font-style: normal;
    font-weight: 400;
    src: local('Nothing You Could Do'), local('NothingYouCouldDo'),
        url(/wp-content/themes/fototechnik-blog/assets/fonts/nothingyoucoulddo/nothing-you-could-do-v9-latin-regular.woff2) format('woff2'), /* Super Modern Browsers */
        url(/wp-content/themes/fototechnik-blog/assets/fonts/nothingyoucoulddo/nothing-you-could-do-v9-latin-regular.woff) format('woff'); /* Modern Browsers */
    }
  </style>
<?php }
add_action('wp_head','fototechnik_blog_font');

/**
 * 
 *  SEO funktion
 *  https://fastwp.de/magazin/automatische-seo-meta-tags
 */
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
