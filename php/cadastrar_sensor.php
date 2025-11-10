<?php

require_once "train_info_bd.php";

session_start();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../midias/logomenor.png" type="icon">
    <link rel="stylesheet" href="../css/cadastrar_trem.css?v=<?php echo time(); ?>">
    <title>Cadastrar novo sensor</title>
</head>

<nav class="menu-hamburguer">
    <input type="checkbox" id="menu-toggle" />
    <label for="menu-toggle" class="menu-icon">☰</label>

    <ul class="menu-opcoes">
        <form method="post">
            <li><a href="pagina_inicial.php">Início</a></li>
            <li><a href="perfil_condutor.php">Perfil</a></li>
            <li><a href="dash_board_geral.php">Dashboard</a></li>
            <li><a href="relatorio_analise.php">Relatórios</a></li>
            <li><a href="central_apoio_condutor.php">Central de Apoio</a></li>
            <li><input type="submit" name="BotaoSair" id="BotaoSair" value="Sair"></li>
        </form>
    </ul>
</nav>

<body>

    <form action="cadastrar_sensor_aux.php" method="POST">

        <label for="SensorNome" class="Legenda">Nome do Sensor</label>

        <input type="text" id="SensorNome" class="Texto" name="SensorNome" required>

        <br>
        <br>

        <label for="SensorTip" class="Legenda">Tipo do Sensor</label>

        <input type="text" id="SensorTipo" class="Texto" name="SensorTip" required>

        <br>
        <br>

        <label for="TremSensor" class="Legenda">Trem Associado</label>

        <select id="TremSensor" class="Texto" name="TremSensor" required>

            <?php

            $sql = "SELECT * FROM trens";
            $ResultadoTrens = $conn->query($sql);

            if ($ResultadoTrens && $ResultadoTrens->num_rows >= 1) {

                $Trens = $ResultadoTrens->fetch_all(MYSQLI_ASSOC);
            }

            foreach ($Trens as $linhaTrens) {

                echo "<option>" . $linhaTrens['nome_trem'] . "</option>";
            }

            ?>

        </select>

        <br>
        <br>

        <input type="submit" id="BotaoEnviar" name="BotaoEnviar">

    </form>

</body>

</html>

<script src="../javascript/teste.js?v=<?php echo time(); ?>"></script>