
<?php

// Cargar URL base
require_once __DIR__ . '/../config/dataRoot.php';

// Obtener la URL solicitada
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Eliminar directorio base del proyecto
$basePath = parse_url(BASE_URL, PHP_URL_PATH);
$basePath = rtrim($basePath ?? '/', '/');

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
// ENRUTADOR
// =====================================================

switch ($url) {

    case '':
        require_once __DIR__ . '/../core/views/home.php';
        break;

    case 'productos':
        require_once __DIR__ . '/../core/views/productos.php';
        break;

    case 'contacto':
        require_once __DIR__ . '/../core/views/contacto.php';
        break;

    // =================================================
    // MANEJO DE ERRORES
    // =================================================

    default:

        // Detectar código HTTP actual
        $error = http_response_code();

        // Si no hay un error definido, asignar 404
        if ($error === false || $error < 400) {
            $error = 404;
        }
        
        // Mostrar página de error correspondiente
        switch ($error) {

            case 403:
                http_response_code(403);
                require __DIR__ . '/../errors/error/403.php';
                break;

            case 404:
                http_response_code(404);
                require __DIR__ . '/../errors/error/404.php';
                break;

            case 500:
                http_response_code(500);
                require __DIR__ . '/../errors/error/500.php';
                break;

            case 503:
                http_response_code(503);
                require __DIR__ . '/../errors/error/503.php';
                break;

            default:
                http_response_code(500);
                require __DIR__ . '/../errors/error/500.php';
                break;
        }

        exit;
}
