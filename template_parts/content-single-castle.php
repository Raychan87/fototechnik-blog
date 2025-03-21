<?php
/* Inhalt eines einzelnen Beitrag für Posttype castle */?>
<article <?php post_class();?>>
    <div class="content-post-single-castle">
        <div class="content-single-title-castle">
            <?php /* Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird */?>
            <h1><?php the_title();?></h1>
        </div>
        <div class="content-single-text-castle" ><?php
            /* Der Inhalt des Beitrages */
            the_content(); /* uebergabe Text fuer gekuertze Beitraege */
        ?></div>
    </div>
</article>


