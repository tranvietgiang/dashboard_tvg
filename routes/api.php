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

function registerApiRoutes($router, $prefix)
{
    $prefix = '/' . trim($prefix, '/');

    $router->get($prefix . '/csrf-token', function () {
        Response::json([
            'success' => true,
            'csrf_token' => CsrfMiddleware::token()
        ]);
    });

    $router->post($prefix . '/login', 'AuthController@login');

    $router->get($prefix . '/profile', function () {
        $user = AuthMiddleware::check();

        Response::json([
            'success' => true,
            'message' => 'Lay profile thanh cong',
            'data' => $user
        ]);
    });

    $router->get($prefix . '/dashboard-stats', function () {
        $user = AuthMiddleware::check();
        $userModel = new User();

        Response::json([
            'success' => true,
            'data' => $userModel->dashboardStats((int) $user['user_id'])
        ]);
    });
}

foreach (array_unique([API_ROUTE_PREFIX, '/api', '/v1/api']) as $apiPrefix) {
    registerApiRoutes($router, $apiPrefix);
}
