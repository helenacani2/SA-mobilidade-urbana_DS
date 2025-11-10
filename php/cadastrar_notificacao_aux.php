<?php

session_start();

require_once "train_info_bd.php";

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {

    header("Location: pagina_login.php");

    exit;
}

if ($_SESSION["cargo_funcionario"] != "Gerente") {

    header("Location: pagina_login.php");

    exit;
}

$TituloNotificacao = $_POST['NotificacaoTitulo'];

$MensagemNotificacao = $_POST['NotificacaoMensagem'];

$stmt = $conn->prepare("INSERT INTO notificacao (titulo_notificacao, mensagem_notificacao) VALUES (?, ?)");

$stmt->bind_param("ss", $TituloNotificacao, $MensagemNotificacao);

if($stmt->execute()) {

    header("Location: cadastrar_notificacao.php");

    exit;

} else {

    echo "Erro ao inserir: " . $stmt->error;

}

    $stmt->close();
    $conn->close();


?>