<?php

require_once "train_info_bd.php";

session_start();

if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {

    header("Location: pagina_login.php");

    exit;
}

$stmt = $conn->prepare("SELECT s.id_sensor, s.nome_sensor, s.tipo_sensor, s.estado_sensor, t.nome_trem FROM sensores AS s INNER JOIN trens AS t ON trem_sensor = id_trem");

$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado && $resultado->num_rows >= 1) {

    $sensores = $resultado->fetch_all(MYSQLI_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['BotaoSair'])) {

        session_unset();

        session_destroy();

        header("Location: pagina_login.php");
    }




    foreach ($sensores as $linhaSensores) {

        $Contador = $linhaSensores['id_sensor'];


        if (isset($_POST["Editar$Contador"])) {

            $stmt = $conn->prepare("SELECT s.id_sensor, s.nome_sensor, s.tipo_sensor, s.estado_sensor, t.nome_trem FROM sensores AS s INNER JOIN trens AS t ON trem_sensor = id_trem WHERE s.id_sensor='$Contador'");

            $stmt->execute();

            $resultado = $stmt->get_result();

            if ($resultado && $resultado->num_rows >= 1) {

                $sensores = $resultado->fetch_all(MYSQLI_ASSOC);
            }


            echo '
           
           <div class="PopUp">
           
                <form method="POST" class="PopUpConteudo">

                <table>

                    <thead>

                        <tr>

                            <th class="cellHead">ID</th>

                            <th class="cellHead">Nome</th>

                            <th class="cellHead">Tipo</th>

                            <th class="cellHead">Trem</th>

                        </tr>

                    </thead>

                    <tbody>';

                        

                        if (!empty($sensores)) {

                            foreach ($sensores as $linha) {

                                $ValorSensor = $linha["id_sensor"];

                                echo "

                                <tr>

                                    <td class='cell'>$linha[id_sensor]</td>

                                    <td class='cell'><input type='text' name='EditarNome$linha[id_sensor]' class='TextoEditar'></td>

                                    <td class='cell'><input type='text' name='EditarTipo$linha[id_sensor]' class='TextoEditar'></td>

                                    <td class='cell'>
                                    
                                        <select name='EditarTrem$linha[id_sensor]' class='SelectEditar'>";
                                        
                                        
                                        $sql = "SELECT * FROM trens";
                                        $ResultadoTrens = $conn->query($sql);

                                        if ($ResultadoTrens && $ResultadoTrens->num_rows >= 1) {

                                            $Trens = $ResultadoTrens->fetch_all(MYSQLI_ASSOC);

                                        }

                                            foreach ($Trens as $linhaTrens) {

                                                echo "<option>" . $linhaTrens['nome_trem'] . "</option>";

                                            }



                                        echo "</select>
                                    
                                    </td>

                                </tr>
                                
                                <input class='Botao' type='submit' value='Editar' name='EditarFinal$ValorSensor'>

                                <input class='Botao' type='submit' value='Cancelar' name='CancelarEdicao'>

                                ";
                            }
                        }

                        echo "
                    
                        
                    </tbody>
                </table>

            </form>
           
           </div>
           
           ";



            $_POST["Editar$Contador"] = NULL;

            

        }



        if(isset($_POST["EditarFinal$Contador"])) {

            $NovoNome = $_POST["EditarNome$Contador"];
            $NovoTipo = $_POST["EditarTipo$Contador"];

            $TremSelecionado = $_POST["EditarTrem$Contador"];



            $sql = "SELECT * FROM trens WHERE nome_trem='$TremSelecionado'";
            $ResultadoTrens = $conn->query($sql);

            if ($ResultadoTrens && $ResultadoTrens->num_rows >= 1) {

                $TremEscolhido = $ResultadoTrens->fetch_assoc();

            }

            $NovoTrem = $TremEscolhido["id_trem"];

            
            

            $sql = "UPDATE sensores SET nome_sensor='$NovoNome', tipo_sensor='$NovoTipo', trem_sensor='$NovoTrem' WHERE id_sensor = $Contador";
            $conn->query($sql);

            header("Location: relatorio_analise.php");

        }

        if(isset($_POST["CancelarEdicao"])) {

            $_POST["Editar$Contador"] = NULL;

            header("Location: relatorio_analise.php");

        }




        if (isset($_POST["Excluir$Contador"])) {



            echo '
           
            <div class="PopUp">
           
                <form method="POST" class="PopUpConteudo">

                    <h1>Deseja mesmo deletar ' . $linhaSensores['nome_sensor'] . '? Isso não poderá ser desfeito<h1>

                    <br>

                    <input class="BotaoDeletar" type="submit" name="Excluir" value="Excluir">
                    <input class="BotaoDeletar" type="submit" name="CancelarExclusao" value="Cancelar">

                </form>

            </div>
            
            
           ';




        }


        if(isset($_POST["Excluir"])) {

            $sql = "DELETE FROM sensores WHERE id_sensor='$Contador'";
            $conn->query($sql);

            $_POST["Excluir$Contador"] = NULL;
            $_POST["Excluir"] = NULL;

            header("Location: relatorio_analise.php");

        }


        if(isset($_POST["CancelarExclusao"])) {

            $_POST["Excluir$Contador"] = NULL;
            $_POST["Excluir"] = NULL;

            header("Location: relatorio_analise.php");

        }



    }
}

$ValG1_1 = rand(0, 300);
$ValG1_2 = rand(0, 300);
$ValG1_3 = rand(0, 300);
$ValG1_4 = rand(0, 300);
$ValG1_5 = rand(0, 300);    //Esses valores são Placoholders que serão substituídos quando acontecer progresso na SA de IoT
$ValG1_6 = rand(0, 300);    //Isso foi feito para facilitar a aplicação dos dados de sensores quando os mesmos estiverem prontos
$ValG1_7 = rand(0, 300);
$ValG1_8 = rand(0, 300);
$ValG1_9 = rand(0, 300);
$ValG1_10 = rand(0, 300);
$ValG1_11 = rand(0, 300);


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../midias/logomenor.png" type="icon"> <!-- Ícone da aba do navegador -->
    <title>Relatório e Análises</title>
    <link rel="stylesheet" href="../css/relatorio_analise.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <nav class="menu-hamburguer">
            <input type="checkbox" id="menu-toggle" />
            <label for="menu-toggle" class="menu-icon">☰</label>

            <ul class="menu-opcoes">
                <form method="post">
                    <li><a href="pagina_inicial.php">Início</a></li>
                    <li><a href="perfil_condutor.php">Perfil</a></li>
                    <li><a href="gestao_rotas.php">Rotas</a></li>
                    <li><a href="dash_board_geral.php">Dashboard</a></li>
                    <li><a href="central_apoio_condutor.php">Central de Apoio</a></li>
                    <li><input type="submit" name="BotaoSair" id="BotaoSair" value="Sair"></li>
                </form>
            </ul>
            <div class="configura_topo">
                <p id="titulo">Relatório e Análise</p>
                <br>
            </div>
        </nav>
        <div class="teste1">
            <div>
                <a href="" class="botoes_topo">Anual</a>
            </div>
            <div>
                <a href="" class="botoes_topo">Mensal</a>
            </div>
            <div>
                <a href="" class="botoes_topo">Semanal</a>
            </div>
        </div>
    </header>


    <main>
        <section id="relatorio_de_ganho" id="ganhoTotal">

            <div id="anual" class="bordaRelatorio">
                <div>
                    <p class="titulorelatorio">Ano</p>
                </div>
                <div>
                    <p class="valor_dinheiro">R$000.000,00</p>
                </div>
                <div>
                    <p>00,00%</p>
                </div>
            </div>
            <div id="mensal" class="bordaRelatorio">
                <div>
                    <p class="titulorelatorio">Mensal</p>
                </div>
                <div>
                    <p class="valor_dinheiro">R$00.000,00</p>
                </div>
                <div> <!--Valores-->
                    <p>00,00%</p>
                </div>
            </div>
            <div id="semanal" class="bordaRelatorio">
                <div>
                    <p class="titulorelatorio">Semanal</p>
                </div>
                <div>
                    <p class="valor_dinheiro">R$00.000,00</p>
                </div>
                <div>
                    <p>00,00%</p>
                </div>
            </div>
        </section>

        <section id="saldoGeral" class="graficoEstilo">
            <div class="posicaoTitulo">Saldo Anual - Tempo real</div>

            <div class="tamanhoGrafico">
                <canvas id="graficoAnual"></canvas>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                <?php echo "
                const ctx = document.getElementById('graficoAnual');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['00hrs', '01hrs', '02hrs', '03hrs', '04hrs', '05hrs', '06hrs', '07hrs', '08hrs', '09hrs', '10hrs', '11hrs', '12hrs', '13hrs', '14hrs', '15hrs', '16hrs', '17hrs', '18hrs', '19hrs', '20hrs', '21hrs', '22hrs', '23hrs'],
                        datasets: [{
                            label: 'km/h',
                            data: [$ValG1_1, $ValG1_2, $ValG1_3, $ValG1_4, $ValG1_5, $ValG1_6, $ValG1_7, $ValG1_8, $ValG1_9, $ValG1_10, $ValG1_11, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 300, 0],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
                "; ?>
            </script>
        </section><!--Grafico-->

        <section id="investidores" class="bordaStatus"> <!--Seção dos investidores-->
            <p class="posicaoTitulo">Investidores</p>

            <div class="pessoas">

                <div>
                    <img class="imagemForm" src="../midias/juju.webp">
                </div>
                <div class="textoInvestidores">
                    <p class="grifar">Julia Caroline Pereira</p>
                    <p class="normal">@Divas2025 </p>
                </div>

            </div>
            <div class="pessoas">

                <div>
                    <img class="imagemForm" src="../midias/ewerton.webp">
                </div>
                <div class="textoInvestidores">
                    <p class="grifar">Éwerton de Oliveira Cercal</p>
                    <p class="normal">@sorEwerton </p>
                </div>

            </div>
            <div class="pessoas">

                <div>
                    <img class="imagemForm" src="../midias/jnifer.webp">
                </div>
                <div class="textoInvestidores">
                    <p class="grifar">Djeniffer Caroline Machado</p>
                    <p class="normal">@Djeniffer</p>
                </div>

            </div>

        </section>

        <section id="SensoresTabela">

            <form method="POST">

                <table>

                    <thead>

                        <tr>

                            <th class="cellHead">ID</th>

                            <th class="cellHead">Nome</th>

                            <th class="cellHead">Tipo</th>

                            <th class="cellHead">Estado</th>

                            <th class="cellHead">Trem</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php


                        if (!empty($sensores)) { //usuários

                            foreach ($sensores as $linha) {

                                $ValorSensor = $linha['id_sensor'];

                                echo '<tr>

                                    <td class="cell"> ' . $linha['id_sensor'] . ' </td>

                                    <td class="cell"> ' . $linha['nome_sensor'] . ' </td>

                                    <td class="cell"> ' . $linha['tipo_sensor'] . ' </td>

                                    <td class="cell"> ' . $linha['estado_sensor'] . ' </td>

                                    <td class="cell"> ' . $linha['nome_trem'] . ' </td>

                                ';

                                echo "<td><input class='cellHead Botao' type='submit' value='Editar' name='Editar$ValorSensor'></td>

                                <td><input class='cellHead Botao' id='BotaoExcluir' type='submit' value='Excluir' name='Excluir$ValorSensor'></td>

                                </tr>";
                            }
                        }

                        ?>
                    </tbody>
                </table>

            </form>

        </section>



    </main>
    <footer>

    </footer>
</body>

<script src="../javascript/relatorio_analise.js?v=<?php echo time(); ?>"></script>
<script src="../javascript/teste.js?v=<?php echo time(); ?>"></script>


</html>