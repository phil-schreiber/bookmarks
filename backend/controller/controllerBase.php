<?php
/**
 * Basic controller configuration.
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

class controllerBase {
   protected $_db;
   protected $_mappers;
   
   function __construct(\bm\db\db $db, $mappers){
        $this->_db = $db;
        $this->_mappers=$mappers;
   }
   
   
}
