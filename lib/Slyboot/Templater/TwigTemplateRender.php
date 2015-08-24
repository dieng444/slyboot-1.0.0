<?php
namespace Slyboot\Templater;

use Slyboot\Logging\Auth\AuthManager;

/**
 * Class TwigTemplater : allows to render template
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class TwigTemplateRender implements TemplaterInterface
{
    /**
     * Render template
	 * @param string $view template to render
	 * @param mixed $context data or other thing
	 * to display in the template
	 * @return mixed
     */
    public static function render($name, array $context)
    {
        $templateParts = explode("::", $name);
        $templateDir = 'src/'.$templateParts[0].'/'.$templateParts[1].
                       '/'.'Resources/views/'.$templateParts[2].'/';
        $layoutDir = 'src/'.$templateParts[0].'/'.$templateParts[1].
        '/'.'Resources/views/';
        $baseDir = 'resources/views';
        $templateName = $templateParts[3];
        if (is_readable($templateDir.$templateName)) {
            $loader = new \Twig_Loader_Filesystem(array($templateDir,$layoutDir,$baseDir));
            $twig = new \Twig_Environment($loader, array('debug' => true));
            $twig->addGlobal('user', AuthManager::getInstance());
            echo $twig->render($templateName, $context);
        }else{
            echo "File not read able";die;
        }
    }
}