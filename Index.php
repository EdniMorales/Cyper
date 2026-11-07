<?php

// =====================================================
// INICIALIZACIÓN DEL SISTEMA
// =====================================================

// Configuración de URL base
require_once __DIR__ . '/config/dataRoot.php';

// Configuración general
require_once __DIR__ . '/config/resourses.php';

// Herramientas generales
require_once __DIR__ . '/helpers/tools.php';


// =====================================================
// ENRUTADOR PRINCIPAL
// =====================================================

require_once __DIR__ . '/routes/routes.php';

exit;