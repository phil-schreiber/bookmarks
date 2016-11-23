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

class hashtagsMapper extends models{
    function __construct($db) {
        parent::__construct($db);
        $this->_table = 'hashtags';
    }
    
    public function insert(AbstractEntity $hashtag){
        $uid = $this->_db->getAdapter()->insert(
                $this->_table,
                $hashtag->getAttrArr()
                );
        $hashtag->setUid($uid);
                        
        return $hashtag;         
    }
        
    
    function createEntity(array $row) {        
        return new hashtags($row["crdate"],$row["tstamp"],$row["title"],intval($row["uid"]));
    }
    
    
}
