<?php
/**
 * Controlling Bookmarks CRUD cycle.
 * 
 * PHP version 5
 * 
 * @category Class
 * @package  Bookmarks
 * @author   Philipp Schreiber <phil.schreiber@ephemeroid.net>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://github.com/phil-schreiber/bookmarks    
 */

namespace bm\controller;

class bookmarksController extends controllerBase{
            
    
    public function listAction(){        
        /*TODO implementing factory for model creation instead of passing on dependency */
        
        $bookmarks = $this->_mappers["bookmarks"]->find(array(
            "conditions" => "`deleted` = 0",
            "bind" => array(
                1 => 0
            )
        ));        
                            
    
        return $bookmarks;
    }
    
    public function retrieveAction($id=0){
                
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING) === 'POST' && isset($_POST["id"])) {
            $id = filter_input(INPUT_POST,"id",FILTER_VALIDATE_INT);            
        } else {
            $id = filter_var($id,FILTER_VALIDATE_INT);
        }
        
        $bookmark = $this->_mappers["bookmarks"]->findOneById($id);
        
        echo json_encode($bookmark);
    }
    
    public function indexAction(){
        $this->listAction();
    }
    
    public function createAction(){                

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {            
            $time = time();
            $bookmark = new \bm\model\bookmarks(
                0,    
                $time,    
                $time,    
                isset($_POST["url"]) ? filter_input(INPUT_POST,"url") : "" ,
                isset($_POST["title"]) ? filter_input(INPUT_POST,"title") : ""                    
                );
            
            $hashtags = $this->assembleHashtags();
            $bookmark->setHashtags($hashtags);
            
            return $this->_mappers["bookmarks"]->insert($bookmark);                                    
        }                
    }
    
    private function assembleHashtags(){
        if(!isset($_POST["hashtags"])){
            return array();
        }
        
        if(count($_POST["hashtags"]) == 0){
            return array();
        }
        
        $hashtags=array();
        
        $hashtagsRaw = filter_input(INPUT_POST, "hashtags", FILTER_SANITIZE_STRING, FILTER_REQUIRE_ARRAY);
        
        
        foreach($hashtagsRaw as $hashtagRaw){            
            $hashtag = $this->_mappers["hashtags"]->findOneByAttr("title",$hashtagRaw);
            if(!$hashtag){
                $hashtag = new \bm\model\hashtags(
                        time(),
                        time(),
                        $hashtagRaw
                    );
                $uid = $this->_mappers["hashtags"]->insert($hashtag);
                
            }
            $hashtags[] = $hashtag;
            
        }
        
        return $hashtags;
        
    }
}
