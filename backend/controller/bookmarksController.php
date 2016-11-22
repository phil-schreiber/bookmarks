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
                
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id"])) {
            $id = filter_input(INPUT_POST,$_POST["id"],FILTER_VALIDATE_INT);            
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
            
            $bookmark = new \bm\model\bookmarks(                
                time(),    
                isset($_POST["url"]) ? filter_input(INPUT_POST,"url") : "" ,
                isset($_POST["title"]) ? filter_input(INPUT_POST,"title") : ""
                    
                );
            
            $hashtags = $this->assembleHashtags();
            $bookmark->setHashtags($hashtags);
            $this->_mappers["bookmarks"]->insert($bookmark);
            
            var_dump($bookmark);
            
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
        
        $hashtagsRaw = filter_input_array(INPUT_POST,array("hashtags"));
        
        foreach($hashtagsRaw as $hashtagRaw){
            $hashtag = $this->_mappers["hashtags"]->findOneByAttr("title",$hashtagRaw);
            if(!$hashtag){
                $hashtag = new \bm\model\hashtags(
                        time(),
                        time(),
                        $hashtagRaw
                    );
                $uid = $this->_mappers["hashtags"]->insert($hashtag);
                $hashtag->setUid($uid);                
            }
            $hashtags[] = $hashtag;
            
        }
        
        return $hashtags;
        
    }
}
