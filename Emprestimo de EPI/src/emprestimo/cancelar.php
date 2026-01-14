

<?php

 // Includes
 include '../services/BancoDeDados.php';

 // Validação
 $id_emprestimo = isset($_POST['id_emprestimo']) ? $_POST['id_emprestimo'] : '';
 if (empty($id_emprestimo)) {
     $resposta = [
         'status'    => 'erro',
         'mensagem'  => 'O Id do empréstimo está faltando! Verifique.'
     ];
     echo json_encode($resposta);
     exit;
 }
 
 // Banco de Dados
 $banco =  new BancoDeDados;

 try {
     // Iniciar transação
     $banco->iniciarTransacao();

     // Recuperar detalhes do empréstimo
     $sql = "SELECT id_equipamento, quantidade FROM emprestimos WHERE id_emprestimo = ? AND cancelado = 'n'";
     $parametros = [$id_emprestimo];
     $emprestimo = $banco->consultar($sql, $parametros);

     if (!$emprestimo) {
         throw new Exception("Empréstimo não encontrado ou já devolvido.");
     }

     $id_equipamento = $emprestimo['id_equipamento'];
     $quantidade = $emprestimo['quantidade'];

     // Atualizar o campo cancelado na tabela emprestimos
     $sql = "UPDATE emprestimos SET cancelado = 's' WHERE id_emprestimo = ?";
     $banco->executarComando($sql, $parametros);

     // Atualizar a quantidade de equipamentos
     $sql = "UPDATE equipamentos SET qtd_equipamento = qtd_equipamento + ? WHERE id_equipamento = ?";
     $parametros = [$quantidade, $id_equipamento];
     $banco->executarComando($sql, $parametros);

     // Commit da transação
     $banco->confirmarTransacao();

     // Resposta final
     $resposta = [
         'status'    => 'sucesso',
         'mensagem'  => 'Empréstimo devolvido e quantidade retornou para o estoque!'
     ];
     echo json_encode($resposta);

 } catch (Exception $erro) {
     // Reverter transação em caso de erro
     $banco->voltarTransacao();

     $resposta = [
         'status'    => 'erro',
         'mensagem'  => 'Erro ao devolver empréstimo: ' . $erro->getMessage()
     ];
     echo json_encode($resposta);
 }




