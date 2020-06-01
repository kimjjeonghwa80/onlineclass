<?php

class UserDAO extends DAO{

    protected $table;
    protected $properties;


    function __construct(){
        parent::__construct();
        $this->table = "users";
        $this->properties = ['pk_id', 'lastname','firstname','email','password','fk_role','session_token','session_time'];
    }


    function create($data){
        return new User(
            $data['pk_id'],
            $data['lastname'],
            $data['firstname'],
            $data['email'],
            $data['password'],
            $data['fk_role'],
            $data['session_token'],
            $data['session_time']
        );
    }

    function save($data) {
        $data['pk_id']          = -1;
        $data['session_token']  =  0;
        $data['session_time']   =  0; 
        $object = $this->create($data);
        //var_dump("User object: ", $object);
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
            $qry = "INSERT INTO {$this->table}{$qry} VALUES (?, ?, ?, ?, ?, ?, ?)";
            //var_dump($qry);


            try {
                $statement = $this->connection->prepare($qry);
                $statement->execute($values);
            } catch(PDOException $e) {
                print $e->getMessage();
            }
        } 
    }

    function verify($email, $password) {
        try {
            $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE email = ?");
            $statement->execute([$email]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $user = $this->create($result);
            //var_dump($user);
            
            if(password_verify($password, $user->__get('password'))) {
                $this->getRandomToken($user);
                return $user;
            }
            //var_dump('failed password verify');
            return false;
        } catch (PDOException $e) {
           
            print $e->getMessage();
        }
    }
    
    function update($user) {
        try {
            $statement = $this->connection->prepare("UPDATE {$this->table} SET session_token = ?, session_time = ? WHERE pk_id = ?");
            $statement->execute([$user->__get('session_token'), $user->__get('session_time'), $user->__get('pk_id')]);
            //var_dump('user updated');
            //header('location:index.php');
        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }
    
    function fetchByCookie($cookie) {
        if($cookie) {
             try {
                $statement = $this->connection->prepare("SELECT * FROM {$this->table} WHERE session_token = ?");
                $statement->execute([$cookie]);
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $this->create($result);

            } catch (PDOException $e) {
                print $e->getMessage();
            }
        } 
        echo 'Nope';
        return false;
    }

    function getRandomToken($user) {
        $token = bin2hex(random_bytes(8)) . "." . time();
        $user->__set('session_token', $token);
        $user->__set('session_time', date('Y-m-d H:i:s'));
        setcookie('session_token', $token, time()+60*60*24);
        $this->update($user);
    }


}