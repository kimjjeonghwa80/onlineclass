<?php

class UserDAO extends DAO{

    protected $table;
    protected $properties;


    function __construct(){
        parent::__construct();
        $this->table = "users";
        $this->properties = ['pk_id', 'lastname','firstname','email','password','fk_role'];
    }


    function create($data){
        return new User(
            $data['pk_id'],
            $data['lastname'],
            $data['firstname'],
            $data['email'],
            $data['password'],
            $data['fk_role']
        );
    }

            // $data['pk_id'],
            // $data['lastname'],
            // $data['firstname'],
            // $data['email'],
            // $data['password'],
            // $data['fk_role']

    function save($data) {
        $data['pk_id'] = -1; 
        $object = $this->create($data);
        var_dump("User object: ", $object);
        if ($object) {
            $qry = "(";
            $values = array();
            $params = "(";
            
            foreach($this->properties as $property) {
                //var_dump($property);
                if($property !== 'pk_id') {
                    $qry.= $property.','; 
                    array_push($values, $object->__get($property));
                }
            }

            $qry = rtrim($qry, ",");
            $qry.=')';
            $qry = "INSERT INTO {$this->table}{$qry} VALUES (?, ?, ?, ?, ?)";
            //var_dump($qry);


            try {
                $statement = $this->connection->prepare($qry);
                $statement->execute($values);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        } 
    }

}