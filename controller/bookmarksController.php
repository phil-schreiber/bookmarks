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
        $bookmarks = bookmarks::find();        
        
            
        
        echo json_encode($bookmarks);
    }
    
    public function indexAction(){
        $this->listAction();
    }
}
