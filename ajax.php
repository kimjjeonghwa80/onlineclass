<?php
spl_autoload_register(function($class) {
    if($class == "Router") {
        include "router/Router.php";
    } else if (strpos($class, "Controller")) {
        include "controllers/{$class}.php";
    } else if (strpos($class, "View")) {
        include "views/{$class}.php";
    } else if (strpos($class, "Behaviour")) {
        include "models/dao/{$class}.php";
    } else if (strpos($class, "DAO") || strpos($class, "DAO") === 0) {
        include "models/dao/{$class}.php";
    } else {
        include "models/entities/{$class}.php";
    }
});



//Try to register...";
if(isset($_POST) && isset($_POST['pk_id'], $_POST['lastname'],$_POST['firstname'],$_POST['email'],$_POST['password'],$_POST['fk_role'])){
    
    $pwd = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //var_dump($pwd);

    $userPremise = array(
        "pk_id"         => $_POST['pk_id'],
        "lastname"      => $_POST['lastname'],
        "firstname"     => $_POST['firstname'],
        "email"         => $_POST['email'],
        "password"      => $pwd,
        "fk_role"       => $_POST['fk_role'],
        "session_token" => 0,
        "session_time"  => 0
    );

    
    $user = new UserDAO();
    $user->save($userPremise);
}

/** Login verify */
if(isset($_POST) && isset($_POST['login'], $_POST['password'])){
    //TODO cleaning

    $user = new UserDAO();
    $user = $user->verify($_POST['login'], $_POST['password']);

    if($user){

        $isTeacher = $user->isTeacher();
        $arr = array("success" => true, "isTeacher" => $isTeacher);
        echo json_encode($arr);

    }else{
        $response = array("success" => false);
        echo json_encode($response);                    //to clean
        throw new Exception(json_encode($response));
    
    }
}

if(isset($_GET) && isset($_GET['allcourses'])){
    
    $courses = new CourseDAO();
    $arr = array();
    $arr = $courses->fetchAll();

    //var_dump($arr);
    $response = json_encode($arr);
    echo $response;

}

if(isset($_POST) && isset($_POST['byRole'])){
    $teacher = new UserDAO();
    $arr = array();
    $arr = $teacher->fetchByRole($_POST['byRole']);

    //var_dump(gettype($arr[0]));

    $response = json_encode($arr, true);
    echo $response;
}
