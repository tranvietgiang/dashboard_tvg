<?php

$router->get('/', function () {
    $title = 'Login';
    require __DIR__ . '/../app/view/login.php';
});

$router->get('/login', function () {
    $title = 'Login';
    require __DIR__ . '/../app/view/login.php';
});

$router->get('/api/csrf-token', function () {
    Response::json([
        'success' => true,
        'csrf_token' => CsrfMiddleware::token()
    ]);
});

$router->post('/api/login', 'AuthController@login');

$router->get('/api/profile', function () {
    $user = AuthMiddleware::check();

    Response::json([
        'success' => true,
        'message' => 'Lấy profile thành công',
        'data' => $user
    ]);
});
