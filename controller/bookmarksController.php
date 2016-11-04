<?php
namespace bm\controller;
use bm\model\bookmarks;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bookmarksController
 *
 * @author master1
 */
class bookmarksController extends controllerBase{
    
        
    
    public function listAction(){        
        /*TODO implementing factory for model creation instead of passing on dependency */
        $bookmarksObject = new bookmarks($this->db);
        $bookmarks = $bookmarksObject->find(array(
            "conditions" => "`deleted` = 0",
            "bind" => array(
                1 => 0
            )
        ));        
                            
        echo json_encode($bookmarks);
    }
    
    public function retrieveAction($id=0){
        
        $bookmarksObject = new bookmarks($this->db);
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id"])) {
            $id = filter_input(INPUT_POST,$_POST["id"],FILTER_VALIDATE_INT);
            
        }else{
            $id = filter_var($id,FILTER_VALIDATE_INT);
        }
        
        $bookmark = $bookmarksObject->findOneById($id);
        echo json_encode($bookmark);
    }
    
    public function indexAction(){
        $this->listAction();
    }
}
