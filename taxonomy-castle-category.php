<?php
/* Wird aufgerufen wenn castle category verwendet wird. */

/* Header aufrufen */
get_header();

/* Laed die Castle Beitraege mit der Kategorie "castle_category" */
$term = get_queried_object();
$args = array(
    'post_type' => 'castle',
    'tax_query' => array(
        array(
            'taxonomy' => 'castle-category',
            'field'    => 'slug',
            'terms'    => $term->slug,
        ),
    ),
);

// BENUTZERDEFINIERTE SORTIERUNG NACH NUMMER IM TITEL
add_filter('posts_orderby', 'castle_orderby_title_number', 10, 2);
function castle_orderby_title_number($orderby, $wp_query) {
    global $wpdb;
    
    // Extrahiere die erste Zahl (z. B. aus "13城 – Kawagoe Castle" → 13)
    // REGEXP_SUBSTR ist ab MySQL 8.0 verfügbar – sicherer als SUBSTRING_INDEX, da robust
    // Wenn du MySQL < 8.0 hast, ersetze durch SUBSTRING_INDEX mit '城' als Trenner
    $orderby = "CAST(REGEXP_SUBSTR({$wpdb->posts}.post_title, '^[0-9]+') AS UNSIGNED) ASC";
    
    return $orderby;
}

$query = new WP_Query( $args );

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main">
    <div class="container-article-castle">
        <div class="container-posts-castle">
            <div class="content-article-title-castle">
                200名城 - berühmte japanische Burgen
            </div><?php
            /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) : $query->the_post();
                        // Ruft die Content.php Datei auf, um die Beiträge bzw. Seite anzuzeigen
                        get_template_part('template_parts/content', 'taxonomy-castle');        
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo 'Kein Beitrag gefunden';
                    // Fehlermeldung, es konnten keine Beiträge gefunden werden
                    get_template_part('template_parts/content', 'error');
                endif;
        ?></div>
    </div><?php
    /* sidebar.php aufrufen */
    get_sidebar();
?></main><?php

/* Footer aufrufen */
get_footer(); ?>