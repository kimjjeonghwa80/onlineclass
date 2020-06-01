<?php
class LoginController {
    private $view;

    function __construct(){
        //var_dump("Controller Login");
        $this->view = new LoginPageView();
        $this->displayPage();
    }

    function displayPage() {
        echo $this->view->displayPage();
    }

}