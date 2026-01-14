<?php
    // Destruindo a sessão
    session_start();
    session_destroy();

    // Resposta
    $resposta = [
        'status' => 'sucesso'
    ];
    echo json_encode($resposta);