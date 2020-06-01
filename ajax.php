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



//echo "Try to register...";
var_dump($_POST);

if(isset($_POST) && isset($_POST['pk_id'], $_POST['lastname'],$_POST['firstname'],$_POST['email'],$_POST['password'],$_POST['fk_role'])){
    echo "try to register";

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

if(isset($_POST) && isset($_POST['login'], $_POST['password'])){
    //echo "receive login post ... ";

    $user = new UserDAO();
    $user = $user->verify($_POST['login'], $_POST['password']);

    if($user){
        //echo "loggin success ...";
        $test = array(
            "user" => "bruce"
        );
        echo json_encode($test);

    }else{
        $response = array("success" => false);
        echo json_encode($response);
        throw new Exception(json_encode($response));
    
    }
}

//echo "<pre>";

            // $data['pk_id'],
            // $data['lastname'],
            // $data['firstname'],
            // $data['email'],
            // $data['password'],
            // $data['fk_role']