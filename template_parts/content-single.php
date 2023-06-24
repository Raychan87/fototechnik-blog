<?php
/* Inhalt eines einzelnen Beitrag */?>
<article <?php post_class();?>>
    <div class="content-post">
        <div class="content-single-title">
            <?php /* Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird */
            if ( is_archive() ) {
                /* ueberschrift des Beitrages */
                ?><h2><?php the_title();?></h2><?php
            } else {
                /* ueberschrift des Beitrages */
                ?><h1><?php the_title();?></h1><?php
            } 
        ?></div><?php
        /*
        if ( has_post_thumbnail() ) {
            ?><div class ="content-thumb" ><?php */
                /* Beitragsbild anzeigen */
            /*
                the_post_thumbnail('fototechnik-blog-post-900');
            ?></div><?php
        } */

        ?><div class="content-single-text" ><?php
            /* Der Inhalt des Beitrages */
            the_content(); /* uebergabe Text fuer gekuertze Beitraege */
        ?></div><?php
        
        /* Seitenzahl Anzeige wenn der Beitrag zulang ist */
        wp_link_pages();

        ?><div class="content-date">
            <?php /* Erzeugt Author und Datum des Beitrags */ ?>
            <p><?php the_time('d. M Y');?> von <span class="content-author"><?php the_author(); ?>.</p>
        </div>
        
        <?php /* Hole die Kategorien fuer den Beitrag */
		$categories_list = get_the_category_list( ' ' );

		/* Hole die Schlagwoerter fuer den Beitrag */
		$tags_list = get_the_tag_list( '', ' ' );

		/* Nur wenn Kategorie oder Stichwoerter oder der Beitrag bearbeitet werden kann */
		if ( $categories_list || $tags_list || get_edit_post_link() ) {
            ?><div class="content-footer"><?php
                /* Nur wenn es ein Betrag ist */
                if ( 'post' === get_post_type() ) {
                    if ( $categories_list || $tags_list ) { 
                        // Ausgabe der Kategorie Liste
                        if ( $categories_list ) {
                            echo '<div class="content-single-categories"><span class="content-list-type">Kategorie  </span>' . wp_kses_data( $categories_list ) . '</div>';
                        }
                        // Ausgabe der Stichwoerter Liste
                        if ( $tags_list ) {
                            echo '<div class="content-single-tags"><span class="content-list-type">Stichwörter  </span>' . wp_kses_data( $tags_list ) . '</div>';
                        }
                    }
                }
                ?><div class="content-edit"><?php
                    /* Bearbeitungs Button fuer den Admin */
                    edit_post_link();?>
                </div>
			</div>
		<?php } ?>
    </div>
</article>


