<?php
    // Include
    include '../services/BancoDeDados.php';
    
    // Validação
    $id_equipamento = isset($_POST['id_equipamento']) ? $_POST['id_equipamento'] : '';
    if (empty($id_equipamento)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'O id do equipamento está faltando!'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Continuando

    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM equipamentos WHERE id_equipamento = ?';
        $parametros = [ $id_equipamento ];
        $dados = $banco->consultar($sql, $parametros);
        
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