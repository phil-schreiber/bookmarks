<?php 


  
$controllers = array('bookmarks' => ['index','create','update','retrieve','delete','list'],
                       'login' => ['index','create'],
                       'index' => ['index','error']);

 
$uri = explode('/',substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),strlen($config["basepath"])));
$controller="index";
$action="indexAction";
$id = 0;

if(isset($uri[1]) && array_key_exists($uri[1], $controllers)){
    $controller=$uri[1];
    
    if(isset($uri[2]) && in_array($uri[2], $controllers[$controller])){
        $action=$uri[2]."Action";            
    }
    
    if(isset($uri[3])){
        $id=$uri[3];
    }
}

  
  