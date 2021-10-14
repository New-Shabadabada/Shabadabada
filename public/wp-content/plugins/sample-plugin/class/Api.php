<?php

namespace Sample;

use WP_Post;
use WP_Query;

class Api
{
    protected $baseURI;

    public function __construct()
    {
        // calcul "automatique" du base uri du site
        $this->baseURI = dirname($_SERVER['SCRIPT_NAME']);
        $this->whiteList();

        // enregistrement des routes custom pour l'api
        //add_action('rest_api_init', [$this, "registerRoute"]);
    }

    public function registerRoute()
    {
        // arguments:
        // - le namespace de l'api
        // - le chemin
        // - définition du endpoint (= action à réaliser lorsqu'une route est apellée)
        register_rest_route(
            'sample-plugin/v1',
            '/signup',
            [
                'methods' => 'POST',
                'callback' => [$this, 'signup']
            ]
        );

        register_rest_route(
            'sample-plugin/v1',
            '/version',
            [
                'methods' => 'GET',
                'callback' => [$this, 'version']
            ]
        );

        register_rest_route(
            'sample-plugin/v1',
            '/get-recipes-by-taxonomies',
            [
                'methods' => 'GET',
                'callback' => [$this, 'getRecipesByTaxonomies']
            ]
        );

        register_rest_route(
            'sample-plugin/v1',
            '/recipe-create',
            [
                'methods' => 'POST',
                'callback' => [$this, 'recipeCreate']
            ]
        );

        register_rest_route(
            'sample-plugin/v1',
            '/upload-image',
            [
                'methods' => 'POST',
                'callback' => [$this, 'uploadImage']
            ]
        );

        register_rest_route(
            'sample-plugin/v1',
            '/get-recipes-by-difficulty',
            [
                'methods' => 'GET',
                'callback' => [$this, 'getRecipesByDifficulty']
            ]
        );


        register_rest_route(
            'sample-plugin/v1',
            '/demo-custom-table',
            [
                'methods' => 'GET',
                'callback' => [$this, 'demoCustomTable']
            ]
        );

        register_rest_route(
            'sample-plugin/v1',
            '/save-data',
            [
                'methods' => 'POST',
                'callback' => [$this, 'saveData']
            ]
        );
    }

    public function demoCustomTable()
    {
        $query = new \WP_Query([
            
            'post_type' => 'sample',
            
            
        ]);

        $musics = $query->get_posts();
        shuffle($musics);

        $playlist = array_slice($musics, 0, 9);

        global $wpdb;
        $customId = uniqid('shabada-', true);
        $wpdb->insert('demo_custom', [
            'game_data' => json_encode($playlist, JSON_PRETTY_PRINT),
            'created_at' => date('Y-m-d H:i:s'),
            'custom_id' => $customId
        ]);
        $lastid = $wpdb->insert_id;

        return [
            'gameId' => $lastid, //! à voir suppression vu qu'il a maintenant le customId
            'custom_id' => $customId,
            'jsonVersion' => 1, //! nouveau champ pour futur lointain
            'musics' => $playlist
        ];
    }

    public function saveData()
    {


        // echo pow(16, 32);
        // 340 282 366 920 940 000 000 000 000 000 000 000 000
        // echo __FILE__.':'.__LINE__; exit();

        $data = $this->getPostData();

        global $wpdb;
        $wpdb->update('demo_custom', [
            'game_response' => json_encode($data, JSON_PRETTY_PRINT)
        ], [
            'custom_id' => $data['custom_id']
        ]
        );
        return $data;
    }



    public function uploadImage()
    {
        // header("Access-Control-Allow-Origin: *");
        // header("Content*-type: text/html");

        $imageFileIndex = 'image';

        // récupération des informations concernant l'image uploadée
        $imageData = $_FILES[$imageFileIndex];

        // récupération du chemin fichier dans lequel est stocké l'image qui vient d'être uploadée
        $imageSource = $imageData['tmp_name'];

        // récupération es informations du dossier dans lequel wp stocke les fichiers uploadés
        $destination = wp_upload_dir();

        // dossier worpdress dans lequel nous allons stocker l'image
        $imageDestinationFoler = $destination['path'];

        // DOC nettoyage d'un nom de fichier avec wp https://developer.wordpress.org/reference/functions/sanitize_file_name/
        $imageName =  sanitize_file_name(
            md5(uniqid()) . '-' . // génération d'une partie aléatoire pour ne pas écraser de fichier existant
            $imageData['name']);
        $imageDestination = $imageDestinationFoler . '/' . $imageName;

        // on déplace le fichier uploadé dans le dossier de stokage de wp
        $success = move_uploaded_file($imageSource, $imageDestination);

        // si le déplacement du fichier à bien fonctionné
        if($success) {
            // récupération des informations dont wordpress a besoin pour identifier le type de fichier uploadé
            $imageType =  wp_check_filetype( $imageDestination, null);

            // préparation des informations nécessaires pour créer le media
            $attachment = array(
                'post_mime_type' => $imageType['type'],
                'post_title' => $imageName,
                'post_content' => '',
                'post_status' => 'inherit'
            );

            // on enregistre l'image dans wordpress
            $attachmentId = wp_insert_attachment( $attachment, $imageDestination );

            if(is_int($attachmentId)) {
                // youpi merci wordpress...
                require_once( ABSPATH . 'wp-admin/includes/image.php' );

                // DOC on génère les metadatas pour le média https://developer.wordpress.org/reference/functions/wp_generate_attachment_metadata/
                $metadata = wp_generate_attachment_metadata( $attachmentId, $imageDestination );

                // on met à jour les metadata du media
                wp_update_attachment_metadata( $attachmentId, $metadata );

                return [
                    'status' => 'success',
                    'image' => [
                        'url' => $destination['url'] . '/' . $imageName,
                        'id' => $attachmentId
                    ]
                ];
            }
            else {
                return [
                    'status' => 'failed'
                ];
            }
        }

        return [
            'status' => 'failed'
        ];
    }

    public function recipeCreate()
    {
        $data = $this->getPostData();

        $wordpressData = [
            // optionnel ; prend le user courant
            //'post_author' => get_current_user_id(),
            'post_type' => 'recipe',
            'post_title' => $data['title'],
            'post_content' => $data['content'],
            'post_status' => 'publish',
        ];

        // DOC créer un post avec wp https://developer.wordpress.org/reference/functions/wp_insert_post/
        $postId = wp_insert_post($wordpressData);

        if(is_int($postId)) {
            // engistrement de la durée de préparation dans une custom meta
            add_post_meta($postId, 'duration', $data['duration']);
            add_post_meta($postId, 'difficulty', $data['difficulty']);

            // And finally assign featured image to post
            if($data['imageId']) {
                set_post_thumbnail( $postId, $data['imageId']);
            }
        }
        $post = get_post($postId);
        return $post;
    }


    public function getRecipesByDifficulty()
    {
        $difficulty = filter_input(INPUT_GET, 'difficulty');
        $difficulty = (int) $difficulty;

        // DOC custom query https://developer.wordpress.org/reference/classes/wp_query/
        $query = new WP_Query([
            'post_type' => 'recipe',
            'meta_key' => 'difficulty',
            'meta_value' => $difficulty
        ]);

        $responseData = [];
        $posts = $query->get_posts();

        foreach($posts as $post) {
            $author =  get_user_by('ID', $post->post_author);
            $featuredImage = get_the_post_thumbnail_url($post->ID, 'full');

            $responseData[] = [
                'post' => $post,
                'author' => $author,
                'featuredImage' => $featuredImage,
            ];
        }

        return $responseData;
    }




    public function getRecipesByTaxonomies()
    {

        $taxonomies = $_GET['taxonomies'];

        // DOC custom query https://developer.wordpress.org/reference/classes/wp_query/
        $query = new WP_Query([
            'post_type' => 'recipe',

            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'ingredient',
                    'field'    => 'term_id',
                    'terms'    => $taxonomies,
                ),
                array(
                    'taxonomy' => 'recipe-type',
                    'field'    => 'term_id',
                    'terms'    => $taxonomies,
                ),
            ),
        ]);

        $posts = $query->get_posts();
        return $posts;
    }

    public function version()
    {
        return  [
            'version' => 1,
            'description' => "Sample plugin",
            'server' => $_SERVER
        ];
    }

    public function whiteList()
    {
        // il faut autoriser la route pour s'inscrire !
        add_filter( 'jwt_auth_whitelist', function ($endpoints) {
            return [
                $this->baseURI . '/wp-json/sample-plugin/v1/signup',
                $this->baseURI . '/wp-json/sample-plugin/v1/version',
                $this->baseURI . '/wp-json/sample-plugin/v1/get-recipes-by-taxonomies',
                $this->baseURI . '/wp-json/sample-plugin/v1/get-recipes-by-difficulty',
                $this->baseURI . '/wp-json/sample-plugin/v1/demo-custom-table',
            ];
        });
    }


    public function signup()
    {

        $data = $this->getPostData();
        $errors = [];

        // controle de la validité des données envoyées
        $username = $data['username'];
        if(!$username) {
            $errors['username'] = ['Username is mandatory'];
        }

        $password = $data['password'];
        if(!$password) {
            $errors['password'] = ['Password is mandatory'];
        }

        $email = $data['email'];
        if(!$email) {
            $errors['email'] = ['Email is mandatory'];
        }


        // si pas d'erreur ; on tente de créer un nouveau user
        if(empty($errors)) {
            // DOC création d'un utilisateur https://developer.wordpress.org/reference/functions/wp_create_user/
            $success = wp_create_user($username, $password, $email);

            // si pas d'erreur de création du coté wp, on retourne l'id du user
            if(is_int($success)) {
                return [
                    'status' => 'success',
                    'data' => [
                        'userId' => $success,
                        'username' => $username,
                        'email' => $email,
                    ]
                ];
            }
            // sinon on retourne les erreurs de wp
            else {
                return [
                    'status' => 'failed',
                    'errors' => $success->errors
                ];
            }
        }
        // on retoure les erreurs
        else {
            return [
                'status' => 'failed',
                'errors' => $errors
            ];
        }
    }

    public function getPostData()
    {
        // récupération des données JSON envoyées en POST
        $json = file_get_contents('php://input');

        if($json) {
            // nous décodons le json en un tableau PHP classqque
            // DOC décoder du json en PHP https://www.php.net/json_decode
            $data = json_decode($json, true);
            // nous retournons le tableau
            return $data;
        }
        else {
            return $_POST;
        }
    }

    public function activate()
    {
        // rien de particulier à l'activation du plugin
    }

    public function deactivate()
    {
        // rien de particulier à la désactivation du plugin
    }

}
