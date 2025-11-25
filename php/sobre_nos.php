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
                <h4>Seu transporte ferroviário de confiança para uma jornada segura e confortável</h4>
            </div>
        </section>

        <section>

            <div>
                <div class="organizacao_centro">
                    <div class="bolinha_selecao"> <img id="" src="../midias/Espiral.png.png"></div>

                </div>
                <div name="bolinha_imagem"></div>
                <div>
                    <p class="teste">Objetivo:</p>
                </div>
            </div>

            <div class="organiza_flex">
                <div id="pontualidade" class="cor_pontos_um">
                    <div>
                        <p>Pontualidade</p>
                    </div>
                    <div>
                        <p>Garantimos que você chegue ao seu destino no horário planejado, todos os dias.</p>
                    </div>
                </div>
                <div id="Conforto" class="cor_pontos_um">
                    <div>
                        <p>Conforto</p>
                    </div>
                    <div>
                        <p>Viagens confortáveis com trens modernos e bem mantidos para sua comodidade.</p>
                    </div>
                </div>
                <div id="Qualidade" class="cor_pontos_um">
                    <div>Qualidade</div>
                    <div>Compromisso com excelência em cada viagem, priorizando sua experiência.</div>
                </div>
            </div>
            <br><br>
            <div id="objetivo">
                <p>
                    Nosso objetivo é proporcionar um serviço de transporte ferroviário que conecte comunidades,
                    facilite o acesso ao trabalho e lazer, e contribua para um futuro mais sustentável.
                    Trabalhamos incansavelmente para oferecer a melhor experiência de viagem possível.
                </p>
            </div>
        </section>
        <!--=============================================================================================================-->
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

            <section id="contato">
        <div class="titulo-secao">
            <div class="icone-titulo">
                <i data-lucide="mail" size="24"></i>
            </div>
            <h2>Entre em Contato</h2>
            <p>Estamos aqui para ajudar você</p>
        </div>
        <div class="contato-grid">
            <div class="info-card">
                <h3>Informações de Contato</h3>
                <div class="info-item">
                    <div class="icone">
                        <i data-lucide="phone" size="16"></i>
                    </div>
                    <div>
                        <p>Telefone</p>
                        <p><?php echo htmlspecialchars($contact_info['phone']); ?></p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icone">
                        <i data-lucide="mail" size="16"></i>
                    </div>
                    <div>
                        <p>Email</p>
                        <p><?php echo htmlspecialchars($contact_info['email']); ?></p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icone">
                        <i data-lucide="map-pin" size="16"></i>
                    </div>
                    <div>
                        <p>Endereço</p>
                        <p><?php echo $contact_info['address']; // Não escapado para permitir <br> ?></p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="icone">
                        <i data-lucide="clock" size="16"></i>
                    </div>
                    <div>
                        <p>Horário de Atendimento</p>
                        <p><?php echo $contact_info['hours']; // Não escapado para permitir <br> ?></p>
                    </div>
                </div>
            </div>
            <div class="form-card">
                <h3>Envie uma Mensagem</h3>
                <form method="post" action="#">
                    <div class="form-group">
                        <input type="text" name="nome" placeholder="Seu nome" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Seu email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="mensagem" placeholder="Sua mensagem" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </section>


    </main>
     <footer>
        <div class="footer-content">
            <p>
                <i data-lucide="train" size="16" color="white"></i>
                TransRail Express
            </p>
            <p>© 2024 TransRail Express. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script>
        // Inicializa os ícones do Lucide
        lucide.createIcons();

        // Função para alternar o menu mobile
        function toggleMenu() {
            const navLinks = document.querySelector('nav ul');
            if (navLinks.style.display === 'block') {
                navLinks.style.display = 'none';
            } else {
                navLinks.style.display = 'block';
            }
        }

        // Fecha o menu ao clicar em um link (em dispositivos móveis)
        document.querySelectorAll('nav ul li a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth < 768) {
                    toggleMenu();
                }
            });
        });
    </script>

</body>

</html>