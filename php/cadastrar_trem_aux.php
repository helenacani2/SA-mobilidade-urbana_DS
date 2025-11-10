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

$NomeTrem = $_POST['TremNome'];

$FabricanteTrem = $_POST['TremFabricante'];

$FabricacaoTrem = $_POST['TremData'];

$EstacaoTrem = $_POST['TremEstacao'];

$LinhaTrem = $_POST['TremLinha'];

$MaquinistaTrem = $_POST['TremMaquinista'];

echo date("Y-m-d", strtotime($FabricacaoTrem));

$stmt = $conn->prepare("INSERT INTO trens (nome_trem, data_fabricacao_trem, fabricante_trem) VALUES (?, ?, ?)");

$stmt->bind_param("sss", $NomeTrem, $FabricacaoTrem, $FabricanteTrem);

if($stmt->execute()) {

    header("Location: cadastrar_trem.php");

    exit;

} else {

    echo "Erro ao inserir: " . $stmt->error;

}

    $stmt->close();
    $conn->close();


?>