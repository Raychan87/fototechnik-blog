<!-- Inhalt eines einzelnen Beitrag, wo mehrere Beitrage aufgerufen werden -->
<article <?php post_class();?>>
    <div class="content-post">
        <div class="content-title">
            <!-- Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird -->
            <?php if (is_archive()) { ?>
                <!-- Überschrift des Beitrages -->
                <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
            <?php } else { ?>
                <!-- Überschrift des Beitrages -->
                <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
            <?php } ?>
        </div>
        <!-- Kategorie anzeigen -->
        <?php $categories_list = get_the_category_list(', '); ?>
        <?php if ( $categories_list ) { ?>
            <?php echo '<div class="content-categories">' . wp_kses_data( $categories_list ) . '</div>'; ?>
        <?php } ?>

        <div class ="content-thumb" >
            <!-- Beitragsbild anzeigen -->
            <?php the_post_thumbnail('medium'); ?>
        </div>
        
        <div class="content-text" >
            <!-- Der Inhalt des Beitrages -->
            <?php the_content('weiterlesen >>');?> <!-- Übergabe Text für gekürtze Beiträge -->
        </div>

        <div class="content-date">
            <!-- Erzeugt Author und Datum des Beitrags -->
            <p>Von <span class="content-author"><?php the_author(); ?></span> <?php the_time('d. M Y');?>.</p>
        </div>
    </div>
</article>
