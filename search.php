<?php
/* header.php aufrufen */
get_header();

/* Der Loop wird in ein Container gepackt */?>
<main class="container-main"> 
    <div class="container-article">
        <div class="container-search-h1">
          <h1>Suchergebnis: <?php echo $s ;?></h1>
        </div>
    
        <?php /* Der Loop laeuft nur die Anzahl der angegeben Beitraege in den Einstellungen */
        if ( have_posts() ) : while ( have_posts() ) : the_post();
                
                /* Ruft die Content-search.php Datei auf um die Beitraege bzw Seite aufzurufen */
                get_template_part('template_parts/content','search');
            endwhile; else :
                
                /* Fehlermeldung, es konnten keine Beitraege gefunden werden */
                get_template_part('template_parts/content','error');
        endif;
        
        /* Beitrags Navigations (vor und zurueck) */
        ?><div class="container-search-previous-next">
        <div class="container-search-previous"><?php
            previous_posts_link();
        ?></div><?php
        ?><div class="container-search-next"><?php
            next_posts_link(); 
        ?></div></div><?php
    ?></div><?php
    /* sidebar.php aufrufen */
    get_sidebar();
?></main><?php

/* footer.php aufrufen */
get_footer(); ?>