<?php
namespace bm\model;

/**
 * Description of models
 *
 * @author master1
 */
class models {
    public function find($params=array()){
        $result = $this->app["db"]->getDb()->query("SELECT * FROM bookmarks WHERE uid = :uid",array("uid"=>1));
        return $result;
    }
}
