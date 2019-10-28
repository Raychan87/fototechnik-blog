<!-- Beitrag -->
<article <?php post_class();?>>
    
    <!-- Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird -->
    <?php if (is_archive()) { ?>
        <!-- Überschrift des Beitrages -->
        <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <?php } else { ?>
        <!-- Überschrift des Beitrages -->
        <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    <?php } ?>
    
    <!-- Kategorie anzeigen -->
    <?php the_category(', ');?>
    
    <!-- Erzeugt Author und Datum des Beitrags -->
    <p>Veröffentlich von <?php the_author(); ?> am <?php the_time('d. M Y');?>.</p>
    
    <!-- Der Inhalt des Beitrages -->
    <?php the_content('weiterlesen >>');?> /* Übergabe Text für gekürtze Beiträge */
    
    <!-- Schlagwörter anzeigen -->
    <?php the_tags();?>
    
    <!-- Beitrags Navigations (vor und zurück) -->
    <?php previous_post_link();?>
    <?php next_post_link();?>
</article>
