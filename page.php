<?php
/* Um eine einzelne, statische Seite anzuzeigen, wird die page.php des Themes aufgerufen. */

/* Header aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main">
    <div class="container-article"> 
        <?php /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                /* Ruft die Content-page.php Datei auf um die Beiträge bzw Seite aufzurufen */
                get_template_part('template_parts/content','page');   
            endwhile; else :
                
                /* Fehlermeldung, es konnten keine Beiträge gefunden werden */
                get_template_part('template_parts/content','error');
        endif;
    ?></div><?php
    /* sidebar.php aufrufen */
    get_sidebar();
?></main><?php

/* Footer aufrufen */?>
<footer class="container_footer">
<?php get_footer(); ?>
