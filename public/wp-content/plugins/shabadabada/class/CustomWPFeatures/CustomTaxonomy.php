<?php

namespace Shabadabada\CustomWPFeatures;

class CustomTaxonomy
{
    protected $name;
    protected $label;

    /**
     * List on which the taxonomy is applicable
     * @var array
     */
    protected $postTypes = [];

    /**
     * Determine the taxonomy hierarchy
     * @var boolen "false"= tag & "true" = category
     */
    protected $isHierarchical = false;


    public function __construct($name, $label, array $postTypes)
    {
        $this->postTypes = $postTypes;
        $this->name = $name;
        $this->label = $label;
    }

    /**
     * Hook to register our taxonomy at wp initialization
     */
    public function register()
    {
        add_action('init',[$this, 'registerTaxonomy']);
    }

    /**
     * Create or modify the taxonomy
     * // DOC - Register taxonomy - https://developer.wordpress.org/reference/functions/register_taxonomy/
     */
    public function registerTaxonomy()
    {
        register_taxonomy(

            $this->name,
            $this->postTypes,
            [
                'hierarchical' => $this->isHierarchical,

                'label' => $this->label,

                'show_ui' => true,

                'show_in_rest' => true,

                'show_admin_column' => true,

                'query_var' => true,

                'embeddable' => true,

                'rewrite' => [

                        'slug' => $this->name
                    ],
            ]
        );
    }
}