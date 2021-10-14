<?php

namespace Shabadabada;

use Shabadabada\Models\Music;
use WP_Query;

class Api
{
    protected $baseURI;
    public function __construct()
    {
        // registering custom roads for the api
        add_action('rest_api_init', [$this, "registerRoute"]);
    }


  
    public function registerRoute()
    {
       
        register_rest_route(
            'shabadabada/v1',// Record selected songs for a game in the BDD Game table
            '/create-game',
            [
                'methods' => 'GET', 
                'callback' => [$this, 'createGame'],
            ]
        );

        register_rest_route(
            'shabadabada/v1', // Database record of the validity of the answers given
            '/save-game',
            [
                'methods' => 'POST',
                'callback' => [$this, 'saveGame']
            ]
        );
    }

    
    public function createGame() 
    {
        // IMPORTANT retrieve category's id or category's slug
        $category = filter_input(\INPUT_GET, 'category');

       
        $musics = new Music();

        // NOTE (int) $category try to convert $category into an integer. If $category is a string (like "toto", or something else) ; this cannot be converted into integer. So the test will fail
        if((int) $category) {
            $playlist = $musics->get_musics_from_category($category, 'term_id');
        }
        else {
            $playlist = $musics->get_musics_from_category($category);
        }
        

        global $wpdb;

        $customId = uniqid('shabada-', true);

        $wpdb->insert('wp_game', [
            'custom_id' => $customId,
            'game_data' => json_encode($playlist, JSON_PRETTY_PRINT),
            'created_at' => date('Y-m-d H:i:s'),
            
        ]);

        $lastid = $wpdb->insert_id;

        return [
            'gameId' => $lastid,
            'custom_id' => $customId,
            'musics' => $playlist
            //'jsonVersion' => 1, //! nouveau champ pour futur lointain
        ] ;
    }

    public function saveGame() 
    {
        $data = $this->getPostData();
        global $wpdb;
        $wpdb->update('wp_game', [
            'game_response' => json_encode($data, JSON_PRETTY_PRINT)
        ], [
            'custom_id' => $data['custom_id']
        ]
        );
        return $data;
    }

    
    //------------------------data recovery function---------------------------------
    public function getPostData()
    {
        // Retrieving JSON data sent to POST
        $json = file_get_contents('php://input');

        //var_dump($json);

        if($json) {
            // decodes JSON in PHP table
            // DOC: PHP https://www.php.net/json_decode
            $data = json_decode($json, true);
            return $data;
        }
        else {
            return $_POST;
        }
    }


    
    //------------------------Action to activate and disable the plugin---------------------------------
    public function activate()
    {
        // Action to activate the plugin
    }

    public function deactivate()
    {
        // Action to deactivate the plugin
    }

}
