<?php
class ChatroomController {
    private $view;
   
    function __construct(){ 
        $this->view = new ChatroomView();
        $this->displayPage();

    }

    function displayPage() {
        echo $this->view->displayPage();
    }


}