<?php
class ModuleDAO extends DAO{

    protected $table;
    protected $properties;

    public function __construct(){
        parent::__construct();
        $this->table = "modules";
        $this->properties = ['pk_id','name'];

    }


    //CRUD

    public function create($data){
        return new Module(
            $data['pk_id'],
            $data['name']
        );
    }

    public function fetchById($pk_id){
        return $this->create(parent::fetchById($pk_id));
    }

    

}