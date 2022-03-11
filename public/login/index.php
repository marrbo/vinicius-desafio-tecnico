<?php
use Models\Users;

require_once __DIR__.'/../../boot.php';

// recebendo get, bad request
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'get') == 0){
    $resp = array( 'error' => 'Este endpoint não recebe get');
    echo json_encode($resp);
    http_response_code(400);
    die;
}
// recebendo post verifica se existe usuário
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0){
    $data = json_decode(file_get_contents('php://input'), true);
    $authUser = Users::auth($data['email'], $data['password']);
    // se não foi encontrado usuário, não autorizado
    if($authUser){
        unset($authUser['password']); // removo a senha
        $json = json_encode($authUser);
        $resp = array( 'token' => jwt_encode($json));
        echo json_encode($resp);
        die;
    }
    $resp = array( 'error' => 'Não autorizado');
    echo json_encode($resp);
    http_response_code(401);
    die;
}
