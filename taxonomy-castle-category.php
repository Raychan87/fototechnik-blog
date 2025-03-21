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