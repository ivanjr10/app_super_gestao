<?php

use App\Http\Middleware\LogAcessoMiddleware;
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

// Route::get('/', function () {
//     return 'Olá, seja bem vindo ao curso!';
// });

// Route::get('/sobre-nos', function () {
//     return 'Sobre nos!';
// });

// Route::get('/contato', function () {
//     return 'Contato!';
// });

//Caso fosse chamar o middleware diretamente pela rota
// Route::middleware(LogAcessoMiddleware::class)
//     ->get('/', 'PrincipalController@principal')
//     ->name('site.index');

Route::get('/', 'PrincipalController@principal')->name('site.index');
Route::get('/sobre-nos', 'SobreNosController@sobreNos')->name('site.sobrenos');
Route::get('/contato', 'ContatoController@contato')->name('site.contato');
Route::post('/contato', 'ContatoController@salvar')->name('site.contato');
Route::get('/login{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

// Prefix serve para agrupar rotas e separalas por exemplo parte publica e parte privada do app
Route::middleware('autenticacao:padrao,visitante,p2,p3')->prefix('/app')->group(function(){
    Route::get('/home', 'homeController@index')->name('app.home');
    Route::get('/sair', 'LoginController@sair')->name('app.sair');
    Route::get('/cliente', 'ClienteController@index')->name('app.cliente');

    Route::get('/fornecedor', 'FornecedorController@index')->name('app.fornecedor');
    Route::get('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::post('/fornecedor/listar', 'FornecedorController@listar')->name('app.fornecedor.listar');
    Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar')->name('app.fornecedor.adicionar');
    Route::get('/fornecedor/editar/{id}/{msg?}', 'FornecedorController@editar')->name('app.fornecedor.editar');
    Route::get('/fornecedor/excluir/{id}', 'FornecedorController@excluir')->name('app.fornecedor.excluir');
    
    //produtos
    Route::resource('produto', 'ProdutoController');
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('teste');

//Fallback: Caso acesse alguma rota que nao existe, retorna uma pagina personalizada
Route::fallback(function(){
    echo 'A rota acessada nao existe. <a href="'.route('site.index').'"> Clique aqui </a>';
});


// Paramentros opcionais - ? 

// Obs: Caso tenha multiplos parametros opcianais, 
// necessarios que eles fiquem por ultimo, para que o laravel
// entenda a ordem dos parametros obrigatorios 
// ex: ORDEM CERTA//'contato/{nome}/{categoria}/{assunto?}/{mensagem?}', 
//     ORDEM ERRADA //'contato/{nome?}/{categoria}/{assunto}/{mensagem?}',
// Route::get(
//     'contato/{nome}/{categoria}/{assunto}/{mensagem?}', 
//     function(string $nome, string $categoria, string $assunto, string $mensagem = 'mensagem nao informada') {
//         echo "estamos aqui: $nome - $categoria - $assunto - $mensagem";
//     }
// );



// A rota a seguir so sera aceita caso a condição em where seja aceita, caso contrario 
//o framework nao acha essa rota, como se ela nao existisse 
// Route::get(
//     'contato/{nome}/{categoria_id}', 
//     function(
//         string $nome = 'Desconhecido', 
//         int $categoria_id = 1
//     ) {
//         echo "estamos aqui: $nome - $categoria_id";
//     }
// )->where('categoria_id', '[0-9]+')->where('nome', '[A-Za-z]+');

// LISTAR ROTAS : php artisan route:list
