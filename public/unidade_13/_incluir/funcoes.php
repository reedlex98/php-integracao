<?php 
    function enviarMensagem($dados){
        $nome_usuario = $dados['nome'];
        $email_usuario = $dados['email'];
        $mensagem_usuario = $dados['mensagem'];

        $destino = "elder_louzada@outlook.com";
        $remetente = "elder_louzada@outlook.com";
        $assunto = 'Mensagem do site' ;

        $mensagem = 'Usuario: {$nome_usuario} <br>';
        $mensagem .= 'Email: {$email_usuario} <br>';
        $mensagem .= 'Mensagem: <br> {$mensagem_usuario}';

        
        return mail($destino,$assunto,$mensagem,$remetente);
    }
?>