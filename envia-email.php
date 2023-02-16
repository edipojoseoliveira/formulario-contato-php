<?php
    session_start();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $assunto = 'Contato pelo site';
    $destinatario = 'seu_email@mail.com';
    
    /*
    //Enviando o e-mail do jeito simples
    $headers = 'From: ' . $email;
    mail($destinatario, $assunto, $mensagem, $headers);
    */

    //Enviando o e-mail usando o PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);
    
    try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'seu_email@mail.com';
        $mail->Password   = 'sua_senha';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        //Destinatario
        $mail->setFrom($email, $nome);
        $mail->addAddress($destinatario, 'Nome');
        
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body = '<b>Nome</b>: ' . $nome . '<br/>' 
        . '<b>E-mail</b>: ' . $email . '<br/>' 
        . '<b>Mensagem</b>: ' . $mensagem;
        
        $mail->CharSet = 'UTF-8';
        
        $mail->send();
        $_SESSION['mensagem-sucesso'] = 'A mensagem foi enviada.';
    } catch (Exception $e) {
        $_SESSION['mensagem-erro'] = 'A mensagem não pode ser enviada. ' . $e->getMessage();
    }

    //Volta para a mesma página
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
?>