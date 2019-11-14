<?php
function resolve($route){
    //$path = (!empty($_SERVER["PATH_INFO"]) ? $_SERVER["PATH_INFO"] : "/"); 
      $path = $_SERVER["REQUEST_URI"] ?? '/';
      
    $route = '/^'.str_replace('/','\/',$route).'$/';
  
    if(preg_match($route,$path,$params)){
      return $params;
    }
    return false;
  }