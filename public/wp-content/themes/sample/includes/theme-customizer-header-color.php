<?php

define('DEFAULT_HEADER_COLOR', '#000');

// enregister une fonction sur le hook "customize_register"
add_action( 'customize_register', 'customizer_header_color' );

add_action( 'customize_preview_init', 'customizer_load_css');
function customizer_load_css()
{
    wp_enqueue_style(
        'customizer',  // "nom du fichier css
        get_theme_file_uri('assets/css/customizer.css'), // chemin fichier pour dire à quel endroit est stocké le fichier
    );
}


// cette fonction nous permet de déclarer/configurer nos customizers
function customizer_header_color($wordpressTheme)
{

    // enregistrement d'une section de la rubrique "Customize" (dans le backoffice)
    $wordpressTheme->add_section(
        'header-color',    // nous donnons un idenfiant à notre section
        array(  // tableau d'options
            'title'      => __('Header text color'),    // libellé  de la section
            'priority'   => 30,
        )
    );

    // déclaration d'une variable propre à notre thème (variable qui sera gérée via le backoffice)
    $wordpressTheme->add_setting(
        'header-color', // "nom/identifiant" de la variable
        array(  // tableau d'options
            'default'     => DEFAULT_HEADER_COLOR, // valeur par défaut de notre variable
            'transport'   => 'postMessage',
            // transport ; stratégie d'affichage en "live" des modifications faites sur le thème lorsque la variable change
            // refresh : reload de la page
            // postMessage : utilisation de javascript
        )
    );

    // association d'un composant (ux) pour modifier la valeur d'une variable gérée via customizer
    $wordpressTheme->add_control(
        new WP_Customize_Color_Control( // composant (ux) pour choisir une image
            $wordpressTheme,    // premier argument : l'objet Theme
            'header-color-control',    // identifiant du composant
            array(  // tableau d'options
                'label'      => 'Header text color', // libéllé dans le backoffice
                'section'    => 'header-color',    // identifiant de la section dans laquelle doit s'afficher le composant
                'settings'   => 'header-color',  // quelle variable du thème est gérée par le composant
            )
        )
    );


    // ajout du petit crayon pour afficher le bon customizer
    $wordpressTheme->selective_refresh->add_partial(
        'header-color', [
            'selector' => 'header.customizer h2',    // selecteur pour cibler là où le crayon sera affiché
            'container_inclusive' => true,
            'fallback_refresh' => false,  // Prevents refresh loop when document does not contain selector
            'render_callback' => function() {
                echo __FILE__.':'.__LINE__; exit();
                echo  '
                <style>
                    header.customizer h2 {
                        margin-left: 120px;
                    }
                </style>
                ';
            }
        ]
    );
}
