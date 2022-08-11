<?php
/* Inhalt einer statischen "new picture" Seite */?>
<article <?php post_class();?>>
    <div class="page-post">
        <div class="page-text">
            <?php /* Inhalt der Seite */
            the_content();
        ?></div><?php
        /* Seitenzahl Anzeige wenn der Beitrag zulang ist */
        wp_link_pages();
        
        if ( get_edit_post_link() ) {?>
            <div class="page-edit">
                <?php /* Bearbeitungs Button für den Admin */
                edit_post_link(); ?>
            </div>
        <?php } ?>
    </div>
</article>
