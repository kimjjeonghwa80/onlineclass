<?php
class EditCourseController {
    private $view;
   
    function __construct(){ 
        $this->view = new EditCoursePageView();
        $this->displayPage();

    }

    function displayPage() {
        echo $this->view->displayPage();
    }


}