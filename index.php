<?php
namespace bm;
use Pimple\Container;
use bm\core\Autoloader;
use bm\db\db as db;
use bm\db\PDOAdapter as PDO;



require_once "vendor/autoload.php";
$config = include "config/config.php";

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
            break;
    }
    
    return new db($adapter);
};

$query=$container["db"]->getDb()->query("SELECT * FROM bookmarks WHERE uid = :uid",array("uid"=>1));
