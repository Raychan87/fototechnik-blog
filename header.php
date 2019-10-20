<html>
    <head>
        <meta charset"UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Der Meta viewport soll immer so groß sein wie das Gerät -->

        <title> Hallo </title>

        <!-- CSS Code laden -->
        <link rel="skylesheet" href="<?php bloginfo('template_url');?>/css/normalize.css">
        <link rel="skylesheet" href="#">

        <?php 
        wp_head(); //-> Wordpress passt den Header an und lädt alle registrierten Dateien (z.B. Style.css)
        ?>


        <nav class="main-menu-class">
                <?php 
                /*
                <------ Menü anzeigen ------>
                */
                wp_nav_menu(
                    array(
                        'theme_location'    => 'main_menu',         //-> id des aufzurufendes Menüs
                        'menu_class'        => 'nav navbar-nav',    //-> ein Klassen Name wird hinzugefügt
                        'depth'             => 5,                   //-> gibt die Tiefe des Menüs an
                        'container'         => ''                   //-> Um den "div" zu entfernen
                    )
                )
                /*
                <------ Ende Menü ------>
                */
                ?>
        </nav>



    </head>
<body>
