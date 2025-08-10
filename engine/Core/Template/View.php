<?php

namespace Engine\Core\Template;

use Engine\Core\Template\Theme;

class View
{
    protected $theme;

    public function __construct()
    {
        $this->theme = new Theme();
    }

    /**
     * @param $template
     * @param $vars
     * @return void
     */
    public function __render($template, $vars = [])
    {
        $templatePath = ROOT_DIR_ . '/content/themes/default/' . $template . '.php';

        if (!is_file($templatePath))
        {
            throw new \InvalidArgumentException(
                    sprintf('Template "%s" not found in "%s"', $template, $templatePath));
        }
        $this->theme->setData($vars);
        extract ($vars);

            ob_start();
            ob_implicit_flush();

            try{
                require $templatePath;
            }catch (\Exception $e){
                ob_end_clean();
                throw $e;
            }

            echo ob_get_clean();
    }
}