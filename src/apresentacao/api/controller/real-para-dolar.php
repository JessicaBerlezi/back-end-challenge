<?php
require_once __DIR__ . '\..\..\..\..\src\aplicacao\service\ConversorMoedaApp.php';
require_once __DIR__ . '\..\..\..\..\src\apresentacao\api\model\ConversaoMoedaModel.php';

use src\aplicacao\service\ConversorMoedaApp;
use src\apresentacao\api\model\ConversaoMoedaModel;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try{
    $http_code = \ConstantesMessageException::BAD_REQUEST;; //Retorna apenas no catch - Error padrão
    
    if ($_SERVER["REQUEST_METHOD"] <> "GET") {
        $http_code = (\ConstantesMessageException::NOT_ALLOWED);
        throw new \Exception("Método ". $_SERVER["REQUEST_METHOD"] ." não suportado.");
    }elseif ($_GET){
        
        if(!empty($_GET['cotacao'])){
            $vlrCotacao = $_GET['cotacao'];
        }else{
            $vlrCotacao = "";
        }
        
        if(!empty($_GET['quantidade'])){
            $vlrQuantidade = $_GET['quantidade'];
        }else{
            $vlrQuantidade = 1;
        }
        //Processamento
        $app = new ConversorMoedaApp();
        $vlrConvertido = $app->conversorMoeda($vlrCotacao, $vlrQuantidade);
        $dto = new ConversaoMoedaModel("USD", $vlrConvertido);
        
        //Retorno da api
        http_response_code(\ConstantesMessageException::OK);
        echo json_encode($dto, JSON_PRETTY_PRINT);
    }else{
        throw new \InvalidArgumentException("Parâmetros requeridos não informados.");
    }
} catch (\Exception $e) {
    http_response_code($http_code);
    echo 'Exceção capturada: ',  $e->getMessage(), "\n";
}
?>
