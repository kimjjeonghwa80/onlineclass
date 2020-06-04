<?php
class HomeController {
    private $view;
   
    function __construct(){
        
        
        $this->view = new HomeView();
        $this->displayPage();

    }

    function displayPage() {
        echo $this->view->displayPage();
    }


    


}