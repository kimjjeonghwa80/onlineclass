<?php
class IndexController {
    private $dao;
    private $view;
    
    function __construct($get, $post, $route) {
        
        $this->view = new IndexPageView();
        //var_dump('route', $route, 'post', $post);
    }
    
   
}
