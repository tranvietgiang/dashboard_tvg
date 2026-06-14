<?php

$router->post('/api/login', 'AuthController@login');

$router->get('/api/profile', function () {
    $user = AuthMiddleware::check();

    Response::json([
        'success' => true,
        'message' => 'Lấy profile thành công',
        'data' => $user
    ]);
});
