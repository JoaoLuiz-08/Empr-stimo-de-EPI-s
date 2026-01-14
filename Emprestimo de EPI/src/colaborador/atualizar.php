<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Validação
    $formulario['id']       = isset($_POST['id'])       ? $_POST['id'] : '';
    $formulario['nome']     = isset($_POST['nome'])     ? $_POST['nome'] : '';
    $formulario['cpf']      = isset($_POST['cpf'])      ? $_POST['cpf'] : '';
    $formulario['sexo']     = isset($_POST['sexo'])     ? $_POST['sexo'] : '';
    $formulario['idade']    = isset($_POST['idade'])    ? $_POST['idade'] : '';
    if (in_array('', $formulario)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Existem dados faltando! Verifique.'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Continuando
    
    // Atualizar colaborador
    try {
        $banco = new BancoDeDados;        
        $sql = 'UPDATE colaboradores SET nome = ?, cpf = ?, sexo = ?, idade = ? WHERE id_colaborador = ?';
        $parametros = [
            $formulario['nome'],
            $formulario['cpf'],
            $formulario['sexo'],
            $formulario['idade'],
            $formulario['id']
        ];
        $banco->executarComando($sql, $parametros);

        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'mensagem'  => 'Colaborador alterado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch (PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }
