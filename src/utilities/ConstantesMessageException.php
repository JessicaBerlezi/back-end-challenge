<?php

define("NAO_DEFINIDO", " n�o definido.");
define("FORMATO_INVALIDO", "est� definido com formato inv�lido.");


class ConstantesMessageException {
    const BAD_REQUEST = 400;
    
    /**
     * Campos obrigat�rios n�o preenchidos
     */
    public static function getMessageExceptionNullParamValorCotacao()
    {
        return "Par�metro do valor da cota��o ".NAO_DEFINIDO;
    }    
    public static function  getMessageExceptionNullParamValorQuantidade(){
        return "Par�metro quantidade " .NAO_DEFINIDO;
    }
    public static function  getMessageExceptionParseParamValorQuantidade(){
        return "Par�metro quantidade " .FORMATO_INVALIDO;
    }
    public static function getMessageExceptionNullParamSigla(){
        return "Par�metro de sigla da moeda ".NAO_DEFINIDO;
    }
    public static function getMessageExceptionNullParamData(){
        return "Par�metro de data para consulta ".NAO_DEFINIDO;
    }
   
    
    /**
     * Padroniza��o de formato de par�metro
     */
    public static function getMessageExceptionParseParamValorCotacao(){
        return "Par�metro do valor da cota��o".FORMATO_INVALIDO;
    } 
    public static function getMessageExceptionRNDataFormatoInvalido(){
        return "Par�metro data " .FORMATO_INVALIDO. ": Utilize MM/dd/yyyy";
    }
    
    
    /**
     * Exceptions por valida��o/regra de neg�cio
     /
      * 
    public static function getMessageExceptionRNSiglaMoeda(){
        return "Tipo de moeda n�o validada: Utilize EUR, BRL ou USD.";
    }*/
    public static function getMessageExceptionRNSiglaMoedaInvalida(){
        return "Tipo de moeda n�o validada: Utilize EUR, BRL ou USD.";
    }
    public static function getMessageExceptionRNParamsSiglaMoedaIguais(){
        return "Par�metros de sigla moeda origem e destino est�o iguais.";
    }
    
    
    /**
     * EXCEPTIONS
     * Error dos m�todos da camada de neg�cio
     */
    public static function getMessageExceptionErrorCalcularPorCotacao(){
        return "Um erro ocorreu ao buscar a cota��o, verifique o formato dos par�metros e tente novamente.";
    }
}
?>