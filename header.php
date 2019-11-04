<!DOCTYPE html>
<!-- Auslesen der Systemsprache -->
<html lang="<?php bloginfo('language');?>">
<head>
    <!-- Der Zeichensatz wird Automatisch ausgewiesen (Standard UTF-8) -->
    <meta charset"<?php bloginfo('charset'); ?>">
    <!-- Der Meta viewport soll immer so groß sein wie das Gerät -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 

    <!-- Browser Titel Namen -->
    <title><?php wp_title('->');?> <?php bloginfo( 'name' ); ?></title> 
    
    <!-- CSS Code laden -->
        <!-- Öffnet Style.css -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">  
        <!-- "normalize" für Browser kompatibilität --> 
    <link rel="skylesheet" href="<?php bloginfo('template_url');?>assets/css/normalize.css">
    
    <!-- Scripte laden -->
        <!-- Um auf Kommentare zu antworten -->
    <?php wp_enqueue_script('comment-replay');?>

    <!-- Lädt Wordpress eigene Scripte, CSS Code für Emoji, Metainformationen und Adminbar (wp_footer() wird benötigt) -->
    <?php wp_head(); ?>
</head>
<!-- ??? -->
<body <?php body_class();?>>
<div class="container_website"> <!-- der Container "container_website" geht bis footer.php -->
    <header class="container_header">
        <!-- Headerbild wird eingefügt -->
        <img src="<?php header_image(); ?>"height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
        <!-- Namen der Webseite aufrufen -->
        <!-- <h1><?php bloginfo( 'name' ); ?></a></h1> -->
        <!-- Untertitel bzw. Beschreibung der Webseite -->
        <!-- <p><?php bloginfo( 'description' ); ?></a></p> -->
    </header>
    <!-- Navigations Bar wird aufgerufen -->
    <?php get_template_part('template_parts/navbar_main');?>
