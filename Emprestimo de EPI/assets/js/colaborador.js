// Listar
function listarColaboradores() {
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/colaborador/selecionarTodos.php',
        success: function(retorno) {
            var tabelaColaboradores = document.querySelector('#tabela-colaboradores tbody');  // Pegando o corpo da tabela
            tabelaColaboradores.innerHTML = '';                                               // Limpar o conteúdo da tabela

            // Adicionar as colunas
            var colaboradores = retorno['dados'];
            colaboradores.forEach(function(colaborador){
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${colaborador['id_colaborador']}</td>
                    <td>${colaborador['nome']}</td>
                    <td>${colaborador['cpf']}</td>
                    <td>${colaborador['sexo']}</td>
                    <td>${colaborador['idade']}</td>
                    <td>
                        <button onclick='carregarColaborador(${colaborador['id_colaborador']})'>Alterar</button>
                        <button onclick='excluirColaborador(${colaborador['id_colaborador']})'>Excluir</button>
                    </td>
                `;

                // Adicionar a linha dentro da tabela
                tabelaColaboradores.appendChild(linha);
            });
        },
        erro: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}


// Salvar
function salvarColaborador() {
    // Pegando os dados do formulário
    var id      = document.getElementById('txt_id').value;
    var nome    = document.getElementById('txt_nome').value;
    var cpf     = document.getElementById('txt_cpf').value;
    var sexo  = document.getElementById('list_sexo').value;
    var idade      = document.getElementById('txt_idade').value;
    var url     = (id == 'NOVO') ? 'src/colaborador/inserir.php' : 'src/colaborador/atualizar.php';
    
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: url,
        data: {
            'id'    : id,
            'nome'  : nome,
            'cpf'   : cpf,
            'sexo'  : sexo,
            'idade' : idade
        },
        success: function(retorno) {
            alert(retorno['mensagem']);
            if (retorno['status'] == 'sucesso') {
                listarColaboradores();                                   // Atualizar a listagem de colaboradores
                document.getElementById('form-colaborador').reset();    // Limpar o formulário
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

// Carregar
function carregarColaborador(idColaborador) {
    // Função ajax para comunicação assícrona com o servidor 
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/colaborador/selecionar.php',
        data: {
            'id_colaborador': idColaborador,
        },
        success: function(retorno) {
            if (retorno['status'] == 'sucesso') {
                // Imprimir os dados do colaborador no formuláio
                document.getElementById('txt_id').value     = retorno['dados']['id_colaborador'];
                document.getElementById('txt_nome').value   = retorno['dados']['nome'];
                document.getElementById('txt_cpf').value    = retorno['dados']['cpf'];
                document.getElementById('list_sexo').value  = retorno['dados']['sexo'];
                document.getElementById('txt_idade').value  = retorno['dados']['idade'];
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
function excluirColaborador(idColaborador) {
    // Confirmar com o usuário se deve excluir o colaborador
    var confirmou = confirm('Tem certeza que quer excluir este colaborador?');
    
    if (confirmou) {
        // Função ajax para comunicação assícrona com o servidor 
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'src/colaborador/excluir.php',
            data: {
                'id_colaborador': idColaborador,
            },
            success: function(retorno) {
                alert(retorno['mensagem']);
                
                if (retorno['status'] == 'sucesso') {
                    listarColaboradores();   // Atualizar a listagem de colaboradores
                }
            },
            error: function(erro) {
                alert('Ocorreu um erro na requisição: ' + erro);
            }
        });
    }
}