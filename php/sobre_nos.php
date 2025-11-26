<?php
$reviews = [
    [
        'name' => "Maria Silva",
        'rating' => 5,
        'comment' => "Serviço excelente! Pontualidade e conforto em todas as viagens.",
        'date' => "Outubro 2024"
    ],
    [
        'name' => "João Santos",
        'rating' => 5,
        'comment' => "Melhor opção para transporte diário. Sempre limpo e organizado.",
        'date' => "Setembro 2024"
    ],
    [
        'name' => "Ana Costa",
        'rating' => 4,
        'comment' => "Ótima experiência. Recomendo para quem busca pontualidade.",
        'date' => "Agosto 2024"
    ]
];

$contact_info = [
    'phone' => "(11) 4000-0000",
    'email' => "contato@transrail.com.br",
    'address' => "Av. Paulista, 1000<br>São Paulo - SP, 01310-100",
    'hours' => "Segunda a Sexta: 6h às 22h<br>Sábados e Domingos: 7h às 20h"
];

?>

<!DOCTYPE html>
<html lang="pt-BR">

<script src="../javascript/monitoramento.js?v=<?php echo time(); ?>"></script>
<script src="../javascript/teste.js?v=<?php echo time(); ?>"></script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/sobre_nos.css?v=<?php echo time(); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <title>Sobre nós</title>
</head>

       <body>

    <header>
        <div class="logo">
            <i data-lucide="train" size="24" color="white"></i>
            <span>Train.Info</span>
        </div>
        <nav>
            <button class="menu-toggle" onclick="toggleMenu()">☰</button>
            <ul>
                <li><a href="pagina_inicial.php">Início</a></li>
                <li><a href="perfil_condutor.php">Perfil</a></li>
                <li><a href="gestao_rotas.php">Rotas</a></li>
                <li><a href="dash_board_geral.php">Dashboard</a></li>
                <li><a href="relatorio_analise.php">Relatórios</a></li>
                <li><a href="central_apoio_condutor.php">Central de Apoio</a></li>
                <li><input type="submit" name="BotaoSair" id="BotaoSair" value="Sair"></li>
            </ul>
        </nav>
    </header>

    <section id="hero">
        <h2>Conectando Pessoas, Destinos e Oportunidades</h2>
        <p>Seu transporte ferroviário de confiança para uma jornada segura e confortável</p>
    </section>

    <section id="objetivo">
        <div class="titulo-secao">
            <div class="icone-titulo">
                <i data-lucide="target" size="24"></i>
            </div>
            <h2>Nosso Objetivo</h2>
        </div>
        <div class="objetivos-grid">
            <div class="obj-card">
                <div class="icone">
                    <i data-lucide="clock" size="20"></i>
                </div>
                <h3>Pontualidade</h3>
                <p>Garantimos que você chegue ao seu destino no horário planejado, todos os dias.</p>
            </div>
            <div class="obj-card">
                <div class="icone">
                    <i data-lucide="train" size="20"></i>
                </div>
                <h3>Conforto</h3>
                <p>Viagens confortáveis com trens modernos e bem mantidos para sua comodidade.</p>
            </div>
            <div class="obj-card">
                <div class="icone">
                    <i data-lucide="target" size="20"></i>
                </div>
                <h3>Qualidade</h3>
                <p>Compromisso com excelência em cada viagem, priorizando sua experiência.</p>
            </div>
        </div>
        <div class="descricao-objetivo">
            <p>
                Nosso objetivo é proporcionar um serviço de transporte ferroviário que conecte comunidades,
                facilite o acesso ao trabalho e lazer, e contribua para um futuro mais sustentável.
                Trabalhamos incansavelmente para oferecer a melhor experiência de viagem possível.
            </p>
        </div>
</section>
       
 <!--=============================================================================================================-->

        <section id="avaliacoes">
        <div class="titulo-secao">
            <div class="icone-titulo">
                <i data-lucide="star" size="24"></i>
            </div>
            <h2>Avaliações dos Nossos Clientes</h2>
            <p>Veja o que nossos passageiros dizem sobre nós</p>
        </div>
        <div class="avaliacoes-grid">
            <?php foreach ($reviews as $review): ?>
            <div class="review-card">
                <div class="rating">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?php if ($i <= $review['rating']): ?>
                            <i data-lucide="star" fill="#35739b" color="#35739b" size="16"></i>
                        <?php else: ?>
                            <i data-lucide="star" fill="none" color="#35739b" size="16"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
                <p>"<?php echo htmlspecialchars($review['comment']); ?>"</p>
                <div class="review-info">
                    <span><?php echo htmlspecialchars($review['name']); ?></span>
                    <span><?php echo htmlspecialchars($review['date']); ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="stats-card">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-value">4.8/5.0</div>
                    <div class="stat-label">Avaliação Média</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">15.000+</div>
                    <div class="stat-label">Avaliações</div>
                </div>
                <div class="stat-item">
                    <div class="stat-value">98%</div>
                    <div class="stat-label">Satisfação</div>
                </div>
            </div>
        </div>
    </section>


    </main>
     <footer>
        <div class="footer-content">
            <p>
                <i data-lucide="train" size="16" color="white"></i>
                Train.Info 
            </p>
            <p>© 2024 Train.Info. Todos os direitos reservados.</p>
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