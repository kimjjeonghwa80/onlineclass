<?php
class User{
    private $pk_id;
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $fk_role;


            // $data['pk_id'],
            // $data['lastname'],
            // $data['firstname'],
            // $data['email'],
            // $data['password'],
            // $data['fk_role']

    function __construct($pk_id, $lastname, $firstname, $email, $password, $role)
    {
        $this->pk_id        = $pk_id;
        $this->lastname     = $lastname;
        $this->firstname    = $firstname;
        $this->email        = $email;
        $this->password     = $password;
        $this->fk_role      = $role;
        //var_dump("User Object : ",$this);
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