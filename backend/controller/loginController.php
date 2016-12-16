<?php
/**
 * Controlling Bookmarks CRUD cycle.
 * 
 * PHP version 5
 * 
 * @category Class
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */

namespace bm\controller;

class loginController extends controllerBase{
    public function loginAction(){
        
        
        try{		
		$adapter = $this->_auth->authenticate( $provider_name );
 		
		$user_profile = $adapter->getUserProfile();
	}catch(Exception $e){
		header("Location: http://www.example.com/login-error.php");
	}
    }
}