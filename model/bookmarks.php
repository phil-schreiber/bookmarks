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
    protected $_crdate;
    protected $_tstamp;
    protected $_url;
    protected $_title;
    protected $_hashtags;
    
    public function __construct(int $uid=0,$tstamp,$url,$title, array $hashtags=array()){
        $this->setUid($uid);
        $this->setTstamp($tstamp);
        $this->setUrl($url);
        $this->setTitle($title);
        if($hashtags){
            $this->setHashtags($hashtags);
        }
    }
    
    public function  setUid($uid){
        if($this->_uid !== null){
            throw new \BadMethodCallException("UID has already been set");
        }
        
        if(!is_int($uid) || $uid < 1){
            throw new \InvalidArgumentException("The UID is invalid");
        }
        
        $this->_uid=$uid;
        return $this;
    }
    
    public function getUid(){
        return $this->_uid;
    }
    
    /*TODO put some validation in place for the other setters*/
    public function setDeleted($deleted){
        $this->_deleted = $deleted;
        return $this;
    }
    
    public function getDetleted(){
        return $this->_deleted;
    }
    
    public function setCrdate($crdate){
        $this->_crdate = $crdate;
        return $this;
    }
    
    public function getCrdate(){
        return $this->_crdate;
    }
    
    public function setTstamp($tstamp){
        $this->_tstamp = $tstamp;
        return $this;
    }
    
    public function getTstamp(){
        return $this->_tstamp;
    }
    
    public function setUrl($url){
        $this->_url = $url;                
        return $this;
    }
    
    public function getUrl(){
        return $this->_url;
    }
    
    public function setTitle($title){
        $this->_title = $title;
        return $this;
    }
    
    public function getTitle(){
        return $this->_title;
    }
    
    public function setHashtags(array $hashtags){
        foreach($hashtags as $hashtag){
            if(!$hashtag instanceof hashtags ){
                throw new \InvalidArgumentException("One or more hashtags is invalid");
            }
        }
        $this->_hashtags = $hashtags;
        
        return $this;
    }
    
    public function getHashtags(){
        return $this->_hashtags;
    }
    
}