<?php

use Slim\Http\Request;
use Slim\Http\Response;

// GET
$app->get('/usuario', function (Request $request, Response $response, array $args) {
    
    $this->logger->info("GET '/usuario'");

    require_once "model/Usuario.php";
    require_once "model/UsuarioDAO.php";
    $ud = new UsuarioDAO();
    $usuarios = $ud->getUsuarios();
    
    if($usuarios != []){
        foreach($usuarios as $aux){
            $array[] = array("id"=>$aux->getId(), "nome"=>$aux->getNome(),"email"=>$aux->getEmail());
        }
        echo $response->withJson($array, 200);
        //return $response->withJson($array, 200);
    }else{
        $array = json_encode(array("response"=>"Nao existe usuarios cadastrados."));
        echo $response->withJson($array, 204);
    }
});

$app->get('/usuario/{id}', function (Request $request, Response $response, array $args) {
    
    $this->logger->info("GET '/usuario/" . $args['id'] . "'");
    
    require_once "model/Usuario.php";
    require_once "model/UsuarioDAO.php";
    $ud = new UsuarioDAO();
    $usuario = $ud->getUsuarioById($args['id']);
    
    if($usuario->getId() == null){
        $array = json_encode(array("response"=>"Usuario nao existe."));
        echo $response->withJson($array, 204);
    }else{
        $array = json_encode(array("id"=>$usuario->getId(), "nome"=>$usuario->getNome(),"email"=>$usuario->getEmail()));   
        echo $response->withJson($array, 200);
    }
});

//POST
$app->post('/usuario', function (Request $request, Response $response, array $args) {
    $contentType = $request->getContentType();
    $json = json_decode($request->getBody());
    if($contentType == "application/json" and $json->nome != "" and $json->email != ""){
        $this->logger->info("POST '/usuario' - nome: " . $json->nome . " email: " . $json->email);
    
        require_once "model/Usuario.php";
        require_once "model/UsuarioDAO.php";
        $ud = new UsuarioDAO();
        $u = new Usuario(0, $json->nome, $json->email);
        $usuario = $ud->insertUsuario($u);
        if($usuario > 0){
            $array = json_encode(array("usuario_inserido_id"=>$usuario));
            echo $response->withJson($array, 200);
        }else{
            $array = json_encode(array("response"=>"Nao foi possivel inserir"));
            echo $response->withJson($array, 500);
        }
    }else{
        $array = json_encode(array("response"=>"Dados invalidos."));
        echo $response->withJson($array, 500);
    }
});

//PUT
$app->put('/usuario/{id}', function (Request $request, Response $response, array $args) {
    $contentType = $request->getContentType();
    $json = json_decode($request->getBody());
    if($contentType == "application/json" and $json->nome != "" and $json->email != ""){
        $this->logger->info("PUT '/usuario' - nome: " . $json->nome . " email: " . $json->email);
        
        require_once "model/Usuario.php";
        require_once "model/UsuarioDAO.php";
        $ud = new UsuarioDAO();
        $u = new Usuario($args['id'], $json->nome, $json->email);
        $usuario = $ud->alterarUsuario($u);
        
        if($usuario === false){
            $array = json_encode(array("response"=>"Usuario nao existe."));
            echo $response->withJson($array, 204);
        }else{
            $array = json_encode(array("response"=>"Usuario Alterado."));
            echo $response->withJson($array, 200);
        }
    }else{
        $array = json_encode(array("response"=>"Dados invalidos."));
        echo $response->withJson($array, 500);
    }
});

//DELETE
$app->delete('/usuario/{id}', function (Request $request, Response $response, array $args) {
    $contentType = $request->getContentType();
    if($contentType == "application/json"){
        $this->logger->info("DELETE '/usuario/" . $args['id'] . "'");
        
        require_once "model/Usuario.php";
        require_once "model/UsuarioDAO.php";
        $ud = new UsuarioDAO();
        $usuario = $ud->deletarUsuario($args['id']);
        
        if($usuario === false){
            $array = json_encode(array("response"=>"Usuario nao existe."));
            echo $response->withJson($array, 204);
        }else{
            $array = json_encode(array("response"=>"Usuario Excluido."));
            echo $response->withJson($array, 200);
        }
    }else{
        $array = json_encode(array("response"=>"Dados invalidos."));
        echo $response->withJson($array, 500);
    }
});