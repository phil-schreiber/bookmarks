<?php 
function call($controller, $action, $di) {    
    switch($controller) {
      case 'bookmarks':
        $controller = new bm\controller\BookmarksController($di);
      break;
      case 'login':                
        $controller = new bm\controller\LoginController();
      break;
      case 'index':                
        $controller = new bm\controller\IndexController();
      break;
    }
    $controller->{ $action.'Action' }();
  }

  
  $controllers = array('bookmarks' => ['index','create','update','retrieve','delete','list'],
                       'login' => ['index','create'],
                       'index' => ['index','error']);

 
$uri = explode('/',substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),strlen($config["basepath"])));
$controller="index";
$action="index";

if(isset($uri[1]) && array_key_exists($uri[1], $controllers)){
    $controller=$uri[1];
    
    if(isset($uri[2]) && in_array($uri[2], $controllers[$controller])){
        $action=$uri[2];
    }
}

  
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action, $container);
    } else {
      call('index', 'error');
    }
  } else {
    call('index', 'error');
  }