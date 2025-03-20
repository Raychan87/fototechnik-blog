<?php
/* Inhalt eines einzelnen Beitrag für Posttype castle */?>
<article <?php post_class();?>>
    <div class="content-post-castle">
        <div class="content-single-title">
            <?php /* Wenn eine Kategorie oder Schlagwort Seite aufgerufen wird */?>
            <h1>castle "<?php the_title();?>"</h1>

        </div>
        <div class="content-single-text" ><?php
            /* Der Inhalt des Beitrages */
            the_content(); /* uebergabe Text fuer gekuertze Beitraege */
        ?></div>
    </div>
</article>


