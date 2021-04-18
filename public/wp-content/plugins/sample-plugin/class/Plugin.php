<?php

namespace Sample;

class Plugin
{



    public function __construct()
    {

        // flush des routes "une fois" ; méthode propre pour gérer le flush des routes
        /*
        add_filter('init', function() {
            if( !get_option('ocooking-route-flushed')) {
                // flush_rewrite_rules(false);
                // global $wp_rewrite;
                // $wp_rewrite->flush_rules();
                $this->flushRoutes();
                update_option('ocooking-route-flushed', 1);
            }
        }, 10);
        */

        //nous forçons l'ordre d'éxécution des hooks
        add_action('init', [$this, 'createCustomPostTypes'], 50);
        add_action('init', [$this, 'createCustomTaxonomies'], 50);

        $this->registerRouter();
    }


    public function registerRouter()
    {
        $router = new Router();
        $router->register();
    }



    public function createCustomTaxonomies()
    {
        register_taxonomy(
            'ingredient',  //identifiant
            ['sample'],
            [
                'label' => 'Sample taxonomy',
                'public' => true,
                'show_in_rest' => true,
                'hierarchical' => true,
            ]
        );
    }


    public function createUser($login, $password, $email = '')
    {
        // nous n'acceptons pas les mots de passe vides (ou valent "", 0, '0', null, false)
        if(!$password) {
            return false;
        }

        $userId = wp_create_user($login, $password, $email);

        // user bien créé
        if(is_int($userId)) {
            return $userId;
        }
        else {
            //throw new \Exception('User creation failed');
            $error =  $userId;
            return $error;
        }
    }


    public function createCustomPostTypes()
    {
        register_post_type(
            'sample',    // identifiant du cpt
            [
                'label' => 'Sample custom type',
                'public' => true,   // le cpt pourra être édité depuis le bo
                'hierarchical' => false,
                'show_in_rest' =>  true,    // notre cpt sera accessible depuis l'api rest de wp
                'supports' => [
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'author',
                    'comments',
                    // IMPORTANT pour que les custom méta d'un post remontent dans l'api, il faut activer le champs custom-fields
                    'custom-fields',
                ]
            ]
        );

        // DOC options de déclaration d'une custom meta https://developer.wordpress.org/reference/functions/register_meta/
        $options = [
            'type' => 'number',
            'single' => true,
            'show_in_rest' => true
        ];
        // déclarer des custom méta pour un ctp
        register_post_meta('sample', 'sample meta 1', $options);

        $options = [
            'type' => 'string',
            'single' => true,
            'show_in_rest' => true
        ];
        // déclarer des custom méta pour un ctp
        register_post_meta('sample', 'sample meta 2', $options);

        // WARNING attention mauvais pour les performances ; devrait être géré differemment
        $this->flushRoutes();
    }

    public function createCustomRoles()
    {
        add_role('sample-role', 'Sample role');
    }

    public function deleteCustomRoles()
    {
        remove_role('sample-role');
    }



    public function createFakePosts()
    {


        $sourceImageFile = __DIR__ .'/../fixture/post-feature-image.jpg';


        for($i = 0 ; $i < 10 ; $i++ ){
            $title = 'Fake article ' . $i;
            $content = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

            $wordpressData = [
                // optionnel ; prend le user courant
                //'post_author' => get_current_user_id(),
                'post_type' => 'post',
                'post_title' => $title,
                'post_content' => $content,
                'post_status' => 'publish',
            ];

            // DOC créer un post avec wp https://developer.wordpress.org/reference/functions/wp_insert_post/
            $postId = wp_insert_post($wordpressData);

            $this->setFeatureImage($sourceImageFile, $postId);

        }
    }

    public function setFeatureImage($sourceImageFile, $postId)
    {
        $destination = wp_upload_dir();
        // dossier worpdress dans lequel nous allons stocker l'image
        $imageDestinationFoler = $destination['path'];

        if(!is_dir($imageDestinationFoler)) {
            mkdir($imageDestinationFoler, 0775, true);
        }

        $imageDestination = $imageDestinationFoler . '/post-feature-image.jpg';
        copy($sourceImageFile, $imageDestination);

        $wp_filetype = wp_check_filetype( $imageDestination, null );

        $attachment_data = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name( $imageDestination ),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attachId = wp_insert_attachment( $attachment_data, $imageDestination);
        set_post_thumbnail( $postId, $attachId);
    }


    public function flushRoutes()
    {
        global $wp_rewrite;
        $wp_rewrite->flush_rules();
    }

    /**
     * Called during plugin activation
     * @return void
     */
    public function activate()
    {
        $this->createFakePosts();
        $this->createCustomRoles();
        $this->flushRoutes();
    }

    /**
     * Called during plugin deactivation
     * @return void
     */
    public function deactivate()
    {
        $this->deleteCustomRoles();
        $this->flushRoutes();
    }

   
}
