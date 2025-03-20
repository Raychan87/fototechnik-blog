<?php
/* Inhalt eines einzelnen Beitrag, wo mehrere Beitrage aufgerufen werden */
?> <article <?php post_class();?>><?php
    if (!has_post_format('image')) {
    ?><div class="content-post">
        <div class="content-title">
            <?php /* Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird */
            if (is_archive()) { 
                /* Überschrift des Beitrages */
                ?><h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><?php
            } else {
                /* Überschrift des Beitrages */
                ?><h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1><?php
            }
        ?></div><?php
        /* Kategorie anzeigen */
        $categories_list = get_the_category_list(', ');
        if ( $categories_list ) {
            echo '<div class="content-categories">' . wp_kses_data( $categories_list ) . '</div>';
        }

        if (has_post_thumbnail() and !has_post_format('aside')) {
            ?><div class ="content-thumb"><?php
                /* Beitragsbild anzeigen */
                the_post_thumbnail('fototechnik-blog-post-900');
            ?></div><?php
        }
        if (has_post_format('aside')) {
            ?><div class="content-text"><?php
                /* Der Inhalt des Beitrages */
                the_excerpt(); /* Übergabe Text für gekürtze Beiträge */
            ?></div><?php
        }
        ?><div class="content-date">
            <?php /* Erzeugt Author und Datum des Beitrags */ ?>
            <p>Von <span class="content-author"><?php the_author(); ?></span> <?php the_time('d. M Y');?>.</p>
        </div>

        <div class="content-readmore" >
            <?php /* Erzeugt den 'Weiterlesen...'-Button */ ?>
            <a href="<?php the_permalink(); ?>">
			    Weiterlesen...
            </a>
        </div>
    </div><?php
    }
?></article>
