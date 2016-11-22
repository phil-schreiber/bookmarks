<?php
/**
 * Injecting the configured DB adapter.
 * 
 * PHP version 5
 * 
 * @category Class
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */

namespace bm\db;

class db{
    protected $_adapter;
    public function __construct(AdapterInterface $adapter) {
        $this->_adapter=$adapter;
    }
    
    public function getAdapter(){
        return $this->_adapter;
    }
}

