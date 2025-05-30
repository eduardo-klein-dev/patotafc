<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gerenciar Reservas (PatotaFC)</title>
    <link rel="icon" href="assets/imgs/logo.png">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <header class="cabecalho">
        <h1 tabindex="0" onfocus="falar('Painel administrativo de reservas')">Administração de Reservas</h1>
        <button onclick="alternarAcessibilidade()" id="botaoAcessibilidade" onfocus="falar('Ativar ou desativar modo acessível')">
            Ativar Modo Acessível (Alt + A)
        </button>
    </header>

    <main class="conteudo">
        <section class="lista-dias" aria-label="Lista de reservas por dia">
            <h2 tabindex="0" onfocus="falar('Lista de marcações por dia')">Marcações da Quadra</h2>

            <div class="dia" tabindex="0" role="region" aria-label="Dia 03 de Junho">
                <h3>03/06 (Segunda-feira)</h3>
                <ul>
                    <li tabindex="0" onfocus="falar('Horário das 19 às 20 reservado por João Silva, telefone (51) 99912-3481')">
                        19h - 20h — João Silva — (51) 99912-3481
                    </li>
                    <li tabindex="0" onfocus="falar('Horário das 20 às 21 reservado por Equipe Alpha, telefone (51) 99956-2107')">
                        20h - 21h — Equipe Alpha — (51) 99956-2107
                    </li>
                </ul>
                <button onclick="falar('Fechando quadra no dia 3 de junho')">Fechar este dia</button>
            </div>

            <div class="dia" tabindex="0" role="region" aria-label="Dia 04 de Junho">
                <h3>04/06 (Terça-feira)</h3>
                <ul>
                    <li tabindex="0" onfocus="falar('Horário das 19 às 20 reservado por Maria Oliveira, telefone (51) 99977-6043')">
                        19h - 20h — Maria Oliveira — (51) 99977-6043
                    </li>
                    <li tabindex="0" onfocus="falar('Horário das 21 às 22 reservado por Patota do Zé, telefone (51) 99921-8820')">
                        21h - 22h — Patota do Zé — (51) 99921-8820
                    </li>
                </ul>
                <button onclick="falar('Fechando quadra no dia 4 de junho')">Fechar este dia</button>
            </div>

            <div class="dia" tabindex="0" role="region" aria-label="Dia 05 de Junho">
                <h3>05/06 (Quarta-feira)</h3>
                <ul>
                    <li tabindex="0" onfocus="falar('Horário das 20 às 21 sem marcação')">
                        20h - 21h — Sem marcação
                    </li>
                    <li tabindex="0" onfocus="falar('Horário das 22 às 23 reservado por Equipe Raiz, telefone (51) 99934-0966')">
                        22h - 23h — Equipe Raiz — (51) 99934-0966
                    </li>
                </ul>
                <button onclick="falar('Fechando quadra no dia 5 de junho')">Fechar este dia</button>
            </div>

        </section>
    </main>

    <script>
        let modoAcessibilidade = false;

        function alternarAcessibilidade() {
            document.body.classList.toggle('dark-mode');
            modoAcessibilidade = document.body.classList.contains('dark-mode');

            const botao = document.getElementById('botaoAcessibilidade');
            botao.textContent = modoAcessibilidade ?
                'Desativar Modo Acessível (Alt + A)' :
                'Ativar Modo Acessível (Alt + A)';

            falar(modoAcessibilidade ? 'Modo acessível ativado' : 'Modo acessível desativado');
        }

        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key.toLowerCase() === 'a') {
                alternarAcessibilidade();
            }
        });

        function falar(texto) {
            if (!modoAcessibilidade) return;
            if ('speechSynthesis' in window) {
                window.speechSynthesis.cancel();
                const fala = new SpeechSynthesisUtterance(texto);
                fala.lang = 'pt-BR';
                window.speechSynthesis.speak(fala);
            }
        }
    </script>
</body>

</html>