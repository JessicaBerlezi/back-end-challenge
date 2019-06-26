<?php
require_once __DIR__ . '\..\..\..\..\src\aplicacao\service\ConversorMoedaApp.php';
require_once __DIR__ . '\..\..\..\..\src\apresentacao\api\model\ConversaoMoedaModel.php';

use src\aplicacao\service\ConversorMoedaApp;
use src\apresentacao\api\model\ConversaoMoedaModel;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

    try{  
    	$http_code = 400; //Retorna apenas no catch - Error padrгo

    	if ($_SERVER["REQUEST_METHOD"] <> "GET") {
    		$http_code = (403); //forbidden
			throw new Exception("Mйtodo ". $_SERVER["REQUEST_METHOD"] ." nгo suportado.");
    	}elseif ($_GET){

			if(!empty($_GET['cotacao'])){
				$vlrCotacao = $_GET['cotacao'];
			}else{
				throw new Exception("Parвmetro cotacao nгo informado.");
			}
			
			if(!empty($_GET['quantidade'])){
				$vlrQuantidade = $_GET['quantidade'];
			}else{
				$vlrQuantidade = 1;
			}
			
			//Processamento
			$app = new ConversorMoedaApp();
			$vlrConvertido = $app->conversorMoeda($vlrCotacao, $vlrQuantidade);
			$dto = new ConversaoMoedaModel("BRL", $vlrConvertido);
			
		    //Retorno da api
		    http_response_code(200);
			echo json_encode($dto, JSON_PRETTY_PRINT);
		}else{
			throw new Exception("Parвmetro requerido nгo informado.");
		}
	} catch (Exception $e) {
			http_response_code($http_code);
    		echo 'Exceзгo capturada: ',  $e->getMessage(), "\n";
	}
?>