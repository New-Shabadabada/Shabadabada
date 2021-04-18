<?php

define('DEFAULT_HEADER_IMAGE', 'https://cluster-meca.fr/img/articles_a/1578479779.p19745084d3692169g.jpg');

// enregister une fonction sur le hook "customize_register"
add_action( 'customize_register', 'customizer_header_image' );




// cette fonction nous permet de déclarer/configurer nos customizers
function customizer_header_image($wordpressTheme)
{

    // enregistrement d'une section de la rubrique "Customize" (dans le backoffice)
    $wordpressTheme->add_section(
        'custom-images',    // nous donnons un idenfiant à notre section
        array(  // tableau d'options
            'title'      => __('Custom images'),    // libellé  de la section
            'priority'   => 30,
        )
    );

    // déclaration d'une variable propre à notre thème (variable qui sera gérée via le backoffice)
    $wordpressTheme->add_setting(
        'header-image', // "nom/identifiant" de la variable
        array(  // tableau d'options
            'default'     => DEFAULT_HEADER_IMAGE, // valeur par défaut de notre variable
            'transport'   => 'postMessage',
            // transport ; stratégie d'affichage en "live" des modifications faites sur le thème lorsque la variable change
            // refresh : reload de la page
            // postMessage : utilisation de javascript
        )
    );

    // association d'un composant (ux) pour modifier la valeur d'une variable gérée via customizer
    $wordpressTheme->add_control(
        new WP_Customize_Image_Control( // composant (ux) pour choisir une image
            $wordpressTheme,    // premier argument : l'objet Theme
            'header-image-control',    // identifiant du composant
            array(  // tableau d'options
                'label'      => 'Header image', // libéllé dans le backoffice
                'section'    => 'custom-images',    // identifiant de la section dans laquelle doit s'afficher le composant
                'settings'   => 'header-image',  // quelle variable du thème est gérée par le composant
            )
        )
    );


    // ajout du petit crayon pour afficher le bon customizer
    $wordpressTheme->selective_refresh->add_partial(
        'header-image', [
            'selector' => '.customizer',    // selecteur pour cibler là où le crayon sera affiché
            'container_inclusive' => true,
            'fallback_refresh' => false,  // Prevents refresh loop when document does not contain selector
            /*
            'render_callback' => function() {
                return '
                :root {
                    --color-highlight-00: ' . get_theme_mod(static::MOD_NAME) . ';
                }
                ';
            }
            */
        ]
    );
}
