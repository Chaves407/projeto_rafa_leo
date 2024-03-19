<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "db/conexao.php";

$msg_error = "";

// Função para enviar e-mail
function enviarEmail($destinatario, $assunto, $mensagem) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lg928980@gmail.com'; // Insira seu e-mail aqui
        $mail->Password   = 'pyla wuqh mfqe huqc'; // Insira sua senha aqui
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Remetente
        $mail->setFrom('lg928980@gmail.com', 'Agenda');

        // Destinatário
        $mail->addAddress($destinatario);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body    = $mensagem;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Erro ao enviar e-mail: " . $mail->ErrorInfo);
        return false;
    }
}

// Função para gerar um código de verificação
function gerarCodigoVerificacao() {
    return substr(md5(uniqid(rand(), true)), 0, 8);
}

if(isset($_POST["emailUser"])) {
    $emailUser = mysqli_escape_string($conexao, $_POST["emailUser"]);

    // Verificar se o e-mail é válido
    if (filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
        // Gerar um código de verificação
        $codigo_verificacao = gerarCodigoVerificacao();

        // Atualizar o código na tabela "loginuser"
        $sql_update = "UPDATE loginuser SET keyUser = ? WHERE emailUser = ?";
        $stmt_update = $conexao->prepare($sql_update);
        
        // Verificar se a preparação da consulta foi bem-sucedida
        if ($stmt_update) {
            $stmt_update->bind_param("ss", $codigo_verificacao, $emailUser);
            $stmt_update->execute();

            // Enviar e-mail de verificação
            $assunto_email = "Sistema de Agenda - Confirmação de E-mail";
            $mensagem_email = "<p>Obrigado por utilizar o Sistema de Agenda. Para confirmar seu acesso, clique no link abaixo:</p>";
            $mensagem_email .= "<p><a href='http://localhost/chat/confimacaoEmail.php?codigo=$codigo_verificacao'>Confirmar E-mail</a></p>";
            $mensagem_email .= "<p>Se você não solicitou acesso ao sistema, ignore este e-mail.</p>";
            
            // Envia o e-mail
            if(enviarEmail($emailUser, $assunto_email, $mensagem_email)) {
                // Redireciona para a página de confirmação de e-mail
                header("Location: confirmacaoEmail.php");
                exit;
            } else {
                // Se houver erro no envio do e-mail
                $msg_error = "<div class='alert alert-danger mt-3'>
                                <p>Ocorreu um erro ao enviar o e-mail de verificação. Por favor, tente novamente mais tarde.</p>
                              </div>";
            }
        } else {
            // Se houver um erro na preparação da consulta
            $msg_error = "<div class='alert alert-danger mt-3'>
                            <p>Ocorreu um erro ao preparar a consulta: ".$conexao->error."</p>
                          </div>";
        }
    } else {
        // Se o e-mail não for válido
        $msg_error = "<div class='alert alert-danger mt-3'>
                        <p>O e-mail inserido não é válido.</p>
                      </div>";
    }
}
?>

