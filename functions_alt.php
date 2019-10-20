<?php

/*
<------ Start Styles laden ------>
*/
add_action(                     //-> ('Moment wann Aktiv', 'Funktionsname)
    'wp_enqueue_scripts',       //-> Wird immer geladen wenn Wordpress Skripte lädt 
    'register_meintheme_styles' //-> Name der Funktion
);
function register_meintheme_styles() {

    wp_enqueue_style(        //-> Meldet eine neue Stylesheet Datei an
        'themestyle',        //-> Der Name den die Stylesheet datei bekommt (id)
        get_stylesheet_uri() //-> nimmt die Style.css von der URL 
    );
}
/*
<------ Ende Styles laden ------>
*/
/*
<------ Start Menü ------>
*/
add_action( 
    'after_setup_theme',            //-> Regestriert die Menü Funktion
    'register_fototechnikblog_menu' //-> Name der Funktion
);
function register_fototechnikblog_menu() {
    register_nav_menu ( 
        'main_menu',            //-> id 
        'Hautmenü'              //-> Anzeigetext im Wordpress
    );
    register_nav_menu ( 
        'foot_menu',            //-> id  
        'Fußmenü'                //-> Anzeigetext im Wordpress
    );
}
/*
<------ Ende Menü ------>
*/



/*
<------ Libs einbinden ------>
*/









?>