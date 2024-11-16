<?php

namespace app\controllers;

class Home 
{
    public function index($params) {
        //Retorna os indices das views para serem chamadas no programa
        //Permite chamar os valores atribuidos aqui nas views pelo Extract
        return [
            'view' => 'home.php',
            'data' => ['name' => 'alexandre']
        ];
    }
}