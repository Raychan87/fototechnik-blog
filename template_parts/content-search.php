<?php
/* Inhalt eines einzelnen Beitrags, die von der Suche aufgerufen werden  */ ?>
<article <?php post_class();?>>
    <div class="content-post">
        <div class="content-title">
            <?php /* Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird */
            if ( is_archive() ) {
                /* Überschrift des Beitrages */
                ?><h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2><?php
            } else {
                /* Überschrift des Beitrages */
                ?><h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1><?php
            } ?>
        </div>

        <div class ="content-thumb" >
            <?php /* Beitragsbild anzeigen */
            the_post_thumbnail('fototechnik-blog-post-900'); ?>
        </div>

        <div class="content-text" >
            <?php /* Der Inhalt des Beitrages */
            the_excerpt(); /* Übergabe Text für gekürtze Beiträge */ ?>
        </div>

        <div class="content-date">
            <?php /* Erzeugt Author und Datum des Beitrags */ ?>
            <p>Von <span class="content-author"><?php the_author(); ?></span> <?php the_time('d. M Y');?>.</p>
        </div>

        <div class="content-readmore" >
            <?php /* Erzeugt den 'Weiterlesen...'-Button */ ?>
            <a href="<?php the_permalink(); ?>">
			    <?php esc_html_e( 'Weiterlesen...'); ?>
            </a>
        </div>
    </div>
</article>
