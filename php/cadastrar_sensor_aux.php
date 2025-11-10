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

$NomeSensor = $_POST['SensorNome'];

$TipoSensor = $_POST['SensorTipo'];

$TremSensor = $_POST['TremSensor'];

//Código que usa o nome do trem para encontrar o id

$stmt = $conn->prepare("INSERT INTO sensores (nome_sensor, tipo_sensor, estado_sensor, trem_sensor) VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssis", $NomeSensor, $TipoSensor, 0, $TremFinal);

if($stmt->execute()) {

    header("Location: cadastrar_trem.php");

    exit;

} else {

    echo "Erro ao inserir: " . $stmt->error;

}

    $stmt->close();
    $conn->close();


?>