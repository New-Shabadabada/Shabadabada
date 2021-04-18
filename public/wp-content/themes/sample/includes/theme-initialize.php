<?php
if (!function_exists('sample_initialize')) {
    function sample_initialize()
    {
        // configuration des fonctionnalités de notre thème
        add_theme_support('post-thumbnails');   // activation de l'image de mise en avant sur les articles
        add_theme_support('title-tag');
        add_theme_support('custom-logo');
    }
}


// on enregistre un hook pour activer les fonctionnalités gérées par notre thème
add_action('after_setup_theme', 'sample_initialize');