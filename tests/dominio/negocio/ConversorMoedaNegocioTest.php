<?php

require_once __DIR__ . '..\..\..\..\src\dominio\negocio\service\ConversorMoedaNegocio.php';
require_once __DIR__ . '..\..\..\..\src\utilities\ConstantesMessageException.php';
/**
 * ConversorMoedaNegocio test case.
 */
use PHPUnit\Framework\TestCase;
use src\dominio\negocio\service\ConversorMoedaNegocio;

class ConversorMoedaNegocioTest extends TestCase
{

    /**
     *
     * @var ConversorMoedaNegocio
     */
    private $conversorMoedaNegocio;


    /**
     * Teste de conversão padrão 
     * 2 unidades com cotação 3,90 = 0,5208
     */
    public function testCalcularMoedaPorCotacao()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(0.5208, $this->conversorMoedaNegocio->calcularMoedaPorCotacao(3.84, 2));
    }
    
    //Como não é obrigatório, considera como 1unidade
    public function testCalcularMoedaPorCotacaoNullParamValorQuantidade()
    {    
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(0.2604, $this->conversorMoedaNegocio->calcularMoedaPorCotacao(3.84, null));
    }
    
    public function testCalcularMoedaPorCotacaoEmptyParamValorQuantidade()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(0.2604, $this->conversorMoedaNegocio->calcularMoedaPorCotacao(3.84, ""));;
    }
    /**
     * Proteção dos métodos: * Sequência de teste das exception
     */
    public function testCalcularMoedaPorCotacaoExceptionNullParamValorCotacao()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamValorCotacao());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);

        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacao(null, 2));
    }
    public function testCalcularMoedaPorCotacaoExceptionEmptyParamValorCotacao()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamValorCotacao());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacao("", 2));
    }
    
    public function testCalcularMoedaPorCotacaoExceptionParseParamValorCotacao()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionParseParamValorCotacao());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacao("teste string no lugar de double", 2));
    }

    public function testCalcularMoedaPorCotacaoExceptionParseParamValorQuantidade()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionParseParamValorQuantidade());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacao(3.85, "teste string no lugar de double"));
    }
    
}

