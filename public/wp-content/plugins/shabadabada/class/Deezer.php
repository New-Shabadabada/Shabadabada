<?php

namespace Shabadabada;


class Deezer
{
    /**
     * Importation method of data deezer Api
     *
     * @return void
     */
    public function import()
    { 
        require __DIR__ . '../../data/data.php'; //debug OK (in home page of sample theme !)


        /* create loop for iterate data array
        index of data array = category type
        $musicData = 
            simple array where $index = int and $value = artist 
            or 
            asso array where $index = artist and $value = album
        */
        foreach($data as $category => $musicData){

            // insert categories in data base and in custom taxonoy "type"
            $typeId = term_exists($category, 'music-type');

            if (!$typeId) {
                $typeId = wp_insert_term($category, 'music-type');
            }
            
            
            // Loop for iterate $musicData array
            foreach($musicData as $index => $value){
                
                // if $index of $musicData array = int, 
                if(is_int($index)){

                    // so $value is definite like the $artist
                    $artist = $value;

                    // in this case, the deezer endpoint is : 
                    $url = 'https://api.deezer.com/search?q="' . $artist . '"';

                    //echo $url . "<br>"; // test
                    $this->insertBoWp($url, $category); 
                    $this->breakPoint();
                
                }
                // if $index of $musicData Array is a string
                else {
                    // so $index of $musicData is definite like the $artist
                    $artist = $index;

                    // if $value of $musicData array is an array, so several albums are associated at an same artist
                    if(is_array($value)){
                       
                        // iterate of the $value array to access the different album titles 
                        foreach($value as $album){

                            // in this case the deezer endpoint is : 
                            $url = 'https://api.deezer.com/search?q=artist:"' . $artist . '"album:"' . $album . '"';
                            
                            $this->insertBoWp($url, $category); 
                            $this->breakPoint();
                        }
                    }
                    else {
                       // if $value of $musicData array is not an array, so $value is definite like $album
                    $album = $value;

                    // in this case, the deezer endpoint is : 
                    $url = 'https://api.deezer.com/search?q=artist:"' . $artist . '"album:"' . $album . '"';
                    
                    //echo $url . "<br>"; //ok
                    $this->insertBoWp($url, $category); 
                    $this->breakPoint(); 
                    }
                    
                }
                
                
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
       
        // $responseEndpoint is an array with int indexes, contains several musics 
        // and $musicData is array value of indexes $responseEndpoint witch contains one music with this data
        foreach($responseEndpoint['data'] as $musicData){ 
           
            // define postId with wp_insert_post()
            $postId = wp_insert_post([
                'post_type' => 'music',
                'post_status' => 'publish',
                'post_title' => $musicData['title'],
            ]);
            
            // update custom metadata at the post
            update_post_meta($postId, 'music-title', $musicData['title_short']);
            update_post_meta($postId, 'artist', $musicData['artist']['name']);
            update_post_meta($postId, 'sound-excerpt', $musicData['preview']);
            update_post_meta($postId, 'album-name', $musicData['album']['title']);
            update_post_meta($postId, 'album-thumbnail', $musicData['album']['cover_medium']);

            // insert term in post music
            wp_set_post_terms($postId, $category, 'music-type');
        }
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
