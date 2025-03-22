<?php
/* Wird vom taxonomy-castle_category.php aufgerufen */
?> <article <?php post_class();?>><?php
    if (!has_post_format('image')) {
    ?><div class="content-post-castle">
        <div class="content-title-castle">
            <?php /* Überschrift des Beitrages */ ?>
            <a href="<?php the_permalink();?>"><?php the_title();?></a>
        </div><?php

        if (has_post_thumbnail()) { /* Beitragsbild anzeigen */
            ?><div class ="content-thumb-castle">
                <a href="<?php the_permalink();?>"><?php
                the_post_thumbnail('fototechnik-blog-post-900');?></a>
            </div><?php
        }
    ?></div><?php
    }
?></article>
