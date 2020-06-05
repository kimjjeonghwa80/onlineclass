<?php
class User implements JsonSerializable{
    private $pk_id;
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $fk_role;
    private $session_token;
    private $session_time;




    function __construct($pk_id, $lastname, $firstname, $email, $password, $role, $session_token, $session_time)
    {
        $this->pk_id            = $pk_id;
        $this->lastname         = $lastname;
        $this->firstname        = $firstname;
        $this->email            = $email;
        $this->password         = $password;
        $this->fk_role          = $role;
        $this->session_token    = $session_token;
        $this->session_time     = $session_time;
        
    }

    function isTeacher(){
        return $this->fk_role == 1 ? true : false;
    }


    function jsonSerialize(){
        return [
                 'pk_id'           => $this->__get('pk_id'),
                 'firstname'       => $this->__get('firstname'),
                 'lastname'        => $this->__get('lastname'),    
                 'email'           => $this->__get('email'),
                 'fk_role'         => $this->__get('fk_role'),
                 'session_token'   => $this->__get('session_token'),
                 'session_time'    => $this->__get('session_time')
            ];
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