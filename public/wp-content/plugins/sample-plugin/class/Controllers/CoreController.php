<?php
namespace Sample\Controllers;

class CoreController
{


    public function show($template, $viewVars = [])
    {

        $templatePath = locate_template($template);
        if(!$templatePath) {
            throw new \Exception('Template ' . $template .  ' can not be found. Check the name and if template file exists in your theme folder');
        }

        // https://developer.wordpress.org/reference/functions/load_template/
        load_template($templatePath, true, $viewVars);
    }

}
