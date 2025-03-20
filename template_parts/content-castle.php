<?php
/* Inhalt eines Posttype castle */?>
<article <?php post_class();?>>
    <div class="content-post-castle">
        <div class="content-title-castle"><?php 

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
