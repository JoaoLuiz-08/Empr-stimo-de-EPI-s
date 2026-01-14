<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Validação
    $formulario['nome']     = isset($_POST['nome'])   ? $_POST['nome'] : '';
    $formulario['cpf']      = isset($_POST['cpf'])    ? $_POST['cpf'] : '';
    $formulario['sexo']     = isset($_POST['sexo'])   ? $_POST['sexo'] : '';
    $formulario['idade']    = isset($_POST['idade'])  ? $_POST['idade'] : '';
    if (in_array('', $formulario)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Existem dados faltando! Verifique.'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Continuando
    
    // Inserir colaborador
    try {
        $banco = new BancoDeDados;        
        $sql = 'INSERT INTO colaboradores (nome, cpf, sexo, idade) VALUES (?, ?, ?, ?)';
        $parametros = [
            $formulario['nome'],
            $formulario['cpf'],
            $formulario['sexo'],
            $formulario['idade']
        ];
        $banco->executarComando($sql, $parametros);

        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'mensagem'  => 'Colaborador cadastrado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch (PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
