<?php

require_once "train_info_bd.php";

session_start();

$stmt = $conn->prepare("SELECT * FROM notificacao");
$stmt->execute();

$resultado = $stmt->get_result();

$notificacao = $resultado->fetch_all(MYSQLI_ASSOC);

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {

    header("Location: pagina_login.php");

    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['BotaoSair'])) {

        session_unset();

        session_destroy();

        header("Location: pagina_login.php");
    }
}

$query_ids = "SELECT id_manutencao, resolvido_manutencao FROM manutencao WHERE resolvido_manutencao IN ('Não', 'Andamento')";

$stmt_ids = $conn->prepare($query_ids);
$stmt_ids->execute();
$resultado_ids = $stmt_ids->get_result();
$registros_manutencao = $resultado_ids->fetch_all(MYSQLI_ASSOC);

foreach ($registros_manutencao as $registro) {
    $id_manutencao = $registro['id_manutencao'];
    $status_atual = $registro['resolvido_manutencao'];

    // de não para andamento
    if ($status_atual === 'Não' && isset($_POST["BotaoIniciar$id_manutencao"])) {
        $sql = "UPDATE manutencao SET resolvido_manutencao='Andamento' WHERE id_manutencao = $id_manutencao";
        $conn->query($sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    // de andamento para sim
    if ($status_atual === 'Andamento' && isset($_POST["BotaoFinalizar$id_manutencao"])) {
        $sql = "UPDATE manutencao SET resolvido_manutencao='Sim' WHERE id_manutencao = $id_manutencao";
        $conn->query($sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
?>

<!DOCTYPE html>

<html lang="pt_BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../midias/logomenor.png" type="icon"> <!-- Ícone da aba do navegador -->
    <title>Monitoramento Manutenção</title>
    <link rel="stylesheet" href="../css/monitoramento_manutencao.css?v=<?php echo time(); ?>">
</head>

<body onload="Comeco()">
    <header>
        <!--buton tem 3 pra poder controlar pelo CSS-->
        <br>
        <h1>Manutenção</h1>
        <div id="butoesjuntos">
            <div id="buton1" onclick="NaoIniciado()">
                <button>Não Iniciado</button>
            </div>
            <div id="buton2" onclick="Fazendo()">
                <button>Fazendo</button>
            </div>
            <div id="buton3" onclick="Finalizado()">
                <button>Finalizado</button>
            </div>
        </div>
        <br>

    </header>

    <nav class="menu-hamburguer">
        <input type="checkbox" id="menu-toggle" />
        <label for="menu-toggle" class="menu-icon">☰</label>

        <ul class="menu-opcoes">
            <form method="post">
                <li><a href="pagina_inicial.php">Início</a></li>
                <li><a href="perfil_condutor.php">Perfil</a></li>
                <li><a href="gestao_rotas.php">Rotas</a></li>
                <li><a href="dash_board_geral.php">Dashboard</a></li>
                <li><a href="relatorio_analise.php">Relatórios</a></li>
                <li><a href="central_apoio_condutor.php">Central de Apoio</a></li>
                <li><input type="submit" name="BotaoSair" id="BotaoSair" value="Sair"></li>
            </form>
        </ul>
    </nav>

    <section id="trens">

        <!-- Cabeçalho principal -->
        <div id="table1">
            <div id="table2">
                <h3>Trens</h3>
            </div>
            <div id="table3">
                <h3>Status dos trens</h3>
            </div>
        </div>

        <!-- Cabeçalhos das colunas -->

        <!-- Linhas de dados dos trens -->
        <section id="NaoIniciado">
            <form method="POST">
                <div id="divbody">
                    <div id="table4">
                        <h2>Nome Trem</h2>
                        <?php

                        $stmt = $conn->prepare("SELECT m.id_manutencao, m.problema_manutencao, t.nome_trem FROM manutencao AS m INNER JOIN trens AS t ON trem_manutencao = id_trem WHERE m.resolvido_manutencao = 'Não'");
                        $stmt->execute();
                        $resultado = $stmt->get_result();
                        $manutencao_nao_iniciada = $resultado->fetch_all(MYSQLI_ASSOC);
                        $NumeroDeManutencao_NI = $resultado->num_rows;

                        if (!empty($manutencao_nao_iniciada)) {
                            $contador = 0;
                            foreach ($manutencao_nao_iniciada as $trem) {
                                echo '<div class="registro-manutencao">';
                                echo '<h3>' . $trem['nome_trem'] . '</h3>';
                                echo '</div>';
                                if ($contador < $NumeroDeManutencao_NI - 1) echo '<hr>';
                                $contador++;
                            }
                        } else {
                            echo '<div class="registro-manutencao"><h3>Nenhum registro pendente.</h3></div>';
                        }
                        ?>
                    </div>

                    <div id="table5">
                        <h2>Problema / Ação</h2>
                        <?php


                        if (!empty($manutencao_nao_iniciada)) {
                            $contador = 0;
                            foreach ($manutencao_nao_iniciada as $trem) {
                                $id_manutencao = $trem['id_manutencao'];
                                echo '<div class="registro-manutencao">';
                                echo '<h3>' . $trem['problema_manutencao'] . '</h3>';
                                echo '</div>';

                                if (($_SESSION["cargo_funcionario"] == "Gerente") || ($_SESSION["cargo_funcionario"] == "Equipe_Manutencao")) {
                                    echo "<input type='submit' value='Marcar como Fazendo' name='BotaoIniciar$id_manutencao' class='botao-iniciar'>";
                                    echo '<br>';
                                    echo '</div>';
                                }

                                if ($contador < $NumeroDeManutencao_NI - 1) echo '<hr>';
                                $contador++;
                            }
                        } else {
                            echo '<div class="registro-manutencao"><h3>-</h3></div>';
                        }
                        ?>
                    </div>
                </div>
            </form>
        </section>

        <section id="Fazendo">
            <form method="POST">
                <div id="divbody">
                    <div id="table4">
                        <h2>Nome Trem</h2>
                        <?php
                        $stmt = $conn->prepare("SELECT m.id_manutencao, m.problema_manutencao, t.nome_trem FROM manutencao AS m INNER JOIN trens AS t ON trem_manutencao = id_trem WHERE m.resolvido_manutencao = 'Andamento'");
                        $stmt->execute();

                        $resultado = $stmt->get_result();
                        $manutencao_andamento = $resultado->fetch_all(MYSQLI_ASSOC);

                        $NumeroDeManutencao_Andamento = $resultado->num_rows;

                        if (!empty($manutencao_andamento)) {
                            $contador = 0;
                            foreach ($manutencao_andamento as $trem) {
                                echo '<div class="registro-manutencao">';
                                echo '<h3>' . $trem['nome_trem'] . '</h3>';
                                echo '</div>';
                                if ($contador < $NumeroDeManutencao_Andamento - 1) echo '<hr>';
                                $contador++;
                            }
                        } else {
                            echo '<div class="registro-manutencao"><h3>Nenhum registro em andamento.</h3></div>';
                        }
                        ?>
                    </div>

                    <div id="table5">
                        <h2>Problema / Ação</h2>
                        <?php

                        if (!empty($manutencao_andamento)) {
                            $contador = 0;
                            foreach ($manutencao_andamento as $trem) {
                                $id_manutencao = $trem['id_manutencao'];
                                echo '<div class="registro-manutencao">';
                                echo '<h3>' . $trem['problema_manutencao'] . '</h3>';
                                echo '</div>';

                                if (($_SESSION["cargo_funcionario"] == "Gerente") || ($_SESSION["cargo_funcionario"] == "Equipe_Manutencao")) {
                                    echo "<input type='submit' value='Marcar como Finalizado' name='BotaoFinalizar$id_manutencao' class='botao-finalizar'>";
                                    echo '</div>';
                                }

                                if ($contador < $NumeroDeManutencao_Andamento - 1) {
                                    echo '<hr>';
                                    $contador++;
                                } else {
                                    echo '<div class="registro-manutencao"><h3>-</h3></div>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </form>
        </section>

        <section id="Finalizado">
            <div id="divbody">
                <div id="table4">
                    <h2>Nome Trem</h2>
                    <?php
                    $stmt = $conn->prepare("SELECT m.problema_manutencao, t.nome_trem FROM manutencao AS m INNER JOIN trens AS t ON trem_manutencao = id_trem WHERE m.resolvido_manutencao = 'Sim'");
                    $stmt->execute();

                    $resultado = $stmt->get_result();
                    $manutencao_finalizada = $resultado->fetch_all(MYSQLI_ASSOC);

                    $NumeroDeManutencao_Finalizada = $resultado->num_rows;

                    if (!empty($manutencao_finalizada)) {
                        $contador = 0;
                        foreach ($manutencao_finalizada as $trem) {
                            echo '<div class="registro-manutencao">';
                            echo '<h3>' . $trem['nome_trem'] . '</h3>';
                            echo '</div>';
                            if ($contador < $NumeroDeManutencao_Finalizada - 1) echo '<hr>';
                            $contador++;
                        }
                    } else {
                        echo '<div class="registro-manutencao"><h3>Nenhum registro finalizado.</h3></div>';
                    }
                    ?>
                </div>

                <div id="table5">
                    <h2>Problema</h2>
                    <?php

                    if (!empty($manutencao_finalizada)) {
                        $contador = 0;
                        foreach ($manutencao_finalizada as $trem) {
                            echo '<div class="registro-manutencao">';
                            echo '<h3>' . $trem['problema_manutencao'] . '</h3>';

                            echo '</div>';
                            if ($contador < $NumeroDeManutencao_Finalizada - 1) echo '<hr>';
                            $contador++;
                        }
                    } else {
                        echo '<div class="registro-manutencao"><h3>-</h3></div>';
                    }
                    ?>
                </div>
            </div>
        </section>


        <div id="table1">
            <div id="table2">
                <h3>Notificações</h3>
            </div> <!--Área das notificações-->
            <div id="table3">
                <h3>Em tempo real</h3>
            </div>
        </div>
        <div id="white">
            <br>

            <?php

            if (!empty($notificacao)) {

                foreach ($notificacao as $notificacoes) {
                    echo '<hr>';
                    echo '<h4>' . $notificacoes['titulo_notificacao'] . '</h4>';
                    echo '<div class="notificacao">';
                    echo '<h5>' . $notificacoes['mensagem_notificacao'] . '</h5>';
                    echo '<h6>' . $notificacoes['data_notificacao'] . '</h6><hr>';
                    echo '</div>';
                    /* echo '<hr>'; */
                }
            }

            ?>

            <br>
        </div>

    </section>

    <section id="reportar_problema">

        <div id="table1_centro">
            <div id="table2_centro">
                <h3>Reportar problemas</h3>
            </div>
        </div>
        <div id="white_centro">

            <div class="white">

                <img
                    src="https://portais.univasf.edu.br/reitoria/imagens/03756058d18f4250bfeac9f5074209f1.png/@@images/a02cbd53-ddcd-4503-9013-4b3e08be317f.png">
                <a href="central_apoio_condutor.php">Central de Apoio ao Condutor</a>
            </div>

            <div class="white">
                <img
                    src="https://images.icon-icons.com/1744/PNG/512/3643728-balloon-chat-conversation-speak-word_113413.png">
                <a href="central_de_manutencao.php">Central de Manutenção</a>
            </div>

        </div>

    </section>

</body>
<script src="../javascript/monitoramento.js?v=<?php echo time(); ?>"></script>
<script src="../javascript/teste.js?v=<?php echo time(); ?>"></script>

</html>