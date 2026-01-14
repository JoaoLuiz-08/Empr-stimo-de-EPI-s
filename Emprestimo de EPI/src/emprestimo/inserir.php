<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Definir o fuso horário local, para pegar a data e hora local correta do servidor
    date_default_timezone_set('America/Sao_Paulo');

    // Validação
    $id_colaborador = isset($_POST['id_colaborador']) ? $_POST['id_colaborador'] : '';
    $id_equipamento = isset($_POST['id_equipamento']) ? $_POST['id_equipamento'] : '';
    $quantidade     = isset($_POST['quantidade'])     ? $_POST['quantidade']     : '';
    if (empty($id_colaborador) || empty($id_equipamento) || empty($quantidade)) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Existem dados faltando! Verifique.'
        ];
        echo json_encode($resposta);
        exit;
    }

    // Criar o objeto banco para usar em todas interações com o o BD
    $banco = new BancoDeDados;

    // Pegar a quantidade do equipamento em estoque
    try {
        $sql = 'SELECT qtd_equipamento FROM equipamentos WHERE id_equipamento = ?';
        $parametros = [ $id_equipamento ];
        $dados = $banco->consultar($sql, $parametros);
        $estoque = $dados['qtd_equipamento'];
    } catch (PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
        exit;
    }

    // Validar se existe estoque para fazer o empréstimo do equipamento
    if ($quantidade > $estoque) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Estoque insuficiente para este equipamento!'
        ];
        echo json_encode($resposta);
        exit;
    } 

    // Pegar a data atual do servidor
    $data_atual = date('Y-m-d H:i:s');


    // Pegar o id do usuário
    session_start();
    $id_usuario = $_SESSION['id_usuario'];

    // Gravar o empéstimo na tabela emprestimo e atualizar o seu estoque na tabela equipamentos
    try {
        // Iniciar a transação
        $banco->iniciarTransacao();

        // Inserir na tabela emprestimo
        $sql = "INSERT INTO emprestimos (
                    data,
                    quantidade, 
                    cancelado,
                    id_equipamento, 
                    id_colaborador,
                    id_usuario
                ) VALUES (?,?,'n',?,?,?)";
        $parametros = [
            $data_atual,
            $quantidade,
            $id_equipamento,
            $id_colaborador,
            $id_usuario
        ];
        $banco->executarComando($sql, $parametros);

        // Atualizar na tabela equipamentos
        $sql = "UPDATE equipamentos SET qtd_equipamento = qtd_equipamento - ? WHERE id_equipamento = ?";
        $parametros = [
            $quantidade,
            $id_equipamento
        ];
        $banco->executarComando($sql, $parametros);

        // Confirmar a transação
        $banco->confirmarTransacao();

        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'mensagem'  => 'Empréstimo registrado com sucesso!'
        ];
        echo json_encode($resposta);
    } catch (PDOException $erro) {
        // Voltar a transação
        $banco->voltarTransacao();
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }