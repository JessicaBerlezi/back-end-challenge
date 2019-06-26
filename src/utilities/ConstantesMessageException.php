<?php

define("NAO_DEFINIDO", " nгo definido.");
define("FORMATO_INVALIDO", "estб definido com formato invбlido.");


class ConstantesMessageException {
    const BAD_REQUEST = 400;
    
    /**
     * Campos obrigatуrios nгo preenchidos
     */
    public static function getMessageExceptionNullParamValorCotacao()
    {
        return "Parвmetro do valor da cotaзгo ".NAO_DEFINIDO;
    }    
    public static function  getMessageExceptionNullParamValorQuantidade(){
        return "Parвmetro quantidade " .NAO_DEFINIDO;
    }
    public static function  getMessageExceptionParseParamValorQuantidade(){
        return "Parвmetro quantidade " .FORMATO_INVALIDO;
    }
    public static function getMessageExceptionNullParamSigla(){
        return "Parвmetro de sigla da moeda ".NAO_DEFINIDO;
    }
    public static function getMessageExceptionNullParamData(){
        return "Parвmetro de data para consulta ".NAO_DEFINIDO;
    }
   
    
    /**
     * Padronizaзгo de formato de parвmetro
     */
    public static function getMessageExceptionParseParamValorCotacao(){
        return "Parвmetro do valor da cotaзгo".FORMATO_INVALIDO;
    } 
    public static function getMessageExceptionRNDataFormatoInvalido(){
        return "Parвmetro data " .FORMATO_INVALIDO. ": Utilize MM/dd/yyyy";
    }
    
    
    /**
     * Exceptions por validaзгo/regra de negуcio
     /
      * 
    public static function getMessageExceptionRNSiglaMoeda(){
        return "Tipo de moeda nгo validada: Utilize EUR, BRL ou USD.";
    }*/
    public static function getMessageExceptionRNSiglaMoedaInvalida(){
        return "Tipo de moeda nгo validada: Utilize EUR, BRL ou USD.";
    }
    public static function getMessageExceptionRNParamsSiglaMoedaIguais(){
        return "Parвmetros de sigla moeda origem e destino estгo iguais.";
    }
    
    
    /**
     * EXCEPTIONS
     * Error dos mйtodos da camada de negуcio
     */
    public static function getMessageExceptionErrorCalcularPorCotacao(){
        return "Um erro ocorreu ao buscar a cotaзгo, verifique o formato dos parвmetros e tente novamente.";
    }
}
?>