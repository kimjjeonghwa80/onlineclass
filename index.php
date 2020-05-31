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

$router = new Router($_GET, $_POST, $_SERVER['PHP_SELF'], $_SERVER['REQUEST_URI']);


echo "<pre>";
//var_dump($router);
// $user = new UserDAO();
// $user->save(
//         [
//             'pk_id'     => 5,
//             'lastname'  => "Vandamme",
//             'firstname' => "Jean-Claude",
//             'email'     => "jean@claude",
//             'password'  => "132456",
//             'fk_role'   => 1
//         ]
//     );
//var_dump($user);


// $data['pk_id'],
// $data['lastname'],
// $data['firstname'],
// $data['email'],
// $data['password'],
// $data['fk_role']