<?php
abstract class DAO {
    protected $deleteBehaviour;
    protected $object_list;
    protected $connection;
    
    function __construct() {
        $this->connection = new PDO('mysql:host=localhost;dbname=onlineclass', 'root', 'root');
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->object_list = array();
    }
    
    //CRUD done !
    
    function fetchById($pk_id){
        try{
            $stmt = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk_id = ?");
            $stmt->execute([$pk_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result;

        }catch(PDOException $ex){
            $ex->getMessage();
        }
    }
    
    function fetchAll(){
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $data) {
                array_push($this->object_list, $this->create($data));
            }
            
            return $this->object_list;
            
        } catch (PDOException $e) {
            print $e->getMessage();
        } 
    }

    function delete($pk) {
        try {
            $statement = $this->connection->prepare("DELETE FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    //"UPDATE table SET lastname='Doe' WHERE id=2";
    function update($data){
        $object = $this->create($data);
        if($object){
            $qry = "SET ";
            
            foreach($this->properties as $property){
                if($property !== 'pk_id'){
                    $qry .= $property . ' = ';
                    $qry .= $$object->__get($property);
                    $qry .= ',' ;
                }
            }

            $qry = rtrim($qry, ",");
            $qry = "UPDATE {$this->table} {$qry} WHERE pk_id = ?"; 

            try {
                $statement = $this->connection->prepare($qry);
                $statement->execute([$data['pk_id']]);
            } catch(PDOException $e) {
                print $e->getMessage();
            }

        }
    }

    function save($data) {
        $object = $this->create($data);                 // create
        //var_dump("User object: ", $object);
        if ($object) {
            $qry = "(";
            $values = array();
            
            foreach($this->properties as $property) {
                //var_dump($property);
                if($property !== 'pk_id') {
                    $qry.= $property.','; 
                    array_push($values, $object->__get($property));
                }
            }

            $qry = rtrim($qry, ",");
            $qry.=')';
            /** adjust automaticly the numbers of parameters of the corresponding object */
            $params = "(" .str_repeat("?," , count($data) -1 );
            $params = rtrim($params, ",");
            $params .= ")";

            $qry = "INSERT INTO {$this->table}{$qry} VALUES {$params}";
            //var_dump($qry);


            try {
                $statement = $this->connection->prepare($qry);
                $statement->execute($values);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        } 
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