<?php
namespace src\dominio\negocio\contracts;
use src\apresentacao\api\model\ConversaoMoedaModel;

//Conversão de moeda com base na cotação
//Ex: Dólar para Real brasileiro
interface iConversorMoedaNegocio
{
        /**
         * @param cotacao da moeda origem;
         * @param valor/quantidade da moeda origem;
         * @author <jessica.berlezi@gmail.com>
         * @return double Quantidade dividida por cotacao
         */
        public function calcularMoedaPorCotacao($vlrCotacao, $vlrQuantidade);
          
        
        /**
         * @param de - Sigla da moeda original;
         * @param para - Sigla da moeda a ser convertida;
         * @param vlrQuantidade da moeda original;
         * @param data a ser utilizada na consulta, utilizar formato dd-MM-yyyy
         * @param Quando utilizado o serviço de Integração para buscar a cotação de moeda online, algumas moedas podem não ser encontradas (Exemplo a BRL), por isso o cálculo deve ser invertido (Pois será buscada a cotação da moeda de origem).
         * @author <jessica.berlezi@gmail.com>
         * @return ConversaoMoedaModel resultado da conversao, vindo dos métodos da camada de dominio.
         */

        public function calcularMoedaPorCotacaoOnline($de, $para, $vlrQuantidade, $data);
}

