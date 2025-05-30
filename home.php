<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home (PatotaFC)</title>
    <link rel="icon" href="assets/imgs/logo.png">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <header class="cabecalho" role="banner">
        <div class="saudacao" onclick="falarDataHora()" onfocus="falarDataHora()">
            <h2 id="tituloSaudacao">Olá, tudo bem?</h2>
            <p id="dataHora">Carregando data e hora...</p>
        </div>
        <div class="acoes">
            <button id="botaoAcessibilidade" class="botao" onclick="alternarAcessibilidade()" onfocus="falar('Botão para ativar ou desativar modo acessível')">
                Ativar Modo Acessível (Tecla: Alt + A)
            </button>
            <button id="botaoSair" class="botao" onclick="falar('Você será desconectado'); window.location.href='index.php'" onfocus="falar('Botão sair do sistema')">
                Sair do Sistema
            </button>
        </div>
    </header>

    <main class="conteudo" role="main">
        <section class="calendario" aria-label="Calendário do mês">
            <h2>Horários disponíveis</h2>
            <div class="grade-dias" id="gradeDias">
            </div>
        </section>
    </main>

    <div class="background">
        <div class="bodyReserva">
            <div class="textReserva">
                <h3>Deseja reservar a data de:</h3>
                <h4 id="dataReserva"></h4>
                <div class="input">
                    <label for="nomeResponsavel" class="form-label">Nome do Responsável da Reserva:</label>
                    <input type="text" id="nomeResponsavel" onfocus="falar('Digite o nome do responsável pela reserva')">
                </div>
                <div class="input">
                    <label for="telefoneResponsavel" class="form-label">Telefone do Responsável da Reserva:</label>
                    <input type="text" id="telefoneResponsavel" onfocus="falar('Digite o telefone do responsável pela reserva')">
                </div>
                <div class="line">
                    <button type="button" class="btn btn-success" onclick="reservaRealizada(); falar('Reserva salva com sucesso')">Salvar</button>
                    <button type="button" class="btn btn-danger" onclick="fecharReserva(); falar('Fechando tela de reserva')">Fechar</button>
                </div>
            </div>
            <div class="sucessoReserva">
                <h5>Reserva realizada com sucesso!<br><i class="fa-solid fa-check"></i></h5>
                <h5>Endereço: Rua Rincão 385, Rincão dos Ilhéus, Estância Velha - RS</h5>
                <button type="button" class="btn btn-danger mt-2" onclick="fecharReserva(); falar('Fechando tela de reserva concluída')">Fechar</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        let modoAcessibilidade = false;

        function falarDataHora() {
            if (!modoAcessibilidade) return;

            const agora = new Date();
            const opcoesData = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dataTexto = agora.toLocaleDateString('pt-BR', opcoesData);
            const horaTexto = agora.toLocaleTimeString('pt-BR');

            const frase = `Hoje é ${dataTexto}, e agora são ${horaTexto}.`;
            falar(frase);
        }

        function alternarAcessibilidade() {
            document.body.classList.toggle('dark-mode');
            modoAcessibilidade = document.body.classList.contains('dark-mode');
            const botao = document.getElementById('botaoAcessibilidade');
            botao.textContent = modoAcessibilidade ?
                'Desativar Modo Acessível (Tecla: Alt + A)' :
                'Ativar Modo Acessível (Tecla: Alt + A)';
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

        function atualizarDataHora() {
            const agora = new Date();
            const opcoes = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const dataFormatada = agora.toLocaleDateString('pt-BR', opcoes);
            const hora = agora.toLocaleTimeString('pt-BR');
            document.getElementById('dataHora').textContent = `${dataFormatada} - ${hora}`;
        }

        setInterval(atualizarDataHora, 1000);

        function gerarCalendario() {
            const diasContainer = document.getElementById('gradeDias');
            diasContainer.innerHTML = '';

            const ano = new Date().getFullYear();
            const mes = 5;

            const ultimoDia = new Date(ano, mes + 1, 0).getDate();
            const nomesDias = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

            let linhaSemana = document.createElement('div');
            linhaSemana.className = 'semana';

            for (let dia = 1; dia <= ultimoDia; dia++) {
                const data = new Date(ano, mes, dia);
                const diaSemana = data.getDay();

                if (diaSemana === 0 || diaSemana === 6) continue;

                const diaFormatado = String(dia).padStart(2, '0');
                const nomeDia = nomesDias[diaSemana];

                const diaDiv = document.createElement('div');
                diaDiv.className = 'dia';
                diaDiv.setAttribute('tabindex', '0');
                diaDiv.setAttribute('role', 'region');
                diaDiv.setAttribute('aria-label', `${diaFormatado} de junho, ${nomeDia}`);

                diaDiv.innerHTML = `
                    <strong>${diaFormatado}/06 (${nomeDia})</strong>
                    <ul>
                        <li onclick="falar('Reservar horário das 19 às 20 de ${diaFormatado} de junho'); abrirReserva('${diaFormatado}', '19')">19h - 20h</li>
                        <li onclick="falar('Reservar horário das 20 às 21 de ${diaFormatado} de junho'); abrirReserva('${diaFormatado}', '20')">20h - 21h</li>
                        <li onclick="falar('Reservar horário das 21 às 22 de ${diaFormatado} de junho'); abrirReserva('${diaFormatado}', '21')">21h - 22h</li>
                        <li onclick="falar('Reservar horário das 22 às 23 de ${diaFormatado} de junho'); abrirReserva('${diaFormatado}', '22')">22h - 23h</li>
                    </ul>
                    `;

                linhaSemana.appendChild(diaDiv);

                if (linhaSemana.children.length === 5) {
                    diasContainer.appendChild(linhaSemana);
                    linhaSemana = document.createElement('div');
                    linhaSemana.className = 'semana';
                }
            }
            if (linhaSemana.children.length > 0) {
                diasContainer.appendChild(linhaSemana);
            }
        }

        function abrirReserva(diaReserva, hora) {
            document.querySelector('.background').style.display = 'flex';
            if (hora == '19') {
                horaCompleta = '19h - 20h';
            } else if (hora == '20') {
                horaCompleta = '20h - 21h';
            } else if (hora == '21') {
                horaCompleta = '21h - 22h';
            } else {
                horaCompleta = '22h - 23h';
            }
            document.querySelector('#dataReserva').innerHTML = diaReserva + '/06 às ' + horaCompleta;
        }

        function reservaRealizada() {
            document.querySelector('.textReserva').style.display = 'none';
            document.querySelector('.sucessoReserva').style.display = 'flex';
        }

        function fecharReserva() {
            document.querySelector('.background').style.display = 'none';
            document.querySelector('.sucessoReserva').style.display = 'none';
            document.querySelector('.textReserva').style.display = 'flex';
            document.querySelector('#dataReserva').innerHTML = '';
            document.querySelector('#nomeResponsavel').value = '';
            document.querySelector('#telefoneResponsavel').value = '';
        }

        const nomeInput = document.getElementById('nomeResponsavel');
        const telefoneInput = document.getElementById('telefoneResponsavel');

        if (nomeInput) {
            nomeInput.addEventListener('input', () => {
                nomeInput.value = nomeInput.value
                    .toLowerCase()
                    .replace(/\b\w/g, (l) => l.toUpperCase());
            });
        }

        if (telefoneInput) {
            telefoneInput.addEventListener('input', () => {
                let valor = telefoneInput.value.replace(/\D/g, '')

                if (valor.length > 0) {
                    valor = valor.replace(/^(\d{2})(\d)/g, '($1) $2');
                }
                if (valor.length > 9) {
                    valor = valor.replace(/(\d{5})(\d{4})$/, '$1-$2');
                } else if (valor.length > 5) {
                    valor = valor.replace(/(\d{4})(\d{1,4})$/, '$1-$2');
                }

                telefoneInput.value = valor;
            });
        }

        gerarCalendario();
    </script>
</body>

</html>