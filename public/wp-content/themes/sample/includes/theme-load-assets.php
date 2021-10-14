<?php

function sample_load_assets()
{
    // nous disons à wp de charger le fichier assets/dist/main.css
    // get_theme_file_uri permet de récupérer l'url racine de notre thème

    // WARNING faire très attention à ne pas mettre plusieurs fois le même nom à différents assets

    wp_enqueue_style(
        'google-font',  // "nom du fichier css
        'https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900', // chemin fichier pour dire à quel endroit est stocké le fichier
    );

    /*
    wp_enqueue_style(
        'vuetify-font',  // "nom du fichier css
        'https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css', // chemin fichier pour dire à quel endroit est stocké le fichier
    );
    */



    wp_enqueue_style(
        'main-css',  // "nom du fichier css
        get_theme_file_uri('assets/dist/main.css'), // chemin fichier pour dire à quel endroit est stocké le fichier
    );


    // DOC ajouter un javascript dans un thème  https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script(
        'main-js',
        get_theme_file_uri('assets/dist/main.js'),
        [],     // pas de dépendances
        false,  // pas de numéro de version forcé
        true    //dans le footer
    );

    wp_enqueue_script(
        'customizer-js',  // "nom du fichier js
        get_theme_file_uri('assets/javascript/wp-customizer.js'),
    );

}


add_action('wp_enqueue_scripts', 'sample_load_assets');