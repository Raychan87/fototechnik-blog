<?php
/* Inhalt eines Beitrags aus Posttype Galerie wird von archive-galerie.php aufgerufen. */?>
<article <?php post_class();?>>
    <div class="content-post-galerie">
        <div class="content-title-galerie"><?php 

            /* Überschrift des Beitrages */
            ?><h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1><?php
        ?></div><?php

        if (has_post_thumbnail()) {
            ?><div class ="content-thumb"><?php
                /* Beitragsbild anzeigen */
                ?><a href="<?php the_permalink();?>"><?php the_post_thumbnail('fototechnik-blog-post-900');?></a><?php
            ?></div><?php
        }?>
    </div>
</article>
