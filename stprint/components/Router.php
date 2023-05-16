<?php
class Router {
    private  $routes;
    
    public function __construct() 
    {
        $routesPath=ROOT.'/config/routes.php';
        $this->routes= include($routesPath);
    }
    
    private function getURI()
    {
         if (!empty($_SERVER['REQUEST_URI']))
        {
             return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
       // get request string
       $uri = $this->getURI();
       // check request in routes
       foreach ($this->routes as $uriPattern => $path)
       {
           if(preg_match("~$uriPattern~", $uri))
           {
               $internalRoute = preg_replace("~$uriPattern~", $path, $uri);    
               // choose controller ad action
               $segments = explode('/', $internalRoute);
               $controllerName = array_shift($segments).'Controller';
               $actionName='action'.ucfirst(array_shift($segments));
               $parameters=$segments; 
               // add class controller
               $controllerFile=ROOT.'/controllers/'.$controllerName.'.php';
               if (file_exists($controllerFile))
               {
                   include_once($controllerFile);
               }               
               // create object and call method 
               $controllerObj = new $controllerName;
               $result = call_user_func_array(array($controllerObj, $actionName), $parameters);
               if ($result!=null)
                   break;
           }          
       }       
    }
}
