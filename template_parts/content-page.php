<?php
/* Inhalt einer Statischen Seite */?>
<article <?php post_class();?>>
    <div class="page-post">
        <div class="page-title">
            <?php /* Überschrift der Seite */ ?>
            <h1><?php the_title();?></h1>
        </div>
        <div class="page-text">
            <?php /* Inhalt der Seite */
            the_content();
        ?></div><?php
        if ( get_edit_post_link() ) {?>
            <div class="page-edit">
                <?php /* Bearbeitungs Button für den Admin */
                edit_post_link(); ?>
            </div>
        <?php } ?>
    </div>
</article>
