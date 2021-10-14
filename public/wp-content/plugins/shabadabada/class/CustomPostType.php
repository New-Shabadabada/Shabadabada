<?php

namespace Shabadabada;

class CustomPostType
{
    //class property statement
    protected $name;
    protected $label;

    //options dedicated to custom post type
    // DOC https://developer.wordpress.org/resource/dashicons/#format-audio
    protected $options = [
        'label' => 'Custom post type',
        'description' => 'Custom post type',
        'menu_position' => 4,
        'menu_icon' => 'dashicons-format-audio',
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
        'show_in_rest' => true,


        'supports' => [
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
        ],
    ];

    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;

    }

    //launching actions on activation
    public function register()
    {
        add_action('init', [$this, 'registerPostType']);
        add_filter('use_block_editor_for_post_type', [$this, 'disableGutemberg'], 10, 2);
        add_action('admin_init', [$this, 'addCapabilitiesToAdmin']);


    }

    //creation and recording of the cpt
    public function registerPostType()
    {
        register_post_type($this->name, $this->getOptions());
    }

    public function addCapabilitiesToRole($roleName)
    {
        // recovery of the role
        // DOC https://developer.wordpress.org/reference/functions/get_role/
        $role = get_role( $roleName );

        // role capacity management for custom post type
        $role->add_cap( 'edit_' . $this->name);
        $role->add_cap( 'edit_' . $this->name . 's');
        $role->add_cap( 'read_' .  $this->name . 's' );

        $role->add_cap( 'delete_' .  $this->name);

        $role->add_cap( 'delete_' .  $this->name . 's' );
        $role->add_cap( 'delete_others_' .  $this->name . 's' );
        $role->add_cap( 'delete_published_' .  $this->name . 's' );

        $role->add_cap( 'edit_others' .  $this->name . 's' );
        $role->add_cap( 'publish_' .  $this->name . 's' );
        $role->add_cap( 'read_private_' .  $this->name . 's' );

    }
    
    //function that will be used when the user part is created
    public function addCapabilitiesToAdmin()
    {
        return $this->addCapabilitiesToRole('administrator');
    }
    

    public function getOptions()
    {
        //assigning roles based on CPT options
        $arguments = $this->options;
        $arguments['label'] = $this->label;
        $arguments['capability_type'] =  $this->name;
        return $arguments;
    }


    public function disableGutemberg($isGutenbergEnable, $postType)
    {
        if($postType === $this->name) {
            return false;
        }
        else {
            return $isGutenbergEnable;
        }
    }
}

    