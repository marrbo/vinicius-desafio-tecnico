<?php
use Models\Schools;
use Models\Teams;
use Models\Users;

require_once __DIR__.'/../../boot.php';

// verificar se usuário esta autorizado
$headers = getallheaders();
try {
    $tokenData = jwt_decode($headers['Authorization']);
} catch (\Throwable $th) {
    $resp = array(
        'error' => 'Token incorreto',
        'details' => $th->getMessage()
    );
    echo json_encode($resp);
    http_response_code(500);
    die;
}
$isUserAuthorized = Users::isUserAuthorized($tokenData);
if (!$isUserAuthorized){
    $resp = array( 'error' => 'Não autorizado');
    echo json_encode($resp);
    http_response_code(401);
    die;
}
// usuário autorizado, continua...
// recebendo get
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'get') == 0){
    $teamData = Teams::get();
    echo json_encode($teamData);
    die;
};
// recebendo post put delete
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0){
    $data = json_decode(file_get_contents('php://input'), true);
    // recenbendo delete
    if(isset($data['_method']) && strcasecmp($data['_method'], 'delete') == 0){
        // se não enviou id, bad request
        if(!isset($_GET['id'])){
            $resp = array( 'error' => 'Identifique o id do item a ser deletado');
            echo json_encode($resp);
            http_response_code(401);
            die;
        }
        $teamData = Teams::del($_GET['id']);
        if(is_int($teamData) && $teamData > 0){
            $resp = array( 'msg' => 'Items deletados: ' . $teamData);
            echo json_encode($resp);
            die;
        }
        $resp = array( 'error' => 'Houve um erro e nenhum item foi deletado');
        echo json_encode($resp);
        http_response_code(500);
        die;
    }
    // verifica se escola existe, se não,  bad request
    $hasSchool = Schools::has($data['school_id']);
    if(!$hasSchool){
        $resp = array( 'error' => 'Insira uma escola válida');
        echo json_encode($resp);
        http_response_code(401);
        die;
    }
    // recebendo put
    if(isset($data['_method']) && strcasecmp($data['_method'], 'put') == 0){
        // se não enviou id, bad request
        if(!isset($_GET['id'])){
            $resp = array( 'error' => 'Identifique o id do item a ser alterado');
            echo json_encode($resp);
            http_response_code(401);
            die;
        }
        $teamData = Teams::edit($_GET['id'], $data);
        if(is_int($teamData) && $teamData > 0){
            $resp = array( 'msg' => 'Items alterados: ' . $teamData);
            echo json_encode($resp);
            die;
        }
        $resp = array( 'error' => 'Houve um erro e nenhum item foi alterado');
        echo json_encode($resp);
        http_response_code(500);
        die;
    }
    // recebendo post
    $teamData = Teams::new($data);
    if(is_int($teamData) && $teamData > 0){
        $resp = array( 'msg' => 'Items adicionados: ' . $teamData);
        echo json_encode($resp);
        die;
    }
    $resp = array( 'error' => 'Houve um erro e nenhum item foi adicionado');
    echo json_encode($resp);
    http_response_code(500);
    die;
};
