<?php
    // Includes
    include '../services/BancoDeDados.php';

    // Banco de Dados
    $banco =  new BancoDeDados;

    // Selecionar os dados dos empréstimos com relacionamentos
    try {
        $sql = "SELECT emprestimos.*, 
                       equipamentos.nome AS equipamento, 
                       colaboradores.nome AS colaborador, 
                       usuarios.nome AS usuario
                FROM emprestimos
                INNER JOIN equipamentos USING(id_equipamento)
                INNER JOIN colaboradores USING(id_colaborador)
                INNER JOIN usuarios USING(id_usuario)
                ORDER BY emprestimos.cancelado DESC, emprestimos.data DESC";
        $dados = $banco->consultar($sql, [], true);

        // Resposta final
        $resposta = [
            'status'    => 'sucesso',
            'dados'     => $dados
        ];
        echo json_encode($resposta);
    } catch (PDOException $erro) {
        $resposta = [
            'status'    => 'erro',
            'mensagem'  => 'Houve uma excessão no banco de dados: ' . $erro->getMessage()
        ];
        echo json_encode($resposta);
    }