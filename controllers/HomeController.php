<?php
class HomeController {
    private $view;

    function __construct(){
        //var_dump("Personal Page");
        $this->view = new HomeView();
        $this->displayPage();

    }

    function displayPage() {
        echo $this->view->displayPage();
    }

}