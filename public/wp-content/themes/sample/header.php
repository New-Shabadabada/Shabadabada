<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    wp_head();
    ?>

    <style>
        .customizer.header {
            color: <?=get_theme_mod('header-color', DEFAULT_HEADER_COLOR);?>;
        }
    </style>

    <link rel="stylesheet" href="<?=get_theme_file_uri('test.css');?>"/>


</head>