<?php

//retorna as rotas dos indices da url
//user/5
return [
    '/' => 'Home@index',
    '/user/create' => 'User@create',
    '/user/[a-z0-9]+' => 'User@show',
    '/user/[0-9]+/name/[a-z]+' => 'User@create'
];