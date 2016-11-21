<?php
/**
 * Mapping out pathes for the autoloader.
 * 
 * PHP version 5
 * 
 * @category Config
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */

use \bm\core\Autoloader;

define('ROOT_PATH', dirname(dirname(__FILE__)) . '/');
define('APP_PATH', ROOT_PATH . 'app/');
define('CONFIG_PATH', ROOT_PATH . 'config/');
define('CORE_PATH', ROOT_PATH . 'core/');
define('DB_PATH', ROOT_PATH . 'db/');
define('MODEL_PATH', ROOT_PATH . 'model/');
define('CONTROLLER_PATH', ROOT_PATH . 'controller/');

require_once CORE_PATH . 'Autoloader.php';
require_once "vendor/autoload.php";