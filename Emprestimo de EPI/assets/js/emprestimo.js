// Listar
function listarEmprestimos() {
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/emprestimo/selecionarTodos.php',
        success: function(retorno) {
            var tabelaEmprestimos = document.querySelector('#tabela-emprestimos tbody');  // Pegando o corpo da tabela
            tabelaEmprestimos.innerHTML = '';                                             // Limpar o conteúdo da tabela

            // Adicionar as colunas
            var emprestimos = retorno['dados'];
            emprestimos.forEach(function(emprestimo){
                var linha = document.createElement('tr');
                linha.innerHTML = `
                    <td>${emprestimo['id_emprestimo']}</td>
                    <td>${emprestimo['colaborador']}</td>
                    <td>${emprestimo['data']}</td>
                    <td>${emprestimo['equipamento']}</td>
                    <td>${emprestimo['quantidade']}</td>
                    <td>${emprestimo['cancelado']}</td>
                    <td>
                        <button onclick='cancelarEmprestimo(${emprestimo['id_emprestimo']})'>Devolver</button>
                    </td>
                `;

                // Adicionar a linha dentro da tabela
                tabelaEmprestimos.appendChild(linha);
            });
        },
        erro: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

// Salvar
function salvarEmprestimo() {
    // Pegando os dados do formulário
    var idColaborador   = document.getElementById('list_colaborador').value;
    var idEquipamento   = document.getElementById('list_equipamento').value;
    var quantidade      = document.getElementById('txt_quantidade').value;
    
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/emprestimo/inserir.php',
        data: {
            'id_colaborador'    : idColaborador,
            'id_equipamento'    : idEquipamento,
            'quantidade'        : quantidade
        },
        success: function(retorno) {
            alert(retorno['mensagem']);
            if (retorno['status'] == 'sucesso') {
                listarEmprestimos();                                 // Atualizar a listagem de emprestimo
                document.getElementById('form-emprestimo').reset();  // Limpar o formulário
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

// Cancelar
function cancelarEmprestimo(idEmprestimo) {
    // Confirmar com o usuário se deve cancelar o empréstimo
    var confirmou = confirm('Tem certeza que quer devolver este emprestimo?');
    if (confirmou) {
        // Função ajax para comunicação assícrona com o servidor
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'src/emprestimo/cancelar.php',
            data: {
                'id_emprestimo': idEmprestimo
            },
            success: function(retorno) {
                alert(retorno['mensagem']);
                if (retorno['status'] == 'sucesso') {
                    listarEmprestimos();                                 // Atualizar a listagem de emprestimo
                }
            },
            error: function(erro) {
                alert('Ocorreu um erro na requisição: ' + erro);
            }
        });
    }
}

// Listar colaborador na tag <select>
function listarColaboradoresSelect() {
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/colaborador/selecionarTodos.php',
        success: function(retorno) {
            var listColaborador = document.querySelector('#list_colaborador');  // Pegando o campo <select> list_colaborador
            listColaborador.innerHTML = '';                                     // Limpar o conteúdo do campo

            // Adicionar as opções
            var colaboradores = retorno['dados'];
            var options = [];
            colaboradores.forEach(function(colaborador){
                options.push(`<option value="${colaborador['id_colaborador']}">${colaborador['nome']}</option>`);
            });

            // Adicionar as <options> dentro do <select>
            listColaborador.innerHTML = options;
        },
        erro: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}

// Listar equipamentos na tag <select>
function listarEquipamentosSelect() {
    // Função ajax para comunicação assícrona com o servidor
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/equipamento/selecionarTodos.php',
        success: function(retorno) {
            var listEquipamento = document.querySelector('#list_equipamento');  // Pegando o campo <select> list_equipamento
            listEquipamento.innerHTML = '';                                     // Limpar o conteúdo do campo

            // Adicionar as opções
            var equipamentos = retorno['dados'];
            var options = [];
            equipamentos.forEach(function(equipamento){
                options.push(`<option value="${equipamento['id_equipamento']}">${equipamento['nome']}</option>`);
            });

            // Adicionar as <options> dentro do <select>
            listEquipamento.innerHTML = options;
        },
        erro: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}