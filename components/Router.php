<?php 

class Router 
{
    private $routes;

    public function __construct()
    {   
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    public function run()
    {
        $userURI = $this->getURI();
        
        foreach ($this->routes as $uriPattern => $innerPath)
        {                 
            if (preg_match("`$uriPattern$`", $userURI))
            {             
                $innerRoute = preg_replace("`$uriPattern$`", $innerPath, $userURI);

                $segmentRoute = explode('/', $innerRoute);
                // Controller Name
                $controllerName = ucfirst(array_shift($segmentRoute) . 'Controller');
                // Action Name
                $actionName = 'action' . ucfirst(array_shift($segmentRoute));
                // Присваиваем массив с оставшимися значениями (параметрами запроса) переменной $params
                $params = $segmentRoute;

                $controllerClass = ROOT . '/controllers/' . $controllerName . '.php';
                  
                if (file_exists($controllerClass)) {

                    include_once ($controllerClass);
                } else {

                    $controllerClass = ROOT . '/controllers/admin/' . $controllerName . '.php';
                    include_once ($controllerClass);
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array([$controllerObject, $actionName], $params);
                if ($result != null) break;
            }
        }
    }


    private function getURI() 
    {
        if (!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
}