<?php
class RegisterController {
    private $view;
    
    function __construct(){
        
        $this->view = new RegisterPageView();
        $this->displayPage();
    }

    function displayPage() {
        echo $this->view->displayPage();
    }

}