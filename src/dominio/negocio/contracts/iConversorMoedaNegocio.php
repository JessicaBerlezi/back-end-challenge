<?php
namespace src\dominio\negocio\contracts;
use src\apresentacao\api\model\ConversaoMoedaModel;

//Convers�o de moeda com base na cota��o
//Ex: D�lar para Real brasileiro
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
         * @param Quando utilizado o servi�o de Integra��o para buscar a cota��o de moeda online, algumas moedas podem n�o ser encontradas (Exemplo a BRL), por isso o c�lculo deve ser invertido (Pois ser� buscada a cota��o da moeda de origem).
         * @author <jessica.berlezi@gmail.com>
         * @return ConversaoMoedaModel resultado da conversao, vindo dos m�todos da camada de dominio.
         */

        public function calcularMoedaPorCotacaoOnline($de, $para, $vlrQuantidade, $data);
}

