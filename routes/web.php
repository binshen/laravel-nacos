<?php

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

use alibaba\nacos\request\naming\ListInstanceNaming;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/v1/test', "Api\ApiController@index");

Route::get('/v1/api', function (Request $request) {

    \alibaba\nacos\NacosConfig::setHost("http://127.0.0.1:8848/");

    $listInstanceDiscovery = new \alibaba\nacos\request\naming\ListInstanceNaming();
    $listInstanceDiscovery->setServiceName("laravel-nacos-service");
    $listInstanceDiscovery->setNamespaceId("public");
    $listInstanceDiscovery->setClusters("");
    $listInstanceDiscovery->setHealthyOnly(false);

    $response = $listInstanceDiscovery->doRequest();
    $content = $response->getBody()->getContents();
//    var_dump($content);
    $hosts = json_decode($content)->hosts;
    $data = [
        "db" => env("DB_DATABASE"),
        "hosts" => $hosts
    ];
    return response()->json($data, 200);
});
