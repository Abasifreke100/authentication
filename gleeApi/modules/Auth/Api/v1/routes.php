<?php


use Glee\Modules\Auth\Api\v1\Controllers\AuthController;

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {

    $api->group(['prefix'=>"auth"], function () use ($api){

        $api->post('login', [AuthController::class, 'login']);
        $api->post('logout', [AuthController::class, 'logout']);



    });

});
