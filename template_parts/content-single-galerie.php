<?php
/* Inhalt eines einzelnen Beitrag für Posttype Galerie */?>
<article <?php post_class();?>>
    <div class="content-post-galerie">
        <div class="content-single-title">
            <?php /* Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird */?>
            <h1>Galerie "<?php the_title();?>"</h1>
        </div>
        <div class="content-single-text" ><?php
            /* Der Inhalt des Beitrages */
            the_content(); /* uebergabe Text fuer gekuertze Beitraege */
        ?></div>
    </div>
</article>


