<!-- Inhalt eines einzelnen Beitrag -->
<article <?php post_class();?>>
    <div class="content-post">

        <div class ="content-single-thumb" >
            <!-- Beitragsbild anzeigen -->
            <?php the_post_thumbnail('medium'); ?>
        </div>

        <div class="content-single-title">
            <!-- Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird -->
            <?php if (is_archive()) { ?>
                <!-- Überschrift des Beitrages -->
                <h2><?php the_title();?></h2>
            <?php } else { ?>
                <!-- Überschrift des Beitrages -->
                <h1><?php the_title();?></h1>
            <?php } ?>
        </div>

        <div class="content-date">
            <!-- Erzeugt Author und Datum des Beitrags -->
            <p><?php the_time('d. M Y');?> von <span class="content-author"><?php the_author(); ?>.</p>
        </div>

        <div class="content-single-text" >
            <!-- Der Inhalt des Beitrages -->
            <?php the_content();?> <!-- Übergabe Text für gekürtze Beiträge -->
        </div>
        
        <!-- Hole die Kategorien für den Beitrag -->
		<?php $categories_list = get_the_category_list( ' ' ); ?>

		<!-- Hole die Schlagwörter für den Beitrag -->
		<?php $tags_list = get_the_tag_list( '', ' ' ); ?>

		<!-- Nur wenn Kategorie oder Stichwörter oder der Beitrag bearbeitet werden kann -->
		<?php if ( $categories_list || $tags_list || get_edit_post_link() ) {?>
            <div class="content-footer">
                <!-- Nur wenn es ein Betrag ist -->
                <?php if ( 'post' === get_post_type() ) {
                    if ( $categories_list || $tags_list ) { 
                        // Ausgabe der Kategorie Liste
                        if ( $categories_list ) {
                            echo '<div class="content-categories"><span class="content-list-type">Kategorie  </span>' . wp_kses_data( $categories_list ) . '</div>';
                        }
                        // Ausgabe der Stichwörter Liste
                        if ( $tags_list ) {
                            echo '<div class="content-tags"><span class="content-list-type">Stichwörter  </span>' . wp_kses_data( $tags_list ) . '</div>';
                        }
                    }
                }?>
                <div class="content-edit">
                    <!-- Bearbeitungs Button für den Admin -->
                    <?php edit_post_link(); ?>
                </div>
			</div>
		<?php } ?>
    </div>
</article>


