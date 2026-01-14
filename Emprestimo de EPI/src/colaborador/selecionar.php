<?php
    // Include
    include '../services/BancoDeDados.php';
    
    // Validação
    $id_colaborador = isset($_POST['id_colaborador']) ? $_POST['id_colaborador'] : '';
    if (empty($id_colaborador)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'O id do colaborador está faltando!'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Continuando

    try {
        $banco = new BancoDeDados;
        $sql = 'SELECT * FROM colaboradores WHERE id_colaborador = ?';
        $parametros = [ $id_colaborador ];
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