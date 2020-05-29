<?php

class Router {
    private $get;
    private $post;
    private $route;
    private $root;
    private $controller_list;
    private $controller;
    private $controller_name;
    
    function __construct($get, $post, $self, $url) {
        $this->get = $get;
        $this->post = $post;
        $this->controller_list = ['index', 'login'];
        $this->controller_name = false;
        $this->controller = false;
        $this->root = $this->parseRoot($self);
        //$this->root = "/";
        $this->route = $this->parseURL($url);
        $this->run();

        //var_dump("self : ", $self);
        //var_dump("url : ", $url);
        //var_dump($_SERVER['PHP_SELF']);                     //   /login.php
    }
    
    private function parseRoot($self) {
        return str_replace('index.php', '', $self);
        //return "/";
    }
    
    private function parseURL($url) {
        var_dump("url : ", $url);                         //         $url = /login.php
        //var_dump("root : ", $this->root);                 //         $this->root = /
        $path = str_replace($this->root, '', $url);         //         $path = "" (login.php)
        //$path = $url;
        

        $path = explode('/', $path);
        
        //var_dump($path);
        
        if($path && $path[0]) {
            $path[0]=substr($path[0],0,strpos($path[0],"?"));
            
        }
        
        
        
        $controller = false;
        if($path && count($path) && strlen($path[0])) {
            $controller = $path[0];
            //
            
        } else if(count($path) && !strlen($path[0])) {
            $controller = 'index';
            //var_dump("TRUE");
        }
        //var_dump($controller);
        if($controller && in_array($controller, $this->controller_list)) {
            $this->controller_name = ucfirst($controller.'Controller');
        } else {
            $this->controller_name = "IndexController"; //marche pas (renvoie 404 quand on met une mauvaise URL)
        } 
        //nettoyer le path pour n'y laisser que ce qui est important
        //return $path[3];

        //var_dump($path); //is empty !!
        var_dump($this->$controller_name);
        return $path;
        
    }
    
    private function run() {
        if($this->controller_name) {
            $this->controller = new $this->controller_name($this->get, $this->post, $this->route);
        }
    }
}