<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="app-url" content="<?= XssMiddleware::escape(APP_URL) ?>">
    <meta name="api-base-url" content="<?= XssMiddleware::escape(apiUrl()) ?>">

    <link rel="stylesheet" href="<?= XssMiddleware::escape(appUrl('/assets/css/app.css')) ?>">
    <link rel="stylesheet" href="<?= XssMiddleware::escape(appUrl('/assets/css/dashboard.css')) ?>">

    <title><?= XssMiddleware::escape($title ?? 'Dashboard') ?></title>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
