<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login (PatotaFC)</title>
    <link rel="icon" href="assets/imgs/logo.png">
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>
    <main class="login-container" role="main">
        <div class="login-logo">
            <img src="assets/imgs/logo.png"
                alt="Logo PatotaFC"
                tabindex="0"
                onfocus="falar('Logo do sistema PatotaFC')"
                onclick="falar('Logo do sistema PatotaFC')">
        </div>
        <h1>Login</h1>

        <form aria-labelledby="login-title" method="POST" action="home.php">
            <label for="email">Email ou telefone:</label>
            <input type="text" id="email" name="email" aria-required="true" aria-label="Campo para digitar email ou telefone" onfocus="falar('Digite seu email ou telefone')">

            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" aria-required="true" aria-label="Campo para digitar sua senha" onfocus="falar('Digite sua senha')">

            <button type="submit" aria-label="Entrar na conta" onfocus="falar('Botão Entrar')">Entrar</button>
        </form>

        <button class="accessibility-toggle" id="botaoAcessibilidade" aria-label="Alternar modo acessível" onfocus="falar('Botão para ativar ou desativar modo acessível')">
            Ativar Modo Acessível (Tecla: Alt + A)
        </button>
    </main>

    <script>
        const botaoAcessibilidade = document.getElementById('botaoAcessibilidade');
        const body = document.body;
        let modoAcessebilidade = false;

        function alterarModoAcessebilidade() {
            body.classList.toggle('dark-mode');
            modoAcessebilidade = body.classList.contains('dark-mode');

            botaoAcessibilidade.textContent = modoAcessebilidade ?
                'Desativar Modo Acessível (Tecla: Alt + A)' :
                'Ativar Modo Acessível (Tecla: Alt + A)';

            falar(modoAcessebilidade ? 'Modo acessível ativado' : 'Modo acessível desativado');
        }

        botaoAcessibilidade.addEventListener('click', alterarModoAcessebilidade);

        document.addEventListener('keydown', function(e) {
            if (e.altKey && e.key.toLowerCase() === 'a') {
                alterarModoAcessebilidade();
            }
        });

        function falar(text) {
            if (!modoAcessebilidade) return;
            if ('speechSynthesis' in window) {
                const utterance = new SpeechSynthesisUtterance(text);
                utterance.lang = 'pt-BR';
                window.speechSynthesis.cancel();
                window.speechSynthesis.speak(utterance);
            }
        }
    </script>
</body>

</html>