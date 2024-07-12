<?php

$url = parse_url($_SERVER['REQUEST_URI'])['path'];
$urlPath = explode('/', $url);
$user_id = '';
if ((count($urlPath) > 2) && $urlPath[2] === 'feedback') {
    $user_id = $urlPath[1];
    urlValidate($user_id);
} elseif ((count($urlPath) > 2) && $urlPath[2] === 'feedback-success') {
    $user_id = $urlPath[1];
    urlValidate($user_id);
}

function urlValidate($user_id)
{
    $users = json_decode(file_get_contents('users.json'), true);
    $user = getUser($users, $user_id);
    if ($user == null) {
        abort();
    }
}


$routes = [
    '/' => 'home.php',
    '/dashboard' => 'dashboard.php',
    '/login' => 'login.php',
    '/register' => 'register.php',
    '/logout' => 'logout.php',
    '/' . $user_id . '/feedback' => 'feedback.php',
    '/feedback-success' => 'feedback-success.php',
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
