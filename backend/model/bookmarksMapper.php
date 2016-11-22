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
    protected $_hashtagsMapper;
    protected $_bookmarksHashtagsMapper;
    function __construct($db, hashtagsMapper $hashtagsMapper, bookmarksHashtagsMmMapper $bookmarksHashtagsMapper) {
        parent::__construct($db);
        $this->_table = 'bookmarks';
        $this->_hashtagsMapper = $hashtagsMapper;
        $this->_bookmarksHashtagsMapper = $bookmarksHashtagsMapper;
    }
    
    public function insert(AbstractEntity $bookmark){
        $uid = $this->_db->getAdapter()->insert(
                $this->_table,
                $bookmark->getAttrArr()
                );
        $bookmark->setUid($uid);
        
        if(count($bookmark->hashtags)>0){
            $this->insertRelations($bookmark);
        }
        
        return $bookmark;         
    }
    
    private function insertRelations($bookmark){
        foreach($bookmark->hashtags as $hashtag){
            $relation = new bookmarksHashtagsMm();
        }
    }
    
    function createEntity(array $row) {        
        
        return new bookmarks(intval($row["uid"]),$row["title"],$row["url"],$row["tstamp"]);
    }
    
    
}
