<?php
 namespace Slyboot\Router;

use Front\AppConfigLoader;
use Slyboot\Request\HttpRequest;
use Exception;
 /**
  * Class Dispatcher : Match request to route,
  * and manage for know which action to execute
  * @author Macky Dieng
  * @license MIT - http://opensource.org/licenses/MIT
  * @copyright 2015 the author
  */
 class Dispatcher
 {
     /**
      * Manage route and request for know which
      * action to execute
      * @throws Exception
      * @return mixed
      */
     public function dispatch()
     {
         $config = AppConfigLoader::loadConfigurations();
        /************************************************
         * I use foreach here because in the future,    *
         * $routingFiles does not contain just a single *
         * file, but a list of routing files.           *
         ************************************************/
        foreach ($config['routingFiles'] as $file) {
            if(is_readable($file)) {
                require $file;
            } else
                throw new Exception("Impossible to read routing file, check the app/Front/AppConfigLoader
                        file and be sure that the routing file is specified correctly");
        }
        /**********Initializing of all the algorithme variables**********/
        $collections = $router->getRouteCollections();
        $http = new HttpRequest();
        $uri = $http->getRequestUri();
        $relativeUri = $http->getRelativeRequestUri();
        $script = dirname($http->getScriptName());
        $isRouteMatch = false;
        $isActionParamaterError = false;
        /*************Default route case***********/
        if($uri===$script) {
            $route = $router->getDefaultRoute();
            if ($route!==null) {
                $controllerClass = $route->getVendor().'\\'.
                        $route->getPackage().
                        '\\Controller'.'\\'.
                        $route->getPackage().
                        'Controller';
                $controller  = new $controllerClass();
                $action = $route->getAction().'Action';
                if(method_exists($controller,$action)) {
                    return $controller->$action();
                }else
                    throw new Exception( "Unknow method exception[] Method {$action}
                does'nt exist in class {$controllerClass} . May be controller definition
                is wrong in the routing file");
            } else {
                throw new Exception("Defaut route exception :
                        You most specify the default route in the routing file"
                );
            }

        }
        /************Any route case*****************/
        if(sizeof($collections) > 0){
            foreach ($collections as $collection) {
                foreach($collection->getRoutes() as $route) {
                    $tmpPath = str_replace($script,'',$route->getPath());
                    $pattern = "#".preg_quote(trim($tmpPath)) ."#i";
                    /****************************************************
                     * This condition checks wheter the current request *
                     * match with one of the app route.         *
                     ****************************************************/
                    if(preg_match($pattern, $relativeUri, $match)) {
                        $isRouteMatch = true;
                        $controllerParts = explode('::',$route->getFullControllerDefinition());
                        if((sizeof($controllerParts)!==3) ||
                               substr_count($route->getFullControllerDefinition(),'::')!==2) {
                           throw new Exception( "Wrong route controller definition,
                                check the definition in the routing file
                                that must be type like AppliName::PackageName::ActionName
                                E.g MyJournal::Article::show");
                           die;
                        }
                        /*******The "/" position*********/
                        $pos = (strlen($route->getPath()) - 1);
                        $fullPathPos = (strlen($route->getFullPath()) - 1);
                        /***********************************************************************
                         * Tel user to remove the last "/" in the route path, when he specify  *
                         * it by error or other thing.                                         *
                         **********************************************************************/
                        if(substr($route->getFullPath(), $fullPathPos, 1)===$script){
                            throw new Exception( "Error 404 remove the last \"/\" behind the route path
                            in the routing file".'<br>'); die;
                        }
                        /**********Case route with parameters***********/
                        if(sizeof($route->getQueryString()) > 0){
                       /****************************************************
                        * when route have parameters, the next character   *
                        * after matched path, must be mandatory "/".        *
                        * Else 404 Error is trigged.                       *
                        ****************************************************/
                           if(substr($uri, $pos, 1)!==$script){
                               throw new Exception("Error 404 : Check the character after current route"); die;
                           }else{
                               $uriQueryString = substr($uri, $pos);
                               $tabUriQueryString = explode($script,$uriQueryString);
                               foreach ($tabUriQueryString as $val) {
                                   if($val!==''){
                                       if(is_numeric($val)){
                                           if (is_float($val))
                                               $tabUriQueryStringClean[] = (float) $val;
                                           else
                                               $tabUriQueryStringClean[] = (int) $val;
                                       }else
                                           $tabUriQueryStringClean[] = $val;
                                   }
                               }
                                /*****************************************************
                                 * Verify if route and uri parameters count matched. *
                                 * ***************************************************/
                               if(sizeof($route->getQueryString())===
                                   sizeof($tabUriQueryStringClean)){
                                   if(substr($uri, (strlen($uri) - 1 ), 1)===$script){
                                       throw new Exception("Error 404 : Check the character after current route"); die;
                                   }else{
                                       $controllerClass = $route->getVendor().'\\'.
                                                          $route->getPackage().
                                                          '\\Controller'.'\\'.
                                                          $route->getPackage().
                                                          'Controller';
                                       $controller  = new $controllerClass();
                                       $action = $route->getAction().'Action';
                                       if(method_exists($controller,$action)) {
                                           $reflector = new \ReflectionClass($controller);
                                           $method = $reflector->getMethod($action)->getName();
                                           $parameters = $reflector->getMethod($action)->getParameters();
                                           /************************************************************
                                            * If the user does'nt specify parameter for the controller *
                                            * action, then the action is directly called and executed  *
                                            ************************************************************/
                                           if(empty($parameters)){
                                                return $controller->$action();
                                           }
                                           if(sizeof($route->getQueryString())!==(sizeof($parameters))){
                                               throw new Exception( "Missed parameters, count of parameters not corresponding") ;die;
                                           }else{
                                               /**
                                                * Here, developper specify parameter
                                                * to the controller action
                                                */
                                               foreach ($parameters as $param) {
                                                   $tabParams[] = $param->getName();
                                               }
                                               foreach ($route->getQueryString() as $k => $v) {
                                                   if($route->getQueryString()[$k]!==$tabParams[$k]){
                                                       $isActionParamaterError = true;
                                                       throw new Exception ( "Param {$v} does not a parameter of
                                                             method {$action} in class get Controller or
                                                             The order of passed arguments is not respected.
                                                             It important to respected the order in which\n
                                                             the parameters has been declared in the routing file\n
                                                             You maybe should checks\n.
                                                             You maybe checks in the routing file if the parameter\n
                                                              name in the route is the same with\n
                                                             the the one passed to the controller's action.\n
                                                             Because that is mandatory\n
                                                             they must be same");
                                                       die;
                                                   }
                                               }
                                               if(!$isActionParamaterError){
                                                   return call_user_func_array(array($controller,$action),$tabUriQueryStringClean);
                                               }
                                           }
                                       }else
                                           throw new Exception("Unknow method exception[] : Method {$action}
                                           does'nt exist in class {$controllerClass} . May be controller definition
                                           is wrong in the routing file. Check the routing file and be sure that is not the case");
                                  }
                               }else
                                   throw new Exception("Error 404 : the number of parameters in the routing file most
                                                       be same in the uri") ; die;
                          }
                        /*******************************************************
                         * << Case route without parameters >>                 *
                         * here $pos = strlen($match[0])                       *
                         * if strlen($match[0]) = 15 for example, strlen($uri) *
                         * must equal to 15 too, because the matched route is  *
                         * the full path here ( $match[0] = $uri ).            *
                         *******************************************************/
                        }elseif(empty($route->getQueryString())){
                           if(strlen($uri)!==$pos){
                               throw new Exception("Error 404 : the current route does'nt have an parameter") ; die;
                           }else{
                               $controllerClass = $route->getVendor().'\\'.
                                                  $route->getPackage().
                                                  '\\Controller'.'\\'.
                                                  $route->getPackage().
                                                  'Controller';
                               $controller  = new $controllerClass();
                               $action = $route->getAction().'Action';
                               if(method_exists($controller,$action)) {
                                   return $controller->$action();
                               } else {
                                   throw new Exception ("Unknow method exception[] Method {$action}
                                       does'nt exist in class {$controllerClass} . May be controller defintion
                                       is wrong in the routing file");
                               }
                           }
                       }
                    }
                }
                /*************No route matched, so 404 error's trigged**********/
                if (!$isRouteMatch) {
                    throw new Exception("Error 404 : No route matched with the currrent route") ;die;
                }
             }
        }else
            throw new Exception("No route was found");
     }
 }