<?php
class HomeController {
    private $view;
    private $pdo;

    function __construct(){
        
        
        $this->view = new HomeView();
        $this->displayPage();

    }

    function displayPage() {
        echo $this->view->displayPage();
    }


    


}