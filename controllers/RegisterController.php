<?php
class RegisterController {
    private $view;
    
    function __construct(){
        var_dump("REgister Controller");
        $this->view = new RegisterPageView();
        $this->displayPage();
    }

    function displayPage() {
        echo $this->view->displayPage();
    }

}