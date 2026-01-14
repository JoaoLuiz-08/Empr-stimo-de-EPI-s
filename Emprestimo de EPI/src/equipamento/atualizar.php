<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Validação
    $formulario['id']           = isset($_POST['id'])           ? $_POST['id'] : '';
    $formulario['nome']         = isset($_POST['nome'])         ? $_POST['nome'] : '';
    $formulario['descricao']    = isset($_POST['descricao'])    ? $_POST['descricao'] : '';
    $formulario['quantidade']   = isset($_POST['quantidade'])   ? $_POST['quantidade'] : '';
    if (in_array('', $formulario)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Existem dados faltando! Verifique.'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Continuando
    
    // Atualizar equipamento
    try {
        $banco = new BancoDeDados;        
        $sql = 'UPDATE equipamentos SET nome = ?, descricao = ?, qtd_equipamento = ? WHERE id_equipamento = ?';
        $parametros = [
            $formulario['nome'],
            $formulario['descricao'],
            $formulario['quantidade'],
            $formulario['id']
        ];
        $banco->executarComando($sql, $parametros);

        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'mensagem'  => 'Equipamento alterado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch (PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
