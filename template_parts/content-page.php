<!-- Inhalt einer Statischen Seite -->
<article <?php post_class();?>>
    <div class="page-post">
        <div class="page-title">
            <!-- Überschrift der Seite -->
            <h1><?php the_title();?></h1>
        </div>
        <div class="page-text">
            <!-- Inhalt der Seite -->
            <?php the_content();?>
        </div>
        <?php if ( get_edit_post_link()){?>
            <div class="page-edit">
                <!-- Bearbeitungs Button für den Admin -->
                <?php edit_post_link(); ?>
            </div>
        <?php } ?>
    </div>
</article>
