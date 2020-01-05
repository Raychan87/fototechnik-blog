<!-- Wird zur Ausgabe von einzelnen Beiträgen geladen. -->

<!-- Header aufrufen -->
<?php get_header(); ?> 

<!-- Der Loop wird in ein Container gepackt -->
<main class="container-main"> 
    <div class="container-article">
        <!-- Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen -->
        <?php while ( have_posts() ) : the_post(); ?>
                
            <!-- Ruft die Content-single.php Datei auf um die Beiträge bzw Seite aufzurufen -->
            <?php get_template_part('template_parts/content','single');?>

            <div class="content-single-next">
                <!-- Beitrags Navigations (vor und zurück) -->
                <?php previous_post_link(  ); ?>
                <?php next_post_link();?>
            </div>
            
            <!-- Kommentare -->
            <?php comments_template();?>
        <?php endwhile; ?>
    </div>
    <!-- sidebar.php aufrufen -->
    <?php get_sidebar() ;?>
</main>

<!-- Footer aufrufen -->
<?php get_footer(); ?>
