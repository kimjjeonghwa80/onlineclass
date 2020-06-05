<?php
class Module implements JsonSerializable{ 
    private $pk_id;
    private $name;


    function __construct($pk_id, $name)
    {
        $this->pk_id = $pk_id;
        $this->name = $name;
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

    function jsonSerialize(){
        return [
                'pk_id'     => $this->__get('pk_id'),
                'name'      => $this->__get('name')
        ];
    }

}