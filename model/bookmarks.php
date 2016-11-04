<?php
namespace bm\model;


class bookmarks extends models{
    function __construct($db) {
        parent::__construct($db);
        $this->table = 'bookmarks';
    }
}
