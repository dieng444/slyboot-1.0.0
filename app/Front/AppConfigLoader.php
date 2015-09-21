<?php
namespace Front;

/**
 * Class AppConfigLoader : Allows to Load all the application configuration
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class AppConfigLoader
{
    /**
     * Load all specifieds configurations
     * @return array
     */
    public static function loadConfigurations()
    {
        $configs = array(
                            'routingFiles' => array ('app/routing.php'),
                            'userProvider' => "\\Minijournal\\User\\Entity\\User" //Specify your proviver class namespace here
                        );

        return $configs;
    }
}
