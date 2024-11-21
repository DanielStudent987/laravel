<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// STRINGS E CONTROLLERS: OUTRA MANEIRA DE SE TRABALHAR EH COM STRINGS NAS ROTAS, PARA TAL PRECISAMOS DO CONTROLLER EM 
// Jeito Normal -> Route::get('/', HomeController::class."@index");
//Com array
Route::get('/', [HomeController::class,"index"])->name('home');

//REQUISICAO QUE ACEITA GET E POST
Route::match(['get', 'post'], 'user/test', function () {
    dd('teste com dois tipos de requisicoes');
});

Route::get('/user/{name}/age/{age}', function ($id, $age) {
    dd('user: '.$id.' age:'.$age);
})->where('name', '[a-z\-]+')->whereNumber('age');

//where(['name' => '[a-z]+', 'age' => '[0-9]+']);

//Caso de Adicionar uma funcionalidade no site agrupamento
Route::group( ['prefix' => 'blog'], function () {
    Route::get('/', function() {
        dd('blog');
    });

    Route::get('/post/{slug}', function($slug) {
        dd($slug);
    });

    Route::get('/personal', function() {
        dd('personal');
    });

});

//Adicionar nomes para as rotas
Route::get('/contact', function() {
    dd(route('contact'));
})->name('contact');
    
//cria secçoes
Route::prefix('admin')->group(function () {
    Route::get('/', function() {
        dd('admin');
    });
});


/* EXISTE ESSA FORMA DE SE TRABALHAR, LEMBRE-SE DE REMOVER OS EXCEPT DO VERIFYCSRFTOKEN = TRUE
TRUE TO AINDA NAO FEITO
//Route = class; get=static method
Route::get('/', function () {
    dd('home');
    //return view('welcome');
});


Route::get('/contato', function () {
    dd('contato');
    //return view('welcome');
});

Route::post("/create/user" , function () {
    dd('create');
    //return view('welcome');
});

Route::put("/update/user" , function () {
    dd('update');
    //return view('welcome');
});

Route::delete("/delete/user" , function () {
    dd('delete');
    //return view('welcome');
}); */