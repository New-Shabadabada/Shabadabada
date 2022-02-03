<?php

namespace Shabadabada\CustomWPFeatures;

class CustomPostType
{
    protected $name;
    protected $label;

    // Options dedicated to custom post type
    // DOC - Dashicons - https://developer.wordpress.org/resource/dashicons/#format-audio
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

    /**
     * Register at the plugin initialization
     */
    public function register()
    {
        add_action('init', [$this, 'registerPostType']);
        add_filter('use_block_editor_for_post_type', [$this, 'disableGutemberg'], 10, 2);
        add_action('admin_init', [$this, 'addCapabilitiesToAdmin']);
    }

    /**
     * Create and record CPT
     */
    public function registerPostType()
    {
        register_post_type($this->name, $this->getOptions());
    }

    /**
     * Add authorisation for administrator role
     */
    public function addCapabilitiesToAdmin()
    {
        return $this->addCapabilitiesToRole('administrator');
    }

    /**
     * Create authorization instead of role indicate in parameter
     * @param $roleName
     */
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

    /**
     * Attribute roles instead of CPT options
     * @return array all options of cpt
     */
    public function getOptions()
    {
        $arguments = $this->options;
        $arguments['label'] = $this->label;
        $arguments['capability_type'] =  $this->name;
        return $arguments;
    }

    /**
     * Deactivate gutenberg editor
     * @param Bolean
     * @param PostType
     */
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

