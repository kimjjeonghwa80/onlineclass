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
        $this->controller_list = ['index', 'login', 'register','ajax','home', 'editCourse'];
        $this->controller_name = false;
        $this->controller = false;
        $this->root = $this->parseRoot($self);
        $this->route = $this->parseURL($url);
        $this->run();

       
        
    }
    
    private function parseRoot($self) {
        return str_replace('index.php', '', $self);
        
    }


    /**
     * req = new array(
     *      url => value,
     *      param => value,
     *      parm_val => value
     * )
     */
    
    private function parseURL($url) {
        //var_dump("url : ", $url);                         //         $url = /login.php
        //var_dump("root : ", $this->root);                 //         $this->root = /
        $path = str_replace($this->root, '', $url);         //         $path = "" (login.php)
        //$path = $url;
        

        $path = explode('/', $path);
        
        
        
        if($path && $path[1]) {
            $path[0]=substr($path[0],0,strpos($path[0],"?"));
            //var_dump($path);
        }
        
        
        
        $controller = false;
        if($path && count($path) && strlen($path[1])) {
            $controller = $path[1];
            //var_dump("controller", $controller); //je ne rentre jamais ici !!
            
        } else if(count($path) && !strlen($path[0])) {
            $controller = 'index';
            //var_dump("TRUE");
        }
        //var_dump($controller);
        if($controller && in_array($controller, $this->controller_list)) {
            $this->controller_name = ucfirst($controller.'Controller');

           
        } 

        return $path;
        
    }
    
    private function run() {
        if($this->controller_name) {
            $this->controller = new $this->controller_name($this->get, $this->post, $this->route);
            //var_dump($this->controller);
        }
    }
}