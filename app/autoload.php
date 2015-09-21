<?php
/**
 * Class Autoloader : Manages classes self loading,
 * this class self-register automatically in the launching of app
 * @author Macky Dieng
 * @license MIT - http://opensource.org/licenses/MIT
 * @copyright 2015 the author
 */
class Autoloader
{
  /**
   * Class constructor : register all specified Loader
   */
    public function __construct()
    {
        spl_autoload_register(array($this, 'classLoader'));
        spl_autoload_register(array($this, 'libraryLoader'));
        spl_autoload_register(array($this, 'appClassLoader'));
    }
  /**
   * Manages self loading of packages in the "src" directory
   * @param object $class : Class to load
   * @return void
   */
    public static function classLoader($class)
    {
        $namespace = explode('\\', $class);
        $path = implode('/', $namespace);
        $fullpath = SRC_DIR.$path.'.php';
        if (is_readable($fullpath)) {
            include($fullpath);
        }
    }
  /**
   * Manages self loading of packages in the "lib" directory
   * @param object $class : Class to load
   * @return void
   */
    public static function libraryLoader($class)
    {
        $namespace = explode('\\', $class);
        $path = implode('/', $namespace);
        $fullpath = LIB_DIR.$path.'.php';
        if (is_readable($fullpath)) {
            include($fullpath);
        }
    }
   /**
   * Manages self loading of packages in the "app" directory
   * @param object $class : Class to load
   * @return void
   */
    public static function appClassLoader($class)
    {
        $namespace = explode('\\', $class);
        $path = implode('/', $namespace);
        $fullpath = APP_DIR.$path.'.php';
        if (is_readable($fullpath)) {
            include($fullpath);
        }
    }
}
