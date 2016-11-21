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

return array(
  "db"  => array(
      "adapter" => "mysql", 
      "user" => "root",
      "server" => "localhost",
      "password" =>"",
      "dbname" => "bookmarks"
  ),
  "basepath" =>"/bookmarks/backend/"
);