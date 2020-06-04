<?php
class EditCoursePageView{

    private $page;
    private $render;

    function __construct(){
        $this->page = false;
        $this->render = false;
    
    }

    function displayPage() {
        $this->generatePage();
        return $this->render;
    }

    function generatePage(){
        $this->page = $this->generateHeader();
        $this->page .= $this->generateForm(); // TODO
        $this->page .= $this->generateFooter();
        $this->render = $this->generateShell();
    }

    //This is the shell for personal page
    function generateForm() {
        ob_start();
            include 'views/templates/editForm.php';
        return ob_get_clean();
    }

    function generateShell() {
        ob_start();
            include 'views/templates/shell.php';
        return ob_get_clean();
    }

    function generateHeader() {
        ob_start();                                                                      
            include 'views/templates/header.php';
        return ob_get_clean();
    }
    
    function generateFooter() {
        ob_start();
            include 'views/templates/footer.php';
        return ob_get_clean();
    }

   
    function __get($property) {
        if (property_exists($this, $property)) {
			return $this->$property;
		}
    }
    
    function __set($property, $value) {
        if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }



}