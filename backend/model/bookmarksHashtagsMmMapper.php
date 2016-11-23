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

class bookmarksHashtagsMmMapper extends models{
    function __construct($db) {
        parent::__construct($db);
        $this->_table = 'bookmarks_hashtags_mm';
    }
    
    public function insert(AbstractEntity $bookmarkHashtagMM){        
        
        $this->_db->getAdapter()->insert(
            $this->_table,
            $bookmarkHashtagMM->getAttrArr()
        );                        
        
        return $bookmarkHashtagMM;         
    }
        
    
    function createEntity(array $row) {        
        return new bookmarksHashtagsMm($row["bookmarks_uid"],$row["hashtags_uid"]);
    }
    
    
}
