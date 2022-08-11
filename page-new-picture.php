<?php 
/**
* Template Name: New Picture Page
*/
 
/* Header aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main">
    <div class="container-article"> 
        <?php /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                /* Ruft die content-new-picture.php Datei auf um die Beiträge bzw Seite aufzurufen */
                get_template_part('template_parts/content','new-picture');   
            endwhile; else :
                
                /* Fehlermeldung, es konnten keine Beiträge gefunden werden */
                get_template_part('template_parts/content','error');
        endif;
    ?></div><?php
    /* sidebar.php aufrufen */
    get_sidebar();
?></main><?php

/* Footer aufrufen */
get_footer(); ?>
