<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arquivos_css/cadastro.css">
    <title>Tela de Cadastro</title>
</head>

<body>

    <div class="container">
        <h1>Cadastro</h1>
        <?php
        $form = "<form id='nv_jogador' action='cadastro.php'>
                <label for='nomeCompleto'>Nome Completo:</label>
                <input type='text' id='nomeCompleto' name='nomeCompleto' required>

                <label for='CPF'>CPF:</label>
                <input type='text' id='CPF' name='CPF' required> 

                <label for='Tel'>Telefone:</label>
                <input type='text' id='Tel' name='Tel' required>
                
                <label for='email'>Email:</label>
                <input type='email' id='email' name='email' required>
                
                <label for='dataNascimento'>Data de Nascimento:</label>
                <input type='date' id='dataNascimento' name='dataNascimento' required>
                
                <label for='usuario'>Nome de Usuário:</label>
                <input type='text' id='usuario' name='usuario' required>
                
                <label for='senha'>Senha:</label>
                <input type='password' id='senha' name='senha' required>

                <label for='senha2'>Confirme a Senha:</label>
                <input type='password' id='senha2' name='senha2' required>
                <button type='submit'>Finalizar Cadastro</button>
                </form>";


        if (isset($_POST["nomeCompleto"])) {
            try {
                $conn = new PDO("mysql:host=localhost;dbname=bancophp", "root", "");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "INSERT INTO jogador VALUES (
                        '" . $_POST['nomeCompleto'] . "',
                        '" . $_POST['CPF'] . "',
                        '" . $_POST['Tel'] . "',
                        '" . $_POST['email'] . "',
                        '" . $_POST['dataNascimento'] . "',
                        '" . $_POST['usuario'] . "',
                        '" . $_POST['senha'] . "',

                )";
                $conn->exec($sql);
                echo $form;
                header("Location: login.php");
            } catch (PDOException $e) {
                echo "Ocorreu um erro: " . $e->getMessage();
            }
        } else {
            echo $form;
        }
        ?>
        <h3> Volte para a tela de login clicando no botão abaixo. </h3>
        <form action="login.php" method="get">
            <button type="submit">Voltar à Tela de Login</button>
        </form>
    </div>
</body>

</html>