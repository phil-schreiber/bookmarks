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
$container["mm"]=function($c){
        return array(
            "bookmarks" => new model\bookmarksMapper($c["db"])
        );
};

//$query=$container["db"]->getDb()->query("SELECT * FROM bookmarks WHERE uid = :uid",array("uid"=>1));

require_once CONFIG_PATH . "routes.php";

$container['request'] = array($controller,$action);

$container['controller'] = function($c){    
    $controller = "bm\controller\\".ucfirst($c["request"][0])."Controller";    
    return new $controller($c["db"],$c["mm"]);
};

$container['controller']->$action($id);