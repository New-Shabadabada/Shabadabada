<?php
namespace Sample;


class Router
{
    public function __construct()
    {

    }

    public function register()
    {
        add_action('init', [$this, 'registerRoutes']);
    }

    public function registerRoutes()
    {

        // https://developer.wordpress.org/reference/functions/add_rewrite_rule/
        // DOC regexp http://www.expreg.com/presentation.php
        add_rewrite_rule(
            'sample/home/?$',   // regexp
            'index.php?custom-route=user-home',  // vers quel "format virtuel" wordpress va transformer l'url demandée
            'top'   // la route se mettra en haut de la pile de priorités des routes enregistrées par wordpress
        );

        // nous demandons à wp de supprimer le cache des routes. Wordpress gère les routes en base de donnée. Attention ici le flush_rewrite_rules est "bourrin" ; il faudrait "casser le cache des routes" L'endoit moment idéal  serait au moment de l'activation du plugin
        flush_rewrite_rules();


        // nous demandons à wordpress d'enregistrer dans les paramètre envoyés, la "fausse variable GET" custom-route
        add_filter('query_vars', function ($query_vars) {
            $query_vars[] = 'custom-route';
            return $query_vars;
        });


        // ce hook permet à wordpress de savoir quel fichier il va utiliser en tant que template
        // le paramètre $template est le template que wordpress compte utiliser
        add_action('template_include', function($template) {

            // récupération de la variable "vituelle get" enregistrée par wordpress
            // DOC https://developer.wordpress.org/reference/functions/get_query_var/
            // équivalent à $_GET['custom-route'];
            $customRouteName = get_query_var('custom-route');


            // si le paramètre $customRouteName vaut test; nous décidons d'afficher le template page-test
            if($customRouteName) {
                return __DIR__ . '/../front-controller.php';
            }

            // sinon ; on affiche le template que wordpress comptait utiliser
            return $template;

        });

    }
}
