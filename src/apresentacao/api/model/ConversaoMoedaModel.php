<?php
namespace src\apresentacao\api\model;

class ConversaoMoedaModel implements \JsonSerializable
{
    private $moeda;
    private $valor;
    
    public function __construct($moeda, $valor) {
        $this->moeda = $moeda;
        $this->valor = number_format($valor, 4, '.', '');}
    
    public function getMoeda(){
        return $this ->moeda;
    }
    public function getValor() {
        return $this->valor;
    }
    
    public function jsonSerialize(){
        return get_object_vars($this);
    }
}

