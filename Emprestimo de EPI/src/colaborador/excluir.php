<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Validação
    $id_colaborador = isset($_POST['id_colaborador']) ? $_POST['id_colaborador'] : '';
    if (empty($id_colaborador)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'O id do colaborador está faltando!'
        ];
        echo json_encode($resposta);
    }

    // Continuando

    // Banco de dados
    try {
        $banco = new BancoDeDados;
        $sql = 'DELETE FROM colaboradores WHERE id_colaborador = ?';
        $parametros = [ $id_colaborador ];
        $banco->executarComando($sql, $parametros);
        
        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'mensagem'  => 'Colaborador removido com sucesso!'
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
