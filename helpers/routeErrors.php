<?php

// =====================================================
// OBTENER CÓDIGO DE ERROR
// =====================================================

$code = isset($_GET['code'])
    ? (int) $_GET['code']
    : 200;


// =====================================================
// VALIDAR Y ESTABLECER CÓDIGO HTTP
// =====================================================

$allowedErrors = [403, 404, 418, 500, 502];

if ($code >= 400 && !in_array($code, $allowedErrors, true)) {
    $code = 500;
}

http_response_code($code);


// =====================================================
// ENRUTADOR DE ERRORES
// =====================================================

$error = http_response_code();

if ($error >= 400) {

    switch ($error) {

        case 403:
            require __DIR__ . '/../errors/error/403.php';
            break;

        case 404:
            require __DIR__ . '/../errors/error/404.php';
            break;

        case 418:
            require __DIR__ . '/../errors/error/418.php';
            break;

        case 500:
            require __DIR__ . '/../errors/error/500.php';
            break;

        case 502:
            require __DIR__ . '/../errors/error/502.php';
            break;
    }

    exit;
}