<?php

session_start();

use App\Controllers\AuthController;
use App\Controllers\OrderController;
use App\Controllers\UserController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Obtém a URI da requisição
$method = $_SERVER['REQUEST_METHOD']; // Obtém o método HTTP da requisição
$controller = null;
$id = null;

// Se não houver um usuário logado, redirecione para a página de login
if (!isset($_SESSION['user_id']) && $uri !== '/auth/login' && $uri !== '/auth/register') {
    header('Location: /auth/login');
    exit();
}

// Função para carregar views HTML/PHP
function loadView($path)
{
    if (file_exists($path)) {
        include $path;
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "View not found!";
    }
}

// Determina qual controlador e ID utilizar com base na URI
if (preg_match('/^\/users\/(\d+)$/', $uri, $matches)) {
    $controller = new UserController();
    $id = $matches[1];
} elseif (preg_match('/^\/users$/', $uri)) {
    $controller = new UserController();
} elseif (preg_match('/^\/orders\/(\d+)$/', $uri, $matches)) {
    $controller = new OrderController();
    $id = $matches[1];
} elseif (preg_match('/^\/orders$/', $uri)) {
    $controller = new OrderController();
} elseif (preg_match('/^\/auth$/', $uri)) {
    $controller = new AuthController();
}

// Executa a ação apropriada com base no método HTTP
if ($controller) {
    switch ($method) {
        case 'GET':
            if ($id !== null) {
                // Se um ID for fornecido, carregue a view de atualização
                if (strpos($uri, '/users/') === 0) {
                    loadView(__DIR__ . '/views/users/update.php');
                } elseif (strpos($uri, '/orders/') === 0) {
                    loadView(__DIR__ . '/views/orders/update.php');
                }
            } else {
                // Se não houver ID, carregue a view de criação ou listagem
                if ($uri === '/users') {
                    loadView(__DIR__ . '/views/users/create.php');
                } elseif ($uri === '/orders') {
                    loadView(__DIR__ . '/views/orders/create.php');
                } elseif ($uri === '/auth') {
                    loadView(__DIR__ . '/views/auth/login.php');
                }
            }
            break;
        case 'POST':
            if ($uri === '/users') {
                $controller->createUser($_POST);
            } elseif ($uri === '/orders') {
                $controller->createOrder($_POST);
            } elseif ($uri === '/auth') {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $user = $controller->login($email, $password); // Autenticação do usuário
                if ($user) {
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_name'] = $user->getFirstName();
                    header('Location: /');
                } else {
                    echo 'Falha na autenticação';
                }
            }
            break;
        case 'PUT':
            if ($uri === '/users') {
                $controller->updateUser($id, $_POST);
            } elseif ($uri === '/orders') {
                $controller->updateOrder($id, $_POST);
            }
            break;
        case 'DELETE':
            if ($uri === '/users') {
                $controller->deleteUser($id);
            } elseif ($uri === '/orders') {
                $controller->deleteOrder($id);
            }
            break;
        default:
            header("HTTP/1.1 405 Method Not Allowed");
            break;
    }
} else {
    // Carregar views de autenticação
    if ($uri === '/auth/login') {
        loadView(__DIR__ . '/views/auth/login.php');
    } elseif ($uri === '/auth/register') {
        loadView(__DIR__ . '/views/auth/register.php');
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "Page not found!";
    }
}
