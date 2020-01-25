<?php
/**
 *  The header for our theme
 */
?><!DOCTYPE html>
<html lang="<?php bloginfo('language');?>">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <?php /* Browser Titel Namen */ ?>
    <title><?php wp_title('->');?> <?php bloginfo( 'name' ); ?></title> 
    <?php /* Lädt Wordpress eigene Scripte, CSS Code für Emoji, Metainformationen und Adminbar (wp_footer() wird benötigt) */?>
    <?php wp_head(); ?>
</head>
<body <?php body_class();?>>
<div class="container-website"> <?php /* der Container geht bis footer.php */?>
    <header class="container-header" style="background-image: url(<?php esc_url( header_image() ); ?>)">
        <div class="header-title">
            <?php /* Namen der Webseite aufrufen */?>
            <h1><?php //bloginfo( 'name' ); ?></a></h1>
        </div>
        <div class="header-description">
            <?php /* Untertitel bzw. Beschreibung der Webseite */?>
            <p><?php //bloginfo( 'description' ); ?></a></p> -->
        </div>
    </header>
    <?php /* Navigations Bar wird aufgerufen */
    get_template_part('template_parts/navbar_main'); ?>
