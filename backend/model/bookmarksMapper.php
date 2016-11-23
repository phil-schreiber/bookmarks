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
        $this->_tableForeign = $this->_hashtagsMapper->_table;
        $this->_tableMm = $this->_bookmarksHashtagsMapper->_table;
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
        foreach($bookmark->getHashtags() as $hashtag){            
            $relation = new bookmarksHashtagsMm($bookmark->getUid(),$hashtag->getUid());
            
            $this->_bookmarksHashtagsMapper->insert($relation);
        }
    }
    
    function createEntity(array $row) {        
        $bookmark = new bookmarks(0,$row["crdate"],$row["tstamp"],$row["url"],$row["title"],intval($row["uid"]));
        
        $relations = $this->findMM(array(
            "conditions" =>"local.uid = :uid",
            "bind" => array(
                ":uid" => $bookmark->getUid()
            )
            ));
        $hashtags = array();
        foreach($relations as $relation){
            $hashtagArr=array(
                "crdate" => $relation["crdate"][1],
                "tstamp" => $relation["tstamp"][1],
                "title" => $relation["title"][1],
                "uid" => $relation["uid"][1]
                );
            $hashtags[] = $this->_hashtagsMapper->createEntity($hashtagArr);            
        }
        $bookmark->setHashtags($hashtags);
        
        return $bookmark;
    }
    
    
}
