<?php
/**
 * Naechster und Vorheriger Beitrag Funktion
 */
function fototechnik_blog_post_next_prev(){

  /* Setzt die Flag ob ein Vorheriger oder Naechster Beitrag vorhanden ist */
  $previousPostFlag = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
  $nextPostFlag     = get_adjacent_post( false, '', false );

  /* Wenn es keine neuen Beitraege und aelterne Beitraege gibt, wird die Funktion abgebrochen */
  if ( ! $nextPostFlag && ! $previousPostFlag ) {
    return;
  }

  ?><div class="fototechnik-blog-post-other-posts"><?php
    /* Naechster Beitrag */
    if ( $nextPostFlag ) { 

      /* Variablen fuer das Beitragsbild */
      $nextPost          = get_next_post();
      $nextThumbnail     = get_the_post_thumbnail( $nextPost->ID, $size = 'fototechnik-blog-post-nav' );

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

      /* Variablen fuer das Beitragsbild */
      $previousPost      = get_previous_post();
      $previousThumbnail = get_the_post_thumbnail( $previousPost->ID, $size = 'fototechnik-blog-post-nav' );

      ?><div class="fototechnik-blog-post-prev-post"><?php  
        ?><div class="fototechnik-blog-post-prev-text"><?php
          /* Text */
          ?><a class="fototechnik-blog-post-prev-title"
            href="<?php echo get_page_link($previousPost->ID); ?>">Vorheriger Beitrag</a><?php
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