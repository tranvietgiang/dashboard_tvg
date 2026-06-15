<?php

$router->get('/', function () {
    $title = 'Login';
    require __DIR__ . '/../app/view/login.php';
});

$router->get('/login', function () {
    $title = 'Login';
    require __DIR__ . '/../app/view/login.php';
});

$router->get('/dashboard', function () {
    $title = 'Dashboard';
    require __DIR__ . '/../app/view/home.php';
});

$router->get('/duan', function () {
    $title = 'Du an';
    require __DIR__ . '/../app/view/duan.php';
});

$router->get(apiRoute('/csrf-token'), function () {
    Response::json([
        'success' => true,
        'csrf_token' => CsrfMiddleware::token()
    ]);
});

$router->post(apiRoute('/login'), 'AuthController@login');

$router->get(apiRoute('/profile'), function () {
    $user = AuthMiddleware::check();

    Response::json([
        'success' => true,
        'message' => 'Lấy profile thành công',
        'data' => $user
    ]);
});

$router->get(apiRoute('/dashboard-stats'), function () {
    $user = AuthMiddleware::check();
    $userModel = new User();

    Response::json([
        'success' => true,
        'data' => $userModel->dashboardStats((int) $user['user_id'])
    ]);
});
