<?php

namespace Shabadabada\Api;

// APO TODO
class DeezerApo
{
    /**
     * Importation method of data deezer Api
     *
     * @return void
     */
    public function import()
    {
        require __DIR__ . '../../data/dataApo.php'; //debug OK (in home page of sample theme !)

        /* create loop for iterate data array
        index of data array = category type
        $musicData = asso array where $index = artist and $value = track
        */
        foreach($dataApo as $category => $musicData){

            //insert categories in data base and in custom taxonoy "type"
            $typeId = term_exists($category, 'music-type');

            if (!$typeId) {
                $typeId = wp_insert_term($category, 'music-type');
            }

            // Loop for iterate $musicData array
            foreach($musicData as $artist => $track){


                $url = 'https://api.deezer.com/search?q=artist:"' . $artist . '"track:"' . $track . '"';

                $this->insertBoWp($url, $category);
                $this->breakPoint();

                echo $url . "<br>"; //ok

            } // end foreach of $musicData array

        } // en foreach of $data array

    }


    /**
     * Insertion method in wordpress back office 
    *
    * @param [type] $url
    * @return void
    */
    public function insertBoWp($url, $category = '')
    {
        // test zone //
        //$url = 'https://api.deezer.com/search?q=artist:"eminem"';
        //test zone //

        // DOC https://www.php.net/manual/fr/function.file-get-contents.php
        // $endContent contains the response of api deezer
        $endpointContent = file_get_contents($url);

        // DOC https://www.php.net/manual/fr/function.json-decode.php
        // $responseEndpoint contains json response convert in php object
        $responseEndpoint = json_decode($endpointContent, true);

        $musicData = $responseEndpoint['data'][0];
        echo '<div style="border: solid 2px #F00">';
            echo '<div style="; background-color:#CCC">@'.__FILE__.' : '.__LINE__.'</div>';
            echo '<pre style="background-color: rgba(255,255,255, 0.8);">';
                print_r($musicData);
            echo '</pre>';
        echo '</div>';

        //define postId with wp_insert_post()
        $postId = wp_insert_post([
            'post_type' => 'music',
            'post_status' => 'publish',
            'post_title' => $musicData['title'],
        ]);

        //update custom metadata at the post
        update_post_meta($postId, 'music-title', $musicData['title_short']);
        update_post_meta($postId, 'artist', $musicData['artist']['name']);
        update_post_meta($postId, 'sound-excerpt', $musicData['preview']);
        update_post_meta($postId, 'album-name', $musicData['album']['title']);
        update_post_meta($postId, 'album-thumbnail', $musicData['album']['cover_medium']);

        //insert term in post music
        wp_set_post_terms($postId, $category, 'music-type');

    }


    /**
     * Method which create break point between every turn of loops
     *
     * @return void
     */
    public function breakPoint()
    {
        // DOC https://www.php.net/manual/fr/function.ob-flush.php
        ob_flush();
        // DOC https://www.php.net/manual/fr/function.flush.php
        flush();
        // DOC https://www.php.net/manual/fr/function.sleep.php
        // Stop the execution during 1 second
        sleep(1);
    }
}
