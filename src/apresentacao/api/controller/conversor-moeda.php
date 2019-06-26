<?php
require_once __DIR__ . '\..\..\..\..\src\aplicacao\service\ConversorMoedaApp.php';
require_once __DIR__ . '\..\..\..\..\src\apresentacao\api\model\ConversaoMoedaModel.php';

use src\aplicacao\service\ConversorMoedaApp;
use src\apresentacao\api\model\ConversaoMoedaModel;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try{
    
    $http_code = 400; //Retorna apenas no catch - Error padrão
    
    if ($_SERVER["REQUEST_METHOD"] <> "GET") {
        $http_code = (403); //forbidden
        throw new Exception("Método ". $_SERVER["REQUEST_METHOD"] ." não suportado.");
    }elseif ($_GET){
        //Validação dos parâmetros
        if(!empty($_GET['de'])){
            $de = $_GET['de'];
        }else{
            $de = "";
        }
        if(!empty($_GET['para'])){
            $para = $_GET['para'];
        }else{
            $para = "";;
        }
        
        if(!empty($_GET['quantidade'])){
            $vlrQuantidade = $_GET['quantidade'];
        }else{
            $vlrQuantidade = 1;
        }
        if(!empty($_GET['data'])){
            $data = $_GET['data'];
        }else{
            $data = "";
        }
        
        //Processamento
        $app = new ConversorMoedaApp();
        $vlrConvertido = $app->calcularMoedaPorCotacaoOnline($de, $para, $vlrQuantidade, $data);
        $dto = new ConversaoMoedaModel($para, $vlrConvertido);
        
        //Retorno da api
        http_response_code(200);
        echo json_encode($dto, JSON_PRETTY_PRINT);
    }else{
        throw new Exception("Parâmetro requerido não informado.");
    }
} catch (Exception $e) {
    http_response_code($http_code);
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}
?>