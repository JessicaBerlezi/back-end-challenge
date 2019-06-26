<?php
namespace src\infraestrutura\integracao;

/**
 https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/aplicacao#!/
 */

class CotacaoMoedaOnlineIntegracao {
    public function pesquisarMoedaPorIdentificadorOnline($siglaMoeda){
        try{
            $json_file = file_get_contents("https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/Moedas?");
            $json_str = json_decode($json_file, true);
            $itens = $json_str['value'];
            
            foreach ( $itens as $e ) {
                if($e['simbolo'] == $siglaMoeda){
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    public function pesquisarValorCotacaoOnline($siglaMoeda, $dataFormatada) {
        try{
            $json_file = file_get_contents("https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoMoedaDia(moeda=@moeda,dataCotacao=@dataCotacao)?@moeda='{$siglaMoeda}'&@dataCotacao='{$dataFormatada}'");
            $json_str = json_decode($json_file, true);
            $itens = $json_str['value'];
            
            foreach ( $itens as $e ) {
                echo $e['cotacaoCompra'];
                return $e['cotacaoCompra'];
            }
        } catch (\Exception $e) {
            
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionErrorCalcularPorCotacao() , \ConstantesMessageException::BAD_REQUEST); //BAD REQUEST
     
        }
    }
}

