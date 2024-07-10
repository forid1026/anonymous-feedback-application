<?php

$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'home.php',
    '/dashboard' => 'dashboard.php',
    '/login' => 'login.php',
    '/register' => 'register.php',
    '/feedback' => 'feedback.php',
    '/logout' => 'logout.php'
];


function routeToPage($url, $routes)
{
    if (array_key_exists($url, $routes)) {
        require $routes[$url];
    } else {
        abort();
    }
}


function abort($code = 404)
{
    http_response_code($code);
    require "{$code}.php";
    die();
}
routeToPage($url, $routes); 
