<?php

namespace Shabadabada;
use Shabadabada\CustomPostType;
use Shabadabada\Deezer;
use Shabadabada\DeezerApo;
use Shabadabada\Models\Music;
use Shabadabada\Models\CoreModel;
use Shabadabada\Models\Game;

class Plugin
{
   public function __construct()
    {
        $this->registerCustomPostTypes();
        $this->registerCustomTaxonomies();
        $this->registerPostMetada();
    } 


    //recording custom post type
    public function registerCustomPostTypes()
    {
        $music = new CustomPostType('music', 'Music');
        $music->register();
    }


    
    public function registerCustomTaxonomies()
    {
        $type = new CustomTaxonomy('music-type','Music Type', ['music']);
        $type->register();
    }



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

    // call the plugin when is activated
    public function activate()
    {
        // BUG not working
        //set_time_limit(0);
        //$deezerObject = new DeezerApo();
        //$deezerObject->import();

        Game::createTable();
        //$game = new Game();
        //$game->createTable();
    }

     // call the plugin when is deactivated
    public function deactivate()
    {
        $music = new Music();
        $music->deletePostMusic();

        Game::dropTable();
    }

}