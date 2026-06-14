<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/css/app.css">

    <title><?= XssMiddleware::escape($title ?? 'Dashboard') ?></title>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
