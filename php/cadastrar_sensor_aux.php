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

$EstadoSensor = 0;

$TremSensor = $_POST['TremSensor'];


$stmt = $conn->prepare("SELECT id_trem FROM trens WHERE nome_trem='$TremSensor'");
$stmt->execute();
$ResultadoTrem = $stmt->get_result();
$TremEscolhidoID = $ResultadoTrem->fetch_all(MYSQLI_ASSOC);


foreach ($TremEscolhidoID as $TremEscolhidoIDAux) {

    $TremFinal = $TremEscolhidoIDAux['id_trem'];

}

$stmt = $conn->prepare("INSERT INTO sensores (nome_sensor, tipo_sensor, estado_sensor, trem_sensor) VALUES (?, ?, ?, ?)");

$stmt->bind_param("ssii", $NomeSensor, $TipoSensor, $EstadoSensor, $TremFinal);

if ($stmt->execute()) {

    header("Location: cadastrar_sensor.php");

    exit;

} else {

    echo "Erro ao inserir: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>