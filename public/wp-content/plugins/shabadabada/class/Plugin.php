<?php

namespace Shabadabada;

use Shabadabada\Api\Deezer;
use Shabadabada\Api\DeezerApo;
use Shabadabada\Models\Game;
use Shabadabada\Models\Music;
use Shabadabada\Models\CoreModel;
use Shabadabada\CustomWPFeatures\CustomTaxonomy;
use Shabadabada\CustomWPFeatures\PostMetadata;
use Shabadabada\CustomWPFeatures\CustomPostType;

class Plugin
{
   public function __construct()
    {
        $this->registerCustomPostTypes();
        $this->registerCustomTaxonomies();
        $this->registerPostMetada();
    }

    /**
     * Create new Music CPT
     * @return void
     */
    public function registerCustomPostTypes()
    {
        $music = new CustomPostType('music', 'Music');
        $music->register();
    }

    /**
     * Register music type
     * @return void
     */
    public function registerCustomTaxonomies()
    {
        $type = new CustomTaxonomy('music-type','Music Type', ['music']);
        $type->register();
    }


    /**
     * Register music-title, artist, sound-excerpt, album-name, album-thumbnail fields
     * @return void
     */
    public function registerPostMetada()
    {
        $musicMeta = new PostMetadata('music', 'music-title', 'Music Title');
        $musicMeta->registerForm();

        $artistMeta = new PostMetadata('music', 'artist', 'Artist');
        $artistMeta->registerForm();

        $soundExcerptMeta = new PostMetadata('music', 'sound-excerpt', 'Sound excerpt');
        $soundExcerptMeta->registerForm();

        $soundExcerptMeta = new PostMetadata('music', 'album-name', 'Album name');
        $soundExcerptMeta->registerForm();

        $thumbnailMeta = new PostMetadata('music', 'album-thumbnail', 'Album thumbnail');
        $thumbnailMeta->registerThumbnail();
    }

    /**
     * Called when the plugin is activated
     * @return void
     */
    public function activate()
    {
        // TODO : import not working at plugin activation, actually, import db in terminal
        //set_time_limit(0);
        //$deezerObject = new DeezerApo();
        //$deezerObject->import();

        Game::createTable();
    }

    /**
     * Called when the plugin  is deactivated
    */
    public function deactivate()
    {
        $music = new Music();
        $music->deletePostMusic();

        Game::dropTable();
    }
}