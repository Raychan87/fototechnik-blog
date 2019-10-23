<!-- Beitrag -->
<article <?php post_class();?>>
    <!-- Überschrift des Beitrages -->
    <h1><a href="<?php the_permalink();?>"><?php the_title();?></a></h1>
    
    <!-- Erzeugt Author und Datum des Beitrags -->
    <p>Veröffentlich von <?php the_author(); ?> am <?php the_time('d. M Y');?>.</p>
    
    <!-- Der Inhalt des Beitrages -->
    <?php the_content();?>
    
    <!-- Beitrags Navigations (vor und zurück) -->
    <?php previous_post_link();?>
    <?php next_post_link();?>
</article>
