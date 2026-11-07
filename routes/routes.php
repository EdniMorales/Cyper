
<?php

// Cargar URL base
require_once __DIR__ . '/../config/dataRoot.php';

// Obtener la URL solicitada
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

// Obtener directorio base del proyecto
$basePath = parse_url(BASE_URL, PHP_URL_PATH) ?? '';
$basePath = rtrim($basePath, '/');

// Eliminar directorio base
if ($basePath !== '' && $basePath !== '/') {
    $url = preg_replace(
        '#^' . preg_quote($basePath, '#') . '(?=/|$)#',
        '',
        $url
    );
}

// Limpiar URL
$url = trim($url, '/');

// Obtener método HTTP
$method = $_SERVER['REQUEST_METHOD'];


// =====================================================
// MANEJO DE ERRORES
// =====================================================
//! Test de errores
$testError = null;

// Detectar código HTTP actual
$error = $testError ?? http_response_code();

// Mostrar página de error correspondiente
if ($error >= 400) {
    http_response_code($error);

    switch ($error) {

        case 403:
            http_response_code(403);
            require __DIR__ . '/../errors/error/403.php';
            break;

        case 404:
            http_response_code(404);
            require __DIR__ . '/../errors/error/404.php';
            break;

        case 418:
            http_response_code(418);
            require __DIR__ . '/../errors/error/418.php';
            break;

        case 500:
            http_response_code(500);
            require __DIR__ . '/../errors/error/500.php';
            break;

        case 502:
            http_response_code(502);
            require __DIR__ . '/../errors/error/502.php';
            break;

        default:
            http_response_code(500);
            require __DIR__ . '/../errors/error/500.php';
            break;
    }
    exit;
}


// =====================================================
// ENRUTADOR
// =====================================================

switch ($url) {

    case '':
        require_once __DIR__ . '/../core/views/login/login.html';
        break;

    case 'home':
        require_once __DIR__ . '/../core/views/dashboard/main.html';
        break;

    case 'contacto':
        require_once __DIR__ . '/../core/views/contacto.php';
        break;

    // =================================================
    // MANEJO DE ERRORES
    // =================================================

    default:
        require __DIR__ . '/../errors/lost/errorLostRoute.php';
        exit;
}
