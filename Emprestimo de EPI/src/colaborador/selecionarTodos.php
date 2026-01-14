<?php
    // Include
    include '../services/BancoDeDados.php';

    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM colaboradores';
        $dados = $banco->consultar($sql, [], true);
        
        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'dados'     => $dados
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }