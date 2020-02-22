<?php
/* Wird zur Ausgabe von einzelnen Beiträgen geladen. */

/* Header aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article">
        <?php /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        while ( have_posts() ) : the_post();
                
            /* Ruft die Content-single.php Datei auf um die Beiträge bzw Seite aufzurufen */
            get_template_part('template_parts/content','single'); 

            /* Beitrags Navigations (siehe functions.php) */ 
            fototechnik_blog_post_next_prev();
            
            /* Kommentare */
            comments_template();
        endwhile;
    ?></div><?php
    /* sidebar.php aufrufen */
    get_sidebar();
?></main><?php

/* Footer aufrufen */?>
<footer class="container_footer">
<?php get_footer(); ?>