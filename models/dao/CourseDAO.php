<?php
class CourseDAO extends DAO{

    protected $table;
    protected $properties;

    function __construct()
    {
        parent::__construct();
        $this->table = "courses";
        $this->properties = ['pk_id','courseName','description','beginAt','fk_teacher','fk_module'];
    }



    public function create($data){
        return new Course(
            $data['pk_id'],
            $data['courseName'],
            $data['description'],
            $data['beginAt'],
            $data['fk_teacher'],
            $data['fk_module']
            
        );
    }

    public function createBis($data){
        return new Course(
            $data['pk_id'],
            $data['courseName'],
            $data['description'],
            $data['beginAt'],
            $data['fk_teacher'],
            $data['fk_module']
            
        );
    }



    public function fetchById($pk_id){
        try{
            $whereClause = $this->table . ".pk_id = ?";
            $stmt = $this->connection->prepare("SELECT courses.beginAt, courses.courseName, courses.description, modules.name, users.lastname 
                                                    FROM {$this->table} 
                                                    JOIN modules
                                                    ON fk_module = modules.pk_id 
                                                    JOIN users
                                                    ON fk_teacher = users.pk_id
                                                    WHERE {$whereClause}");
            
            $stmt->execute([$pk_id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result;

        }catch(PDOException $ex){
            $ex->getMessage();
        }
    }

   

    public function fetchAllz()
    {
        try {
            $statement = $this->connection->prepare("SELECT courses.pk_id,courses.courseName,courses.description,courses.beginAt,users.lastname,modules.name 
                                                        FROM {$this->table} 
                                                        JOIN modules
                                                        ON fk_module = modules.pk_id 
                                                        JOIN users
                                                        ON fk_teacher = users.pk_id ");
            
            
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($results);
            foreach($results as $data) {
                array_push($this->object_list, $this->createBis($data));            //can do better
            }
            
            var_dump($results);
            return $this->object_list;
            
        } catch (PDOException $e) {
            print $e->getMessage();
        } 
    }

}

