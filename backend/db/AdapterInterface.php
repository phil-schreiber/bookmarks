<?php

/**
 * @author Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * 
 * @category Interface
 * @package  bookmarks 
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