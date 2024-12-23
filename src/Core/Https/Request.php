<?php

namespace Drakon\Core\Https;

/**
 * Classe Request - Responsável por lidar com os dados da requisição HTTP.
 */
class Request {

    // Propriedade privada para armazenar os parâmetros da requisição.
    private array $params;

    /**
     * Construtor da classe.
     * Recebe um array de parâmetros opcionais e os armazena na propriedade $params.
     *
     * @param array $params Parâmetros passados na requisição.
     */
    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    /**
     * Método para acessar um parâmetro específico da requisição.
     * Verifica se a chave existe no array de parâmetros e retorna o valor correspondente.
     *
     * @param string $key A chave do parâmetro desejado.
     * @return mixed Retorna o valor do parâmetro ou null se não existir.
     */
    public function param(string $key){
        return array_key_exists($key, $this->params) ? $this->params[$key] : null;
    }
}
