<?php
/**
 * @author Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * 
 * @category Class
 * @package  bookmarks 
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks
 */

namespace bm\model;

class bookmarksMapper extends models{
    function __construct($db) {
        parent::__construct($db);
        $this->_table = 'bookmarks';
    }
    
    public function insert(AbstractEntity $bookmark){
        $uid = $this->_db->getAdapter()->insert(
                $this->_table,
                $bookmark->getAttrArr()
                );
        $bookmark->setUid($uid);
         return $bookmark;         
    }
        
    
    function createEntity(array $row) {        
        return new bookmarks(intval($row["uid"]),$row["title"],$row["url"],$row["tstamp"]);
    }
    
    
}
