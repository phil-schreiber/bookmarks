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


class hashtags extends AbstractEntity{
    protected $_uid;
    protected $_deleted;
    protected $_crdate;
    protected $_tstamp;    
    protected $_title;
    protected $_hashtags;
    
    public function __construct( $uid=null,$tstamp,$title){
        if($uid){
            $this->setUid($uid);
        }
        
        $this->setTstamp($tstamp);        
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
    
    public function setTitle($title){
        $this->_title = $title;
        return $this;
    }
    
    public function getTitle(){
        return $this->_title;
    }        
    
    public function getHashtags(){
        return $this->_hashtags;
    }
   
    public function getAttrArr(){
        $attrArr=array();
        foreach($this as $key => $value){
            if($value){
                $attrArr[substr($key,1)] = $value;
            }
            
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