<?php

/*
 * $_GET['url'] - after question mark in your url address - home/index
 * explode - separates url (home/index) into two separate strings - home and index
 * $url[0] - home
 * $url[1] - index
 */
session_start();
require('config.php');
function config($item){
    global $config;
    return $config[$item];
}

//TODO: security
/*if(empty($_GET['url'])){
    $_GET['url'] = 'home/index';
}*/
if($_SERVER['REQUEST_URI'] == '/'){
    $_SERVER['REQUEST_URI'] = '/home/index';
}
$url = explode('/', $_SERVER['REQUEST_URI']);
unset($url[0]);
spl_autoload_register(function ($class) { // include physical files of the class.
    if(file_exists('controllers/' . $class . '.php')){
        include 'controllers/' . $class . '.php';
    }elseif(file_exists('models/' . $class . '.php')){
        include 'models/' . $class . '.php';
    }
});
$controller = ucwords($url[1]).'Controller';
$_controller = new $controller(); // initiates class(HomeController) using spl_autoload_register function above.
unset($url[1]);
$method = $url[2];
unset($url[2]);
call_user_func_array([$_controller, $method], array_values($url));
