<?php
class User{
    private $pk_id;
    private $firstname;
    private $lastname;
    private $fk_role;


    function __construct($pk_id, $lastname, $firstname,  $role)
    {
        $this->pk_id = $pk_id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->fk_role = $role;
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