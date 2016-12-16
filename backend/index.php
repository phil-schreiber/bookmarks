<?php
namespace bm;
use Pimple\Container;
use bm\core\Autoloader;
use bm\db\db as db;
use bm\db\PDOAdapter as PDO;




$config = include "config/config.php";

/*bootstrapping the general autoloader*/
require_once 'config/bootstrap.php';

$autoloader = new Autoloader('bm');
$autoloader->register();



$container = new Container();

$container['config']=$config;

/*db adapter*/
$container['db'] = function ($c) {
    switch($c["config"]["db"]["adapter"]){
        case "mysql":                        
        default:
            $adapter=PDO::getInstance('mysql:dbname='.$c["config"]["db"]["dbname"].';host='.$c["config"]["db"]["server"].'',$c["config"]["db"]["user"],$c["config"]["db"]["password"]);
            $adapter->connect();
            break;
    }
    
    return new db($adapter);
};

/*modelmappers*/
$container["mm"]=function($c){
    $bookmarksHashtagsMapper = new model\bookmarksHashtagsMmMapper($c["db"]);
    $hashtags = new model\hashtagsMapper($c["db"], $bookmarksHashtagsMapper);
    $bookmarks = new model\bookmarksMapper($c["db"], $hashtags, $bookmarksHashtagsMapper );
  return array(
      "bookmarksHashtagsMapper" => $bookmarksHashtagsMapper,
      "hashtags" => $hashtags,
      "bookmarks" => $bookmarks
  );
};


/*authcontainer*/
$container["auth"]=function($c){
        $config   = dirname(__FILE__) . '/config/authConfig.php';		 	
        require_once( "vendor/Hybrid/Auth.php" );
	return	new \Hybrid_Auth( $config );
};


require_once CONFIG_PATH . "routes.php";

$container['request'] = array($controller,$action);

$container['controller'] = function($c){    
    $controller = "bm\controller\\".ucfirst($c["request"][0])."Controller";    
    return new $controller($c);
};

$container['controller']->$action($id);