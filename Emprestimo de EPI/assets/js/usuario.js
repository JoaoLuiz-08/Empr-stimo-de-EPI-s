// Login
function entrar() {
    // Pegar os dados
    var usuario = document.getElementById('txt_usuario').value;
    var senha   = document.getElementById('txt_senha').value;
    
    // Função ajax para comunicação assícrona com o servidor 
    $.ajax({
        type: 'post',
        dataType: 'json',
        url: 'src/usuario/login.php',
        data: {
            'usuario'   : usuario,
            'senha'     : senha
        },
        success: function(retorno) {
            if (retorno['status'] == 'sucesso') {
                // Redirecionar para o sistema
                window.location = 'sistema.php';
            } else {
                // Senão, mostrar alerta
                alert(retorno['mensagem']);
            }
        },
        error: function(erro) {
            alert('Ocorreu um erro na requisição: ' + erro);
        }
    });
}


// Sair
function sair() {
    // Confirmar com o usuário se deve sair do sistema
    var confirmou = confirm('Deseja realmente sair do sistema?');
    
    if (confirmou) {
        // Função ajax para comunicação assícrona com o servidor
        $.ajax({
            type: 'post',
            dataType: 'json',
            url: 'src/usuario/logout.php',
            success: function(retorno) {
                // Redirecionar para a tela de login
                window.location = 'index.php';
            },
            error: function(erro) {
                alert('Ocorreu um erro na requisição: ' + erro);
            }
        });
    }
}