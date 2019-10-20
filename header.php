<!DOCTYPE html>
<html>
<head>

    <meta charset"UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Der Meta viewport soll immer so groß sein wie das Gerät -->

    <!-- Browser Titel Namen -->
    <title><?php wp_title('->');?> <?php bloginfo( 'name' ); ?></title> 
    

    <!-- CSS Code laden -->
        <!-- Öffnent Style.css -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">  
        <!-- "normalize" für Browser kompatibilität --> 
    <link rel="skylesheet" href="<?php bloginfo('template_url');?>/css/normalize.css">
    <link rel="skylesheet" href="#">

    <?php 
        wp_head(); //-> Lädt Wordpress eigene Scripte, CSS Code für Emoji und Meta Informationen (Auch die Adminbar und wp_footer() wird benötigt)
    ?>
</head>
<body <?php body_class();?>>
    <header>
        <!-- Namen der Webseite aufrufen -->
        <h1><?php bloginfo( 'name' ); ?></a></h1>
        <!-- Untertitel bzw. Beschreibung der Webseite -->
        <p><?php bloginfo( 'description' ); ?></a></p>
        
        <?php get_template_part('template_parts/navi');?>
    </header>
