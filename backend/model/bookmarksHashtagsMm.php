<?php
/**
 * Mapping out pathes for the autoloader.
 * 
 * PHP version 5
 * 
 * @category Class
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */
namespace bm\model;

class bookmarksHashtagsMm extends AbstractEntity{
   
    protected $_bookmarks_uid;
    protected $_hashtags_uid;
    
    public function __construct($bookmarksUid,$hashtagsUid) {
        $this->setBookmarksUid($bookmarksUid);
        $this->setHashtagsUid($hashtagsUid);
    }
    
    public function setBookmarksUid($bookmarksUid){
        $this->_bookmarks_uid = $bookmarksUid;        
    }    
    public function getBookmarksUid(){
        return $this->_bookmarks_uid;
    }
    
    public function setHashtagsUid($hashtagsUid){
        $this->_hashtags_uid = $hashtagsUid;        
    }    
    public function getHashtagsUid(){
        return $this->_hashtags_uid;
    }
    
    public function getAttrArr(){
        $attrArr=array();
        foreach($this as $key => $value){            
            $attrArr[substr($key,1)] = $value;                        
        }        
        return $attrArr;
    }
    
    public function jsonSerialize() {
        $json = array();
        foreach($this as $key => $value) {
            $json[substr($key,1)] = $value;
        }
        return $json; 
    }
    
}