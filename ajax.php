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

echo "try to register";
if(isset($_POST) && isset($_POST['register'])){
    echo "try to register";
}

echo "<pre>";
var_dump($_GET);