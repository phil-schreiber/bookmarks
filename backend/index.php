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
            $adapter=new PDO('mysql:dbname='.$c["config"]["db"]["dbname"].';host='.$c["config"]["db"]["server"].'',$c["config"]["db"]["user"],$c["config"]["db"]["password"]);
            $adapter->connect();
            break;
    }
    
    return new db($adapter);
};

/*modelmappers*/
$container["mm"]["bookmarksHashtagsMapper"]=function($c){
    return new model\bookmarksHashtagsMmMapper($c["db"]);
};
$container["mm"]["hashtags"]=function($c){
    return new model\hashtagsMapper($c["db"],$c["mm"]["bookmarksHashtagsMapper"]);
};
$container["mm"]["bookmarks"]=function($c){              
    return new model\bookmarksMapper($c["db"],$c["mm"]["hashtags"],$c["mm"]["bookmarksHashtagsMapper"]);
};

/*viewcontainer*/



require_once CONFIG_PATH . "routes.php";

$container['request'] = array($controller,$action);

$container['controller'] = function($c){    
    $controller = "bm\controller\\".ucfirst($c["request"][0])."Controller";    
    return new $controller($c["db"],$c["mm"]);
};

$container['controller']->$action($id);