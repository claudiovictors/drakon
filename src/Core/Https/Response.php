<?php

namespace Drakon\Core\Https;

/**
 * Classe Response - Responsável por construir e enviar respostas HTTP.
 */
class Response {

    /**
     * Envia uma resposta JSON.
     * Configura o cabeçalho HTTP para JSON e retorna os dados codificados em formato JSON.
     *
     * @param array $data Os dados que serão enviados no corpo da resposta.
     */
    public function json(array $data){
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    /**
     * Define o código de status HTTP da resposta.
     * Permite o encadeamento de chamadas ao retornar a instância da própria classe.
     *
     * @param int $code O código de status HTTP (ex.: 200, 404, 500).
     * @return $this Retorna a instância atual para encadeamento.
     */
    public function status(int $code){
        http_response_code($code);
        return $this;
    }
}
