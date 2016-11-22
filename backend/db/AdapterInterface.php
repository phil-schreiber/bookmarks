<?php
/**
 * Iterface for implementation of DB CRUD methods.
 * 
 * PHP version 5
 * 
 * @category Interface
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */

namespace bm\db;

interface AdapterInterface {
    
    public function connect();
    
    public function query($statement,$params);
    
    public function insert($table,$params);
    
    public function update($table,$params,$uid);
}