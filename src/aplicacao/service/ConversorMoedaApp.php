<?php
namespace src\aplicacao\service;

require_once __DIR__ . '\..\..\..\src\aplicacao\contracts\iConversorMoedaApp.php';
require_once __DIR__ . '\..\..\..\src\dominio\negocio\service\ConversorMoedaNegocio.php';

use src\aplicacao\contracts\iConversorMoedaApp;
use src\dominio\negocio\service\ConversorMoedaNegocio;

class ConversorMoedaApp implements iConversorMoedaApp
{
    private $conversorMoedaNegocio;

    public function conversorMoeda($vlrCotacao, $vlrQuantidade)
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $vlrConvertido = $this->conversorMoedaNegocio->calcularMoedaPorCotacao($vlrCotacao, $vlrQuantidade);
        return $vlrConvertido;  
    }
    
    public function calcularMoedaPorCotacaoOnline($de, $para, $vlrQuantidade, $data)
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $vlrConvertido = $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline($de, $para, $vlrQuantidade, $data);
        return $vlrConvertido;    
    }
  
}

