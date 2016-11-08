<?php
namespace bm\model;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class bookmarks extends AbstractEntity{
    protected $_uid;
    protected $_deleted;
    protected $_tstamp;
    protected $_url;
    protected $_title;
    
    public function __construct($tstamp,$url,$title){
        $this->setTstamp($tstamp);
        $this->setUrl($url);
        $this->setTitle($title);
    }
    
}