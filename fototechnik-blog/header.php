<html>
<head>
<title> Hallo </title>


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
