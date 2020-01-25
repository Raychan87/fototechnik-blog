<?php
/* header.php aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article">
        <div class="container-search-h1">
          <h1>Suchergebnisse für: <?php echo $s ;?></h1>
        </div>
    
        <?php /* Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                /* Ruft die Content-search.php Datei auf um die Beiträge bzw Seite aufzurufen */
                get_template_part('template_parts/content','search');
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

/* footer.php aufrufen */
get_footer();
?>
