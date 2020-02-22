<?php
/**
* Template Name: Archive Galerie Template
*/

/* Header.php aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article"><?php

        /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                /* Ruft die Content-index.php Datei auf um die Beiträge bzw Seite aufzurufen */
                get_template_part('template_parts/content','galerie');
                       
        endwhile;  endif;        

        /* Beitrags Navigations (vor und zurück) */
        previous_posts_link();
        next_posts_link();
    ?></div><?php
    /* sidebar.php aufrufen */
   /* get_sidebar(); */
?></main><?php

/* footer.php aufrufen */?>
<footer class="container_footer">
        <div class="footer-widget">
            <?php /* Wenn der Footer kein Widget hat, wird dieses Feld ausgeblendet */
            if( is_active_sidebar('footer_widget') ):
                /* Bindet die Widgets in den Footer ein */
                dynamic_sidebar('footer_widget');
            endif;
        ?></div>
<?php get_footer(); ?>


