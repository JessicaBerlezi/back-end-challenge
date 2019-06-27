<?php
require_once __DIR__ . '\..\..\..\..\src\aplicacao\service\ConversorMoedaApp.php';
require_once __DIR__ . '\..\..\..\..\src\apresentacao\api\model\ConversaoMoedaModel.php';

use src\aplicacao\service\ConversorMoedaApp;
use src\apresentacao\api\model\ConversaoMoedaModel;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

try{
    $http_code = \ConstantesMessageException::BAD_REQUEST;; //Retorna apenas no catch - Error padr�o
    
    if ($_SERVER["REQUEST_METHOD"] <> "GET") {
        $http_code = (\ConstantesMessageException::NOT_ALLOWED);
        throw new \Exception("M�todo ". $_SERVER["REQUEST_METHOD"] ." n�o suportado.");
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
        throw new \InvalidArgumentException("Par�metros requeridos n�o informados.");
    }
} catch (\Exception $e) {
    http_response_code($http_code);
    echo 'Exce��o capturada: ',  $e->getMessage(), "\n";
}
?>
