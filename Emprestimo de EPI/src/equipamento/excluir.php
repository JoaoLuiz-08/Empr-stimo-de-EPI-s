<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Validação
    $id_equipamento = isset($_POST['id_equipamento']) ? $_POST['id_equipamento'] : '';
    if (empty($id_equipamento)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'O id do equipamentoto está faltando!'
        ];
        echo json_encode($resposta);
    }

    // Continuando

    // Banco de dados
    try {
        $banco = new BancoDeDados;
        $sql = 'DELETE FROM equipamentos WHERE id_equipamento = ?';
        $parametros = [ $id_equipamento ];
        $banco->executarComando($sql, $parametros);
        
        // Resposta final
       $resposta = [
            'status'    => 'sucesso',
            'mensagem'  => 'Equipamento removido com sucesso!'
        ];
        echo json_encode($resposta);
    } catch(PDOException $erro) {
        
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
        
