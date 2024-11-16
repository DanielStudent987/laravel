<?php

use PhpParser\Node\Stmt\TryCatch;

require("../vendor/autoload.php");
require("bootstrap.php");


try {
    //echo TESTE;
    $data = router();

    //Vai transforma o indice em uma variavel
    extract($data['data']);

    //Verifica se a 'view' existe no $data
    if (!isset($data['view'])) {
        throw new Exception("Esse indice view esta faltando");
    }

    if(!file_exists(VIEWS.$data['view'])){
        throw new Exception("Essa view {$data['view']} nao existe");
    }

    //Apos todas as verificacoes definimos $view igual ao valor de $data
    $view = $data['view'];

    //permite chamar as views no diretorio especificado
    require VIEWS.'/master.view.php';
} catch (Exception $e) {
    var_dump($e->getMessage());
        
}

