<?php
class Course{                                           
    public $pk_id;
    public $courseName;
    public $description;
    public $beginAt;
    public $fk_teacher;
    public $fk_module;

    /** public visibility because needed for json_encode and  XmlHttpRequest */

    public function __construct($pk_id, $courseName, $description, $beginAt, 
                                                            $fk_teacher, $fk_module)
    {
        $this->pk_id        = $pk_id;
        $this->courseName   = $courseName;
        $this->description  = $description;
        $this->beginAt      = $beginAt;
        $this->fk_teacher   = $fk_teacher;
        $this->fk_modules   = $fk_module;
    }

    function __get($property) {
        if (property_exists($this, $property)) {
			return $this->$property;
		}
    }
    
    function __set($property, $value) {
        if (property_exists($this, $property) && $property == "deleteBehaviour") {
			$this->deleteBehaviour = new $value();
           // $this->deleteBehaviour = new HardDeleteBehaviour();
		} else if (property_exists($this, $property)) {
			$this->$property = $value;
		}
    }
}