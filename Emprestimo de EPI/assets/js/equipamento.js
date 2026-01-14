// Listar
function listarEquipamentos() {
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/equipamento/selecionarTodos.php',
        success: function(retorno) {
            var tabelaEquipamentos = document.querySelector('#tabela-equipamentos tbody');  // Pegando o corpo da tabela
            tabelaEquipamentos.innerHTML = '';                                              // Limpar o conteúdo da tabela

            // Adicionar as colunas
            var equipamentos = retorno['dados'];
            equipamentos.forEach(function(equipamento){
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${equipamento['id_equipamento']}</td>
                    <td>${equipamento['nome']}</td>
                    <td>${equipamento['descricao']}</td>
                    <td>${equipamento['qtd_equipamento']}</td>
                    <td>
                        <button onclick='carregarEquipamento(${equipamento['id_equipamento']})'>Alterar</button>
                        <button onclick='excluirEquipamento(${equipamento['id_equipamento']})'>Excluir</button>
                    </td>
                `;

                // Adicionar a linha dentro da tabela
                tabelaEquipamentos.appendChild(linha);
            });
        },
        erro: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}


// Salvar
function salvarEquipamento() {
    // Pegando os dados do formulário
    var id          = document.getElementById('txt_id').value;
    var nome        = document.getElementById('txt_nome').value;
    var descricao   = document.getElementById('txt_descricao').value;
    var quantidade  = document.getElementById('txt_quantidade').value;
    var url         = (id == 'NOVO') ? 'src/equipamento/inserir.php' : 'src/equipamento/atualizar.php';
    
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: url,
        data: {
            'id'        : id,
            'nome'      : nome,
            'descricao' : descricao,
            'quantidade': quantidade
        },
        success: function(retorno) {
            alert(retorno['mensagem']);
            if (retorno['status'] == 'sucesso') {
                listarEquipamentos();                                   // Atualizar a listagem de equipamentos
                document.getElementById('form-equipamento').reset();    // Limpar o formulário
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

// Carregar
function carregarEquipamento(idEquipamento) {
    // Função ajax para comunicação assícrona com o servidor 
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/equipamento/selecionar.php',
        data: {
            'id_equipamento': idEquipamento,
        },
        success: function(retorno) {
            if (retorno['status'] == 'sucesso') {
                // Imprimir os dados do equipamento no formuláio
                document.getElementById('txt_id').value         = retorno['dados']['id_equipamento'];
                document.getElementById('txt_nome').value       = retorno['dados']['nome'];
                document.getElementById('txt_descricao').value  = retorno['dados']['descricao'];
                document.getElementById('txt_quantidade').value = retorno['dados']['qtd_equipamento'];
            } else {
                // senão, mostra uma mensagem de erro
                alert(retorno['mensagem']);
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

// Excluir
function excluirEquipamento(idEquipamento) {
    // Confirmar com o usuário se deve excluir o equipamento
    var confirmou = confirm('Tem certeza que quer excluir este equipamento?');
    
    if (confirmou) {
        // Função ajax para comunicação assícrona com o servidor 
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'src/equipamento/excluir.php',
            data: {
                'id_equipamento': idEquipamento,
            },
            success: function(retorno) {
                alert(retorno['mensagem']);
                
                if (retorno['status'] == 'sucesso') {
                    listarEquipamentos();   // Atualizar a listagem de equipamentos
                }
            },
            error: function(erro) {
                alert('Ocorreu um erro na requisição: ' + erro);
            }
        });
    }
}