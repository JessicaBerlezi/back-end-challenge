<?php
require_once __DIR__ . '..\..\..\..\src\dominio\negocio\service\ConversorMoedaNegocio.php';
require_once __DIR__ . '..\..\..\..\src\utilities\ConstantesMessageException.php';
/**
 * ConersorMoedaOnlineNegocioTest test case.
 */
use PHPUnit\Framework\TestCase;
use src\dominio\negocio\service\ConversorMoedaNegocio;

class ConersorMoedaOnlineNegocioTest extends TestCase
{

    private $conversorMoedaNegocio;

    /**
     * Teste de conversão padrão
     * 2 unidades com cotação 3,90 = 0,5208
     */
    public function testCalcularMoedaPorCotacaoOnlineBRLtoUSD()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(0.2610, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "USD", 1 ,"06-25-2019"));
    }
    
    public function testCalcularMoedaPorCotacaoOnlineUSDtoBRL()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(957.8500, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("USD", "BRL", 250 ,"06-25-2019"));
    }
    
    public function testCalcularMoedaPorCotacaoOnlineBRLtoEUR()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(0.2291, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "EUR", 1 ,"06-25-2019"));
    }
    
    public function testCalcularMoedaPorCotacaoOnlineEURtoBRL()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(4.3647, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("EUR", "BRL", 1 ,"06-25-2019"));
    }
    
    
    //Como não é obrigatório, considera como 1unidade
    public function testCalcularMoedaPorCotacaoNullParamValorQuantidade()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(3.8314, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("USD", "BRL", null ,"06-25-2019"));
    }
    
    public function testCalcularMoedaPorCotacaoEmptyParamValorQuantidade()
    {
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(3.8314, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("USD", "BRL", "" ,"06-25-2019"));
    
    }
    
    /**
     * Proteção dos métodos: * Sequência de teste das exception
     */
    public function testCalcularMoedaPorCotacaoEmptyParamValorQuantidadeNegativa()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionParseParamValorQuantidade());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "USD", -1 , "06-25-2019"));
    }

        
    public function testCalcularMoedaPorCotacaoOnlineExceptionNullParamSigla(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamSigla());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", null, 1 , "06-25-2019"));
    }
    public function testCalcularMoedaPorCotacaoOnlineExceptionNullParamSigla2(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamSigla());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline(null, "BRL", 1 , "06-25-2019"));
    }
    public function testCalcularMoedaPorCotacaoOnlineExceptionNullParamSigla3(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamSigla());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline(null, null, 1 , "06-25-2019"));
    }
    public function testCalcularMoedaPorCotacaoOnlineExceptionEmptyParamSigla(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamSigla());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("", "", 1 , "06-25-2019"));
    }
    
    
    public function testCalcularMoedaPorCotacaoOnlineExceptionNullParamData(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamData());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "USD", 1 , null));
    }
    public function testCalcularMoedaPorCotacaoOnlineExceptionEmptyParamData(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionNullParamData());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "USD", 1 , ""));
    }
    
    /**
     * RNs
     */
    public function testCalcularMoedaPorCotacaoOnlineExceptionRNSiglaMoedaIguais(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionRNParamsSiglaMoedaIguais());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("USD", "USD", 1 , "06-25-2019"));
    }
    
    public function testCalcularMoedaPorCotacaoOnlineExceptionRNSiglaMoedaInvalida(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionRNSiglaMoedaInvalida());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("DOLAR", "REAL", 1 , "06-25-2019"));
    }
    
    public function testCalcularMoedaPorCotacaoOnlineExceptionRNSiglaMoedaInvalida2(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionRNSiglaMoedaInvalida());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "DOLAR", 1 , "06-25-2019"));
    }
    
    public function testCalcularMoedaPorCotacaoOnlineExceptionParseParamValorQuantidade(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ConstantesMessageException::getMessageExceptionParseParamValorQuantidade());
        $this->expectExceptionCode(\ConstantesMessageException::FOTBIDDEN);
        
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "USD", "STRING NO LUGAR DE DOUBLE" , "06-25-2019"));
    }
     public function testCalcularMoedaPorCotacaoOnlineExceptionRNDataFormatoInvalido(){
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionCode(ConstantesMessageException::BAD_REQUEST); //BAD REQUEST do serviço externo
     
        $this->conversorMoedaNegocio = new ConversorMoedaNegocio();
        $this->assertEquals(InvalidArgumentException::class, $this->conversorMoedaNegocio->calcularMoedaPorCotacaoOnline("BRL", "USD", 1 , "data com formato invalido"));
     }
}

