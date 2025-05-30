<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="assets/css/cadastro.css">
</head>

<body>
    <button class="botao-acessibilidade" onclick="alternarAcessibilidade()" onfocus="falar('Botão de acessibilidade')">
        Ativar Modo Acessível (Alt + A)
    </button>

    <main class="cadastro-container">
        <h1 tabindex="0" onfocus="falar('Página de cadastro de usuário')">Cadastro de Jogador</h1>
        <form aria-label="Formulário de cadastro">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" onfocus="falar('Digite seu nome completo')">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="seuemail@exemplo.com" onfocus="falar('Digite seu email')">

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" onfocus="falar('Digite uma senha')">

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" placeholder="(51) 9XXXX-XXXX" onfocus="falar('Digite seu número de telefone')">

            <label for="posicao">Posição que joga:</label>
            <input type="text" id="posicao" name="posicao" placeholder="Ex: Goleiro, Fixo, Ala..." onfocus="falar('Digite a posição que você joga')">

            <fieldset>
                <legend tabindex="0" onfocus="falar('Escolha o seu perfil')">Você é:</legend>
                <label>
                    <input type="radio" name="perfil" value="dono" onfocus="falar('Dono de time procurando adversários')">
                    Dono de time procurando adversários
                </label><br>
                <label>
                    <input type="radio" name="perfil" value="jogador" onfocus="falar('Jogador sem time procurando horários')">
                    Jogador sem time procurando horários
                </label>
            </fieldset>

            <button type="submit" onclick="falar('Cadastro enviado')" onfocus="falar('Botão para enviar o formulário')">Cadastrar</button>
        </form>
    </main>

    <script>
        let modoAcessibilidade = false;

        function alternarAcessibilidade() {
            document.body.classList.toggle('dark-mode');
            modoAcessibilidade = document.body.classList.contains('dark-mode');
            const botao = document.querySelector('.botao-acessibilidade');
            botao.textContent = modoAcessibilidade ? 'Desativar Modo Acessível (Alt + A)' : 'Ativar Modo Acessível (Alt + A)';
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