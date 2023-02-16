<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemplo - Formulário de contato</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php session_start(); ?>
    <div class="container">
        <form onsubmit="return validaFormulario()" action="./envia-email.php" method="POST" class="form">
            <h1>Contato</h1>
            <?php if(isset($_SESSION['mensagem-sucesso'])): ?>
                <div class="mensagem-sucesso">
                    <?php
                        echo $_SESSION['mensagem-sucesso'];
                        unset($_SESSION['mensagem-sucesso']);
                    ?>
                </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['mensagem-erro'])): ?>
                <div class="mensagem-erro">
                    <?php
                        echo $_SESSION['mensagem-erro'];
                        unset($_SESSION['mensagem-erro']);
                    ?>
                </div>
            <?php endif; ?>
            <div class="control">
                <label for="inNome">Nome:</label>
                <input type="text" name="nome" id="inNome" require placeholder="Digite seu nome" />
            </div>
            <div class="control">
                <label for="inEmail">E-mail:</label>
                <input type="email" name="email" id="inEmail" require placeholder="Digite seu e-mail" />
            </div>
            <div class="control">
                <label for="inMensagem">Mensagem:</label>
                <textarea name="mensagem" id="inMensagem" cols="30" rows="3" placeholder="Digite sua mensagem"></textarea>
            </div>
            <div class="control">
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>

    <script>
        function validaFormulario() {
            let valido = true; 

            let inNome = document.getElementById('inNome');
            if (inNome.value === "") {
                let mensagem = document.createElement('span');
                mensagem.textContent = 'O nome é obrigatório';
                mensagem.classList.add('mensagem-validacao');
                inNome.parentNode.appendChild(mensagem);
                valido = false;
            }

            let inEmail = document.getElementById('inEmail');
            if (inEmail.value === "") {
                let mensagem = document.createElement('span');
                mensagem.textContent = 'O e-mail é obrigatório';
                mensagem.classList.add('mensagem-validacao');
                inEmail.parentNode.appendChild(mensagem);
                valido = false;
            }

            let inMensagem = document.getElementById('inMensagem');
            if (inMensagem.value === "") {
                let mensagem = document.createElement('span');
                mensagem.textContent = 'A mensagem é obrigatória';
                mensagem.classList.add('mensagem-validacao');
                inMensagem.parentNode.appendChild(mensagem);
                valido = false;
            }

            return valido;
        }
    </script>
</body>
</html>