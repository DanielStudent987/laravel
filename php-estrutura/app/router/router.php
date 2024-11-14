<?php
//recebe as rotas de routes.php
function routers() {
    return require 'routes.php';
}

//verifica quais rotas batem com a descricao de routes.php
//URI estatica
function exactMatchUriInArrayRoutes($uri, $routes) {
    if(array_key_exists($uri, $routes)) {
        //uri chamando routes no indice uri
        return [$uri => $routes[$uri]];
        //return [];
    }

    return [];
}

//Pega, dinamicamente, a uri correta de acordo com as rotas e retora em um array
 //Dinamica
function regularExpressionMatachArrayRoutes($uri, $routes) {
    return array_filter(
        //array_keys($routes)
        ///user/4
        $routes,
        function ($value) use($uri) {
            $regex = str_replace('/', '\/', ltrim($value, '/'));
            return preg_match("/^$regex$/", ltrim($uri, '/'));
            
        },
        ARRAY_FILTER_USE_KEY
    );

}

//Caso uri seja vazia ele vai verificar e obter uma rota ou parametros da rota
function params ($uri, $matchedUri) {
    if (!empty($matchedUri)) {
        //retorna uma array que na posicao 0 tem os dados que queremos
        $matchedtoGetParams = array_keys($matchedUri)[0];
        return array_diff(
            explode('/', ltrim($uri, '/')),
            explode('/', ltrim($matchedtoGetParams, '/'))
        ); 
        
    }

    return [];
    
}

//Formata a URI para alterar os indexs para o nome da var
function paramsFormat($uri, $params) {
    $uri = explode("/", ltrim($uri, "/"));
    $paramsData = [];
    foreach ($params as $index => $param) {
        $paramsData[$uri[$index-1]] = $param;
                
    }

    return $paramsData;
}

//Pega a uri gerada no processo
function router() {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
    $routes = routers();

    //Exemplo mostrando como usar um array diff
    /*$arr1 = [
        'user', '1', 'name', 'daniel'
    ];
    $arr2 = [
        'user', '[0-9]+', 'name', ''
    ];

    var_dump(array_diff($arr1, $arr2));
    die();*/

    $matchedUri = exactMatchUriInArrayRoutes($uri, $routes);

    //caso $matchedUri for vazia ele entra aqui
    if(empty($matchedUri)){
        $matchedUri = regularExpressionMatachArrayRoutes($uri, $routes);

        if (!empty($matchedUri)) {
            $params = params($uri, $matchedUri);
            $params = paramsFormat($uri, $params);
            
            var_dump($params);
            die();
        }        
    }
    
    var_dump($matchedUri);
    die();
    
}