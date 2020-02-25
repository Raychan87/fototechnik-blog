<?php 
/* Header.php aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article"><?php
        /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                /* Ruft die Content-index.php Datei auf um die Beiträge bzw Seite aufzurufen */
                get_template_part('template_parts/content','index');
                       
            endwhile; else :           
                /* Fehlermeldung, es konnten keine Beiträge gefunden werden */
                get_template_part('template_parts/content','error');
        endif;
        
        /* Beitrags Navigations (vor und zurück) */
        fototechnik_blog_numeric_posts_nav();
    ?></div><?php
    /* sidebar.php aufrufen */
    get_sidebar();
?></main><?php

/* footer.php aufrufen */
get_footer(); ?>
