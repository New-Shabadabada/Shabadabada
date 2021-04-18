<?php

namespace Shabadabada\Models;

use WP_Query;

class Music extends CoreModel
{
    // public $category;
    // public $track;
    // public $number;

    public function __construct()
    {
        
    }

    // astract method CoreModel
    public static function delete($id){}
    public static function getTableName(){}


    /**
     * Method for extract 
     *
     * @param String $category
     * @param Mixed $field
     * @return void
     */
    public function get_musics_from_category($category, $field = 'slug')
    {
        $queryFilters = [
            'tax_query' => array(
                array(
                    'taxonomy' => 'music-type',
                    'field' => $field,
                    'terms' => $category
                )
            ),
            'post_type' => 'music',
            'post_status' => 'publish',
            'posts_per_page' => -1,

        ];

        $query = new WP_Query($queryFilters);
    
        $musics = $query->get_posts();

        shuffle($musics);

        $playlist = array_slice($musics, 0, 10);
        
       
        $this->get_music_metadata($playlist);
            
        return $playlist;
    }


    
    /**
     * Method for retrieve musics metadata 
     *
     * @param array $playlist
     * @return void
     */
    public function get_music_metadata($playlist)
    {
        foreach ($playlist as $key => $track) {
            //echo $index . "<br>";
            // var_dump($post);
            $postId = $track->ID;
            
            $playlist[$key]->artist = get_post_meta($postId, 'artist');

            $playlist[$key]->musicTitle  = get_post_meta($postId, 'music-title', true);
            
            $playlist[$key]->soundExcerpt = get_post_meta($postId, 'sound-excerpt', true);
            
            $playlist[$key]->albumName = get_post_meta($postId, 'album-name', true);
            
            $playlist[$key]->albumThumbnail = get_post_meta($postId, 'album-thumbnail', true);
           
        }

    }

    /**
     * Method for delete all posts in cpt Music
     *
     * @return void
     */
    public function deletePostMusic()
    {
        $sql = "DELETE FROM wp_posts WHERE post_type = 'music';";

        static::execute($sql);
    }

}

