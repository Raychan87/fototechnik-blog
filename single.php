<!-- Wird zur Ausgabe von einzelnen Beiträgen geladen. -->

<!-- Header aufrufen -->
<?php get_header(); ?> 

<!-- Der Loop wird in ein Container gepackt -->
<main class="container_main"> 
    <div class="container_article">
        <!-- Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                <!-- Beitragsbild aufrufen -->
                <?php the_post_thumbnail('post-thumbnail'); ?>
        
                <!-- Ruft die Content-single.php Datei auf um die Beiträge bzw Seite aufzurufen -->
                <?php get_template_part('template_parts/content','single');?>
            
                <!-- Kommentare -->
                <?php comments_template();?>
        
                <!-- Beitrag kürzen -->
                <?php wp_link_pages() ?>

            <?php endwhile; else : ?>
                
                <!-- Fehlermeldung, es konnten keine Beiträge gefunden werden -->
                <?php get_template_part('template_parts/content','error');?>

        <?php endif; ?>

        <!-- Beitrags Navigations (vor und zurück) -->
        <?php previous_posts_link();?>
        <?php next_posts_link();?>
    </div>
    <!-- sidebar.php aufrufen -->
    <?php get_sidebar() ;?>
</main>

<!-- Footer aufrufen -->
<?php get_footer(); ?>
