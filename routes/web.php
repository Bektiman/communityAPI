<?php
use Illuminate\Support\Facades\DB;
/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/coba', function ()
{
    return 'hallo';
});

$router->get('/user/{id}', function ($id){
    return ' User ID ='.$id;
});

// $router->get('/post/{postId}/comment/{comID}', function ($postId,$comID){
//     return 'post ID ='.$postId . ' CommentsID='.$comID;

// });

// $router->get('/user[/{id}]', function ($id=null){
//     return ' User ID ='.$id;
// });
// $router->get('/aku[/{name}]', function ($name = null) {
//     return $name;
// });
$router->get('/cekdb', 'CobaController@show');
$router->get('organisasi/{jabid}[/nip/{nip}]','OrganisasiController@show');
//$router->get('kantor[/{kantorid}]','OrganisasiController@getKantor');
$router->get('pegawai/eselon1','OrganisasiController@getEselon1');
$router->get('pegawai/eselon2/{kantorid}[/{orgid}]','OrganisasiController@getEselon2');
$router->get('pegawai/eselon3/{kantorid}[/{orgid}]','OrganisasiController@getEselon3');
$router->get('pegawai/kantor/{kantorid}','KantorController@getPegawai');
$router->get('kantor/{namakantor}','KantorController@getKantor');
$router->post('kantor/','KantorController@getKantor');
$router->get('kantor/baru/{indeks}','KantorController@getPegawai');
// $router->get('/organisasi/{jabid}', function($jabid){

//     $query = "SELECT * FROM public.view_pegawai
//     WHERE jabid = '$jabid' AND pegshow = true
//     ORDER BY orgid";

//     return DB::select($query);
//     return $jabid;
// });
// $router->get('/organisasi/test', function(){

//     $query = "SELECT * FROM public.view_pegawai
//     LIMIT 100
//     ";

//     return DB::select($query);
// });

