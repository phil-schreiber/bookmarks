<?php
/**
 * Mapping namespace to folder structure and registering corresponding autoloader.
 * 
 * PHP version 5
 * 
 * @category Base
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */

namespace bm\core;

class Autoloader
{
    private $namespace;

    public function __construct($namespace = null)
    {
	    $this->namespace = $namespace;
    }

    public function register()
    {
	    spl_autoload_register(array($this, 'loadClass'),true);
    }

    public function loadClass($className)
    {        
	    if($this->namespace !== null)
	    {
	    	$className = str_replace($this->namespace . '\\', '', $className);
	    }

        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

	    $file = ROOT_PATH . $className. '.php';

	    if(file_exists($file))
	    {
	        require_once $file;
	    }
    }
}