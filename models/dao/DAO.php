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
    
    function delete($pk) {
       $this->deleteBehaviour->delete($pk);
    }
    
    function fetch($pk) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE pk = ?");
            $statement->execute([$pk]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            return $this->create($result);
            
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

   
    
    function save($data) {
        $data['pk'] = -1; 
        $object = $this->create($data);
        if ($object) {
            $qry = "(";
            $values = array();
            $params = "(";
            
            foreach($this->properties as $property) {
                if($property !== 'pk') {
                    $qry.= $property.','; 
                    array_push($values, $object->__get($property));
                }
            }

            $qry = rtrim($qry, ",");
            $qry.=')';
            $qry = "INSERT INTO {$this->table} {$qry} VALUES (?, ?, ?, ?, ?, ?)";
            
            try {
                $statement = $this->connection->prepare($qry);
                $statement->execute($values);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        } 
    }
    
    function fetchAll() {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table}");
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($results as $data) {
                //CREER UN NOUVEL OBJET
                //AJOUTE CET OBJET A NOTRE LISTE DE PRODUIT
                array_push($this->object_list, $this->create($data));
            }
            
            return $this->object_list;
            
        } catch (PDOException $e) {
            print $e->getMessage();
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