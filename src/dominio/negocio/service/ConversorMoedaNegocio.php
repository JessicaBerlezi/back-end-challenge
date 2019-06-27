<?php
namespace src\dominio\negocio\service;

require_once __DIR__ . '\..\..\..\..\src\dominio\negocio\contracts\iConversorMoedaNegocio.php';
require_once __DIR__ . '\..\..\..\..\src\infraestrutura\integracao\CotacaoMoedaOnlineIntegracao.php';
require_once __DIR__ . '\..\..\..\..\src\utilities\ConstantesMessageException.php';

use ConstantesMessageException;
use src\dominio\negocio\contracts\iConversorMoedaNegocio;
use src\infraestrutura\integracao\CotacaoMoedaOnlineIntegracao;

class ConversorMoedaNegocio implements iConversorMoedaNegocio
{
    
    public function calcularMoedaPorCotacao($vlrCotacao, $vlrQuantidade){
        if(is_null($vlrCotacao) or $vlrCotacao == ""){
            throw new \InvalidArgumentException(ConstantesMessageException::getMessageExceptionNullParamValorCotacao(),\ConstantesMessageException::FOTBIDDEN);
        }
        if(!is_numeric($vlrCotacao)){
            $vlrCotacao = str_replace(",", ".", $vlrCotacao);
            if(!is_numeric($vlrCotacao)){
                throw new \InvalidArgumentException(ConstantesMessageException::getMessageExceptionParseParamValorCotacao(), \ConstantesMessageException::FOTBIDDEN);
            }
        }
        if(is_null($vlrQuantidade) OR empty($vlrQuantidade)){
            $vlrQuantidade = 1;
        }else if(!is_numeric($vlrQuantidade)){
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionParseParamValorQuantidade(), \ConstantesMessageException::FOTBIDDEN);
        }
        if($vlrQuantidade < 1){
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionParseParamValorQuantidade(), \ConstantesMessageException::FOTBIDDEN);
        }
        try {
            $retorno = $vlrQuantidade / $vlrCotacao;
            return number_format($retorno, 4, '.', '');
        } catch (\Exception $e) {
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionErrorCalcularPorCotacao(), \ConstantesMessageException::BAD_REQUEST);
        }
    }
    
    public function calcularMoedaPorCotacaoOnline($de, $para, $vlrQuantidade, $data)
    {
        if(is_null($de) or is_null($para) or empty($de) or empty($para)){
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionNullParamSigla());
        }
        
        if(is_null($vlrQuantidade) || empty($vlrQuantidade)){
            $vlrQuantidade = 1;
        }else if(!is_numeric($vlrQuantidade)){
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionParseParamValorQuantidade(), 403);
        }
        if($vlrQuantidade < 1){
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionParseParamValorQuantidade());
        }
        
        if(is_null($data) || $data == ""){
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionNullParamData());
        }else{
            $data = str_replace("/", "-", $data);
        }
        if(strcasecmp($de, $para) == 0){
            throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionRNParamsSiglaMoedaIguais());
        }else{
            //Moedas possíveis segundo as instruções para a construção do código
            $lMoedasPossiveis = array("EUR", "BRL", "USD"); 
            if (!in_array($de, $lMoedasPossiveis)){
                throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionRNSiglaMoedaInvalida());
            }
            if (!in_array($para, $lMoedasPossiveis)){
                throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionRNSiglaMoedaInvalida());
            }
        }
       
       
        /*
        * Descobrir valor cotação online
        */
        $integracao = new CotacaoMoedaOnlineIntegracao();
        if(strcasecmp($para, "BRL") == 0){ 
            $vlrCotacao =  $integracao->pesquisarValorCotacaoOnline($de, $data);
            if(empty($vlrCotacao)){
                throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionErrorCalcularPorCotacao());
            }
            if(is_numeric($vlrCotacao) AND is_numeric($vlrQuantidade)){
                $retorno = $vlrQuantidade * $vlrCotacao;
                $vlrConvertido = number_format($retorno, 4, '.', '');
            }else{
                throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionErrorCalcularPorCotacao());
            }  
        }else{
            $vlrCotacao =  $integracao->pesquisarValorCotacaoOnline($para, $data);
            if(empty($vlrCotacao)){
                throw new \InvalidArgumentException(\ConstantesMessageException::getMessageExceptionErrorCalcularPorCotacao());
            }
            $vlrConvertido = $this->calcularMoedaPorCotacao($vlrCotacao, $vlrQuantidade);
        }
        return $vlrConvertido;
    }
}

