<!-- header.php aufrufen -->
<?php get_header(); ?> 

<!-- Der Loop wird in ein Container gepackt -->
<main class="container-main"> 
    <div class="container-article">
   
   <!-- Schlagwort als Überschrift und Beschreibung -->
   <h1><?php single_tag_title();?></h1>
   <?php echo tag_description();?>
   
        <!-- Der Loop läuft nur die Anzahl der angegeben Beiträge in den Einstellungen -->
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                
                <!-- Ruft die Content.php Datei auf um die Beiträge bzw Seite aufzurufen -->
                <?php get_template_part('template_parts/content');?>
            
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

<!-- footer.php aufrufen -->
<?php get_footer(); ?>
