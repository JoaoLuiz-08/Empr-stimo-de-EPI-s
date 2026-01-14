// Carregar tela
function carregarTela(url) {
    // Acionar o ajax para carregar a tela
    $.ajax({
        type: 'post',
        dataType: 'html',
        url: url,
        success: function(retorno){
            // Imrpimir o retorno dentro da tag <main>
            document.querySelector('main').innerHTML = retorno;

            // Verificar qual tela foi carregada e acionar
            // a função correta para listar os registros no CRUD
            switch (url) {
                case 'telas/colaboradores.php':
                    listarColaboradores();
                    break;
                case 'telas/equipamentos.php':
                    listarEquipamentos();
                    break;
                case 'telas/emprestimos.php':
                    listarEmprestimos();
                    listarColaboradoresSelect();
                    listarEquipamentosSelect();
                    break;
            }
        },
        error: function(erro) {
            document.querySelector('main').innerHTML = '<h1>Conteúdo não encontrado!</h1>';
        }
    });
}