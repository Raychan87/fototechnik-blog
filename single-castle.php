<?php
/* Wird zur Ausgabe von einzelnen Beiträge geladen. 
 für Posttype castle */

/* Header aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article-castle">
        <?php /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        while ( have_posts() ) : the_post();
                
            /* Ruft die Content-single.php Datei auf um die Beiträge bzw Seite aufzurufen */
            get_template_part('template_parts/content','single-castle'); 

        endwhile;
    ?></div>
</main><?php

/* Footer aufrufen */
get_footer(); ?>