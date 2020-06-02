<?php
class ModuleDAO extends DAO{

    protected $table;
    protected $properties;                                      //protected because must accessible by parent DAO

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

    

}