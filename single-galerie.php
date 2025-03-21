<?php
/* Ruft ein einzelnen Beitrag auf für Posttype Galerie und springt zu content-single-galerie.php */

/* Header aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article-galerie">
        <?php /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        while ( have_posts() ) : the_post();
                
            /* Ruft die Content-single.php Datei auf um die Beiträge bzw Seite aufzurufen */
            get_template_part('template_parts/content','single-galerie'); 

        endwhile;
    ?></div>
</main><?php

/* Footer aufrufen */
get_footer(); ?>