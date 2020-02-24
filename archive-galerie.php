<?php
/**
* Template Name: Archive Galerie Template
*/

/* Header.php aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-gallery-main"> 
    <div class="container-gallery-article"><?php

        /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                /* Ruft die Content-index.php Datei auf um die Beiträge bzw Seite aufzurufen */
                get_template_part('template_parts/content','galerie');
                       
        endwhile;  endif;        

    ?></div><?php
?></main><?php

/* footer.php aufrufen */
get_footer(); ?>



