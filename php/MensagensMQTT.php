<?php
require("phpMQTT.php");

require 'env.php';


loadEnv(__DIR__ . '/.env');

$host = getenv('BROKER_URL');
$port = getenv('BROKER_PORT');
$user = getenv('BROKER_USER');
$pass = getenv('BROKER_PASS');                              

$topic = "TopicoTeste";
$client_id = "phpmqtt-" . rand();

$cafile = __DIR__ . "/cacert.pem";
$message = "";













$mqtt = new Bluerhinos\phpMQTT($host, $port, $client_id);

$mqtt->cafile = $cafile;

if (!$mqtt->connect(true, NULL, $user, $pass)) {
    echo "Não foi possível conectar ao broker";
    exit;
}

// Subscribing e coletando mensagens por 1-2 segundos
$mqtt->subscribe([
    $topic => [
        "qos" => 0,
        "function" => function ($topic, $msg) use (&$message) {
            if (!empty($msg)) {
                $message = $msg;
            }
        }
    ]
], 0);

$start = time();
while (time() - $start < 2) { // escuta 2 segundos
    $mqtt->proc();
}

$mqtt->close();

echo $message;  

?>