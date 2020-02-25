<?php
/**
 * 
 * Numerische Seitenangabe Funktion
 * 
 */
function fototechnik_blog_numeric_posts_nav() {
  /* Wenn es sich um einen einzelnen Beitrag handelt, dann */
  if (is_singular()) {
    return;
  }
  global $wp_query;

  /* Wenn nur eine Seite vorhanden ist, dann */
  if ( $wp_query -> max_num_pages <= 1){
    return;
  }

  /* Wenn es eine Seitenzahl gibt, dann schreibe dies in paged */
  if (get_query_var( 'paged' )){
    $paged = absint( get_query_var( 'paged' ) );
  }else{
    $paged = 1;
  }
  /* ????????????? */
  $max   = intval( $wp_query->max_num_pages );

   /* Fügt die aktuelle Seite den Array hinzu */
   if ( $paged >= 1 )
   $links[] = $paged;

  /* Fügt 2 Seiten Unterhalb der aktuellen Seite hinzu */
  if ( $paged >= 3 ) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }
  /* Fügt 2 Seiten oberhalb der aktuellen Seite hinzu */
  if ( ( $paged + 2 ) <= $max ) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }
  echo '<div class="fototechnik-blog-numeric-posts-nav"><ul>' . "\n";

  /* Vorherige Seiten Link */
  if ( get_previous_posts_link() ) {
    printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
  }

  /* Link zur ersten Seite, ggf. mit Ellipsen */
  if ( ! in_array( 1, $links ) ) {

    if ( $paged == 1 ){
      $class = ' class="active"';
    } else {
      $class = '';
    }

    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

    if ( ! in_array( 2, $links ) ){
        echo '<li>…</li>';
    }
  }

  /* Link zur aktuellen Seite, plus 2 Seiten in beide Richtungen, falls erforderlich */
  sort( $links );
  foreach ( (array) $links as $link ) {

    if ( $paged == $link ){
      $class = ' class="active"';
    } else {
      $class = '';
    }

    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
  } 

  /* Link zur letzten Seite, ggf. mit Ellipsen */
  if ( ! in_array( $max, $links ) ) {
    if ( ! in_array( $max - 1, $links ) ) {
      echo '<li>…</li>' . "\n";
    }

    if ( $paged == $max ){
      $class = ' class="active"';
    } else {
      $class = '';
    }

    printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
  }

  /* Naechsten Seiten Link */
  if ( get_next_posts_link() ){
    printf( '<li>%s</li>' . "\n", get_next_posts_link() );
  }

  echo '</ul></div>' . "\n";
}