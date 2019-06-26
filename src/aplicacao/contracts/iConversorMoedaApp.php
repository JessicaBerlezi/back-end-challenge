<?php
namespace src\aplicacao\contracts;

interface iConversorMoedaApp
{
    public function conversorMoeda($vlrCotacao, $vlrQuantidade);
    
    public function calcularMoedaPorCotacaoOnline($de, $para, $vlrQuantidade, $data);
      
}

