<?php


?>

<!DOCTYPE html>
<html lang="pt-BR">

<script src="../javascript/monitoramento.js?v=<?php echo time(); ?>"></script>
<script src="../javascript/teste.js?v=<?php echo time(); ?>"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sobre_nos.css?v=<?php echo time(); ?>">
    <title>Sobre nós</title>
</head>

<body>
    <header id="topo_base">
        <div>
            <img src="../midias/logotraininfo.png" class="logo_topo">
        </div>
        <div>
            <nav class="menu-hamburguer logo_topo">
                <input type="checkbox" id="menu-toggle" />
                <label for="menu-toggle" class="menu-icon ">☰</label>

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
        </div>
    </header>
    <main>

        <section id="parte_um">
            <div id="texto_principal">
                <h2>Conectando Pessoas, Destinos e Oportundades</h2>
            </div>
            <div id="texto_segundario">
                <h4></h4>
            </div>
        </section>

        <section>

            <div>
                <div name="bolinha_imagem"><img id="" src=""></div>
                <div>
                    <h2>Objetivo:</h2>
                </div>
            </div>


            <div id="pontualidade">
                <div></div>
                <div></div>
            </div>
            <div id="Conforto">
                <div></div>
                <div></div>
            </div>
            <div id="Qualidade">
                <div></div>
                <div></div>
            </div>
            <div id="objetivo"></div>
        </section>

        <section id="parte_dois">
            <div><img src="" alt=""></div>
            <div></div>

            <div name="avaliação">
                <div></div>
                <div></div>
            </div>
            <div name="avaliação">
                <div></div>
                <div></div>
            </div>
            <div name="avaliação">
                <div></div>
                <div></div>
            </div>
            <div name="objetivo"></div>
        </section>
        <section id="parte_tres">
            <div><img src="" alt=""></div>
            <div></div>

            <section>
                <div id="titulo"></div>
                <div id="telefone">
                    <div></div>
                    <div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div id="email">
                    <div></div>
                    <div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div id="endereco">
                    <div></div>
                    <div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
                <div id="horario_atendimento">
                    <div></div>
                    <div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </section>
        </section>


    </main>
    <footer>

    </footer>


</body>

</html>