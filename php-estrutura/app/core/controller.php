<?php

function controller ($matchedUri, $params) {
    //list() oculto
    //Home@Index example
    //De alguma maneira isso consegue executar uma classe global chamada no autoload e executa os metodos 
    [$controller, $method] = $controller = explode("@", array_values($matchedUri)[0]);
    $controllerWithNamespace = CONTROLLER_PATH.$controller;
    if (!class_exists($controllerWithNamespace)) {
        throw new Exception("Controller {$controller} nao existe");
    } 
    
    $controllerInstance = new $controllerWithNamespace;

    //Verifica se o metodo da class Controller existe
    if(!method_exists($controllerInstance, $method)) {
        throw new Exception("Method {$method} nao existe no Controller {$controller}");
    }

    return $controllerInstance->$method($params);
    
}

