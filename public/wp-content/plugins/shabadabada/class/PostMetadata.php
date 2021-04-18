<?php

// Fields to be created in cpt Music :
// Music title 
// Artist 
// Sound excerpt
// Album thumbnail

namespace Shabadabada;


class PostMetadata
{
    // properties that will allow you to create custom Postmetadata
    protected $customPostType;
    protected $name;
    protected $label;
    
    /**
    * Construct method which create a new PostMetadata
    */
    public function __construct($customPostType, $name, $label)
    {
        $this->customPostType = $customPostType;
        $this->name = $name;
        $this->label = $label;

        register_post_meta($customPostType, $name, ['show_in_rest' => true]);
    }

    /**
     * Register method for create and register new custom post metadata
     *
     */
    public function registerForm()
    { 
        // DOC https://developer.wordpress.org/reference/hooks/edit_form_after_editor/
        add_action('edit_form_after_editor', [$this, 'editForm']);
    

        // DOC https://developer.wordpress.org/reference/hooks/save_post_post-post_type/
        add_action('save_post_' . $this->customPostType, [$this, 'save']);
    }

    /**
     * Register method for create and register new custom post metadata
     *
     */
    public function registerThumbnail()
    { 
        // DOC https://developer.wordpress.org/reference/hooks/edit_form_after_editor/
        add_action('edit_form_after_editor', [$this, 'editThumbnail']);

        // DOC https://developer.wordpress.org/reference/hooks/save_post_post-post_type/
        add_action('save_post_' . $this->customPostType, [$this, 'save']);
    }

    /**
     * Creation form method
     */
    public function editForm($post)
    {
        // if post_type does not match our customPostType, return false for this editForm creation
        if($post->post_type !== $this->customPostType){
            return false;
        }

        // defintion of values of id and name post_meta
        // DOC https://developer.wordpress.org/reference/functions/get_post_meta/
        $values = get_post_meta(
            $post->ID,
            $this->name,
        );

        // if $values is not empty, we retrieve index 0 of an array wich contains value of metadata
        if(!empty($values)){
             $value = $values[0]; 
        }
        else {
            $value = '';
        }

        echo '
            <div class="form-field">
                <label for="' . $this->name . '">' . $this->label . '</label>
                <input type="text" name="' . $this->name . '" id="' . $this->name . '" value="' . $value . '"/>
            </div>
        ';
    }

    /**
     * Creation form method
     */
    public function editThumbnail($post)
    {
        // if post_type does not match our customPostType, return false for this editForm creation
        if($post->post_type !== $this->customPostType){
            return false;
        }

        // defintion of values of id and name post_meta
        // DOC https://developer.wordpress.org/reference/functions/get_post_meta/
        $values = get_post_meta(
            $post->ID,
            $this->name,
        );

        // if $values is not empty, we retrieve index 0 of an array wich contains value of metadata
        if(!empty($values)){
             $value = $values[0]; 
        }
        else {
            $value = '';
        }

        echo '
            <div class="form-field">
                <label for="' . $this->name . '">' . $this->label . '</label>
                <input type="text" name="' . $this->name . '" id="' . $this->name . '" value="' . $value . '"/>
                <img class="thumbnail" alt="' . $this->label . '" id="' . $this->name . '" src="' . $value . '"/>
            </div>
        ';

    }

    public function save($postId)
    {
        //retrieve value send with form
        $value = filter_input(INPUT_POST, $this->name);

        //DOC https://developer.wordpress.org/reference/functions/update_post_meta/
        update_post_meta(
            $postId,
            $this->name,
            $value
        );
    }
    
}