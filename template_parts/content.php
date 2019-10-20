<!-- Beitrag -->
<article <?php post_class();?>>
    <!-- Überschrift des Beitrages -->
    <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
    <!-- Der Inhalt des Beitrages -->
    <?php the_content();?>
</article>