<?php
//fait le bridge
/**
 * A le controle sur ce que la vue doit faire
 */
class IndexController {
    //private $dao;
    private $view;
    
    function __construct($get, $post, $route) {
        
        $this->view = new IndexPageView();
        $this->displayPage();
        //var_dump("Je suis dans l'indexController");
    }
    
    function displayPage() {
        echo $this->view->displayPage();
    }
    
}
