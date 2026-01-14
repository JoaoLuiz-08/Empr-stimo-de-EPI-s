<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Validação
    $formulario['nome']         = isset($_POST['nome'])         ? $_POST['nome'] : '';
    $formulario['descricao']        = isset($_POST['descricao'])        ? $_POST['descricao'] : '';
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
    
    // Inserir equipamento
    try {
        $banco = new BancoDeDados;        
        $sql = 'INSERT INTO equipamentos (nome, descricao, qtd_equipamento) VALUES (?, ?, ?)';
        $parametros = [
            $formulario['nome'],
            $formulario['descricao'],
            $formulario['quantidade']
        ];
        $banco->executarComando($sql, $parametros);

        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'mensagem'  => 'Equipamento cadastrado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch (PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
