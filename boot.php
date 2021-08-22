<?php
// configurações
require_once __DIR__.'/config.php';
// database
if ( file_exists(__DIR__ . '/app/databases/' . DATABASE . '.php') ) {
    require_once __DIR__ . '/app/databases/' . DATABASE . '.php';
} else {
    $resp = array( 'error' => 'O banco "' . DATABASE. "' coonfigurado não foi implementado");
    echo json_encode($resp);
    http_response_code(500);
    die;
}
// módulos do composer
require_once __DIR__.'/vendor/autoload.php';
// inclui funções
$incDir = __DIR__ . '/app/inc/';
$incFiles = array_diff(scandir($incDir), array('..', '.'));
foreach ($incFiles as $file) {
    if (file_exists($incDir . $file) ) {
        require_once $incDir . $file;
    }
}
// models
$modelsDir = __DIR__ . '/app/models/';
$modelsFiles = array_diff(scandir($modelsDir), array('..', '.'));
foreach ($modelsFiles as $file) {
    if (file_exists($modelsDir . $file) ) {
        require_once $modelsDir . $file;
    }
}
require_once __DIR__.'/app/models/Users.php';
