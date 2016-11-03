<?php


namespace bm\controller;

/**
 * Description of controllerBase
 *
 * @author master1
 */
class controllerBase {
   function __construct(\Pimple\Container $app){
        $this->app = $app;
   }
}
