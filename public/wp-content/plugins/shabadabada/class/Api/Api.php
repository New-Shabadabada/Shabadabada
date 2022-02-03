<?php

namespace Shabadabada\Api;

use Shabadabada\Models\Music;
use WP_Query;

class Api
{
    protected $baseURI;

    public function __construct()
    {
        // "/Shabadabada/public"
        $this->baseURI = dirname($_SERVER['SCRIPT_NAME']);

        // registering custom roads for the api
        add_action('rest_api_init', [$this, "registerRoute"]);
    }

    /**
     * Routes definition
     * "/create-game" Record selected songs for a game in the BDD Game table
     * "/save-game" Record playlist with users responses
     * @return void
     */
    public function registerRoute()
    {
        //
        register_rest_route(
            'shabadabada/v1',
            '/create-game',
            [
                'methods' => 'GET',
                'callback' => [$this, 'createGame'],
            ]
        );

        register_rest_route(
            'shabadabada/v1',
            '/save-game',
            [
                'methods' => 'POST',
                'callback' => [$this, 'saveGame']
            ]
        );
    }


    /**
     * Create new Game in db
     * @return array of game (with custom_id and playlist)
     */
    public function createGame()
    {
        // IMPORTANT retrieve category's id or category's slug
        // useful for future uses of other Deezer Api endpoints
        $category = filter_input(\INPUT_GET, 'category');

        $musics = new Music();

        // (int) $category try to convert $category into an integer. If $category is a string, this cannot be converted into integer. So the test will fail and category slug will be use
        if((int) $category) {
            $playlist = $musics->get_musics_from_category($category, 'term_id');
        }
        else {
            $playlist = $musics->get_musics_from_category($category);
        }

        global $wpdb;

        // Create unique id for each game, for more security
        $customId = uniqid('shabada-', true);

        $wpdb->insert('wp_game', [
            'custom_id' => $customId,
            'game_data' => json_encode($playlist, JSON_PRETTY_PRINT),
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        // DOC - last insert_id - https://www.php.net/manual/fr/mysqli.insert-id.php
        $lastid = $wpdb->insert_id;

        return [
            'gameId' => $lastid,
            'custom_id' => $customId,
            'musics' => $playlist
            //'jsonVersion' => 1, //! for future evolution (game, music culture, classification)
        ] ;
    }

    /**
     * Register game with responses user in db
     * @return array with datas game
     */
    public function saveGame()
    {
        // Define bellow
        $data = $this->getPostData();

        global $wpdb;
        $wpdb->update('wp_game',
            [
                'game_response' => json_encode($data, JSON_PRETTY_PRINT)
            ],
            [
            'custom_id' => $data['custom_id']
            ]
        );

        return $data;
    }

    /**
     * Retrieve JSON data of the game and decode this in
     * @return array $data or $_POST
     */
    public function getPostData()
    {
        // Retrieving JSON data sent to POST
        // DOC - file-get-contents - https://www.php.net/manual/fr/function.file-get-contents.php
        // DOC - wrapper PHP 'php://input' - https://www.php.net/manual/en/wrappers.php.php
        $json = file_get_contents('php://input');

        if($json) {
            // decodes JSON in PHP table
            // DOC: - json_encode - PHP https://www.php.net/json_decode
            $data = json_decode($json, true);

            return $data;
        }
        else {
            return $_POST;
        }
    }

    /**
     * Method called when plugin is activate
     */
    public function activate(){}
    public function deactivate(){}

}
