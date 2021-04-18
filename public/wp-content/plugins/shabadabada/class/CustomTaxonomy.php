<?php

namespace Shabadabada;

class CustomTaxonomy
{
    //class property statement
    protected $name;
    protected $label;

    // postTypes list on which the taxonomy is applicable
    protected $postTypes = [];

    // determine the taxonomy hierarchy 
    // true: it's like a category
    // false: it's like a tag
    protected $isHierarchical = false;


    public function __construct($name, $label, array $postTypes)
    {
        $this->postTypes = $postTypes;
        $this->name = $name;
        $this->label = $label;
    }

    // hook to register our taxonomy at wp initialization
    public function register()
    {
        add_action('init',[$this, 'registerTaxonomy']);
    }

    // method to create or modify the taxonomy
    // DOC https://developer.wordpress.org/reference/functions/register_taxonomy/
    public function registerTaxonomy()
    {

        register_taxonomy(

            $this->name, //identifiant
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

} // end of the class