<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function() { return redirect()->route('login'); });

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/logar', 'LoginController@logar')->name('logar');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::get('/nova-senha', 'LoginController@recuperarSenha')->name('senha.recuperar');
Route::post('/nova-senha', 'LoginController@salvarNovaSenha')->name('senha.nova');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    //================ USUARIOS ============================//
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'UsuariosController@index')->name('usuarios.listar');
        Route::get('/novo', 'UsuariosController@novo')->name('usuarios.novo');
        Route::post('/cadastrar', 'UsuariosController@cadastrar')->name('usuarios.cadastrar');
        Route::get('/edicao/{id}', 'UsuariosController@edicao')->name('usuarios.edicao');
        Route::post('/editar/{id}', 'UsuariosController@editar')->name('usuarios.editar');
        Route::get('/excluir/{id?}', 'UsuariosController@excluir')->name('usuarios.excluir');
    });
    //================== LICITAÇÕES ==========================//
    Route::group(['prefix' => 'licitacoes'], function () {
        Route::get('/', 'LicitacoesController@index')->name('licitacao.listar');
        Route::get('/nova', 'LicitacoesController@nova')->name('licitacao.nova');
        Route::post('/cadastrar', 'LicitacoesController@cadastrar')->name('licitacao.cadastrar');
        Route::get('/edicao/{id}', 'LicitacoesController@edicao')->name('licitacao.edicao');
        Route::post('/editar/{id}', 'LicitacoesController@editar')->name('licitacao.editar');
        Route::get('/excluir/{id?}', 'LicitacoesController@excluir')->name('licitacao.excluir');
        Route::get('/pdf/{id}', 'LicitacoesController@pdf')->name('licitacao.pdf');

        Route::group(['prefix' => 'itens'], function () {
            Route::get('/{licitacaoID}/listar', 'ItensLicitacoesController@listar')->name('itens-licitacao.listar');
            Route::post('/{licitacaoID}/cadastrar', 'ItensLicitacoesController@cadastrar')->name('itens-licitacao.cadastrar');
            Route::post('/{licitacaoID}/atualizar-itens', 'ItensLicitacoesController@atualizar')->name('itens-licitacao.atualizar');
            Route::get('/{licitacaoID}/remover/{id?}', 'ItensLicitacoesController@remover')->name('itens-licitacao.remover');
            Route::get('/{licitacaoID}/gerenciar', 'ItensLicitacoesController@gerenciar')->name('itens-licitacao.gerenciar');
            Route::post('/{licitacaoID}/ajustar/{id?}', 'ItensLicitacoesController@ajustar')->name('itens-licitacao.ajustar');
        });
    });
    
    
    
});


