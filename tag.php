<?php
/* header.php aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article">
   
   <?php /* Schlagwort als Überschrift und Beschreibung */?>
   <h1 class="content-tag-title">Schlagwort: <?php single_tag_title();?></h1>
   <?php echo tag_description();
   
        /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();

                /* Ruft die Content.php Datei auf um die Beiträge bzw Seite aufzurufen */
                get_template_part('template_parts/content','index');

            endwhile; else :

                /* Fehlermeldung, es konnten keine Beiträge gefunden werden */
                get_template_part('template_parts/content','error');
        endif;
        
        /* Beitrags Navigations (vor und zurück) */
        previous_posts_link();
        next_posts_link();
    ?></div><?php
    /* sidebar.php aufrufen */
    get_sidebar();
?></main><?php

/* footer.php aufrufen */?>
<footer class="container_footer">
<?php get_footer(); ?>