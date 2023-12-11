<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../arquivos_css/login.css">
    <title>Login - Tetris</title>
</head>

<body>
    <?php
    $form = "<form id='login_div' action='index.php'>
        <h3>Faça seu login</h3>
        <input class='inputs' type='text' id='Usuario' placeholder='Usuario' name='usuario' required> 
        <input class='inputs' type='password' id='Senha' placeholder='Senha' name='senha' autocomplete='off' required> 

        <p>Não tem uma conta? Se cadastre<a href='./cadastro.php'>Aqui</a></p>
        <button type='submit' id='Enviar'>Entrar</button>
    </form>";

    if (isset($_POST["usuario"])) {
        $usuario = $_POST['usuario'];
        try {
            $conn = new PDO("mysql:host=localhost;dbname=bancophp", "root", "");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->query("SELECT * FROM jogador WHERE usuario = '" . $_POST['usuario'] . "' AND senha= '" . $_POST['senha'] . "'");
            if ($stmt->execute()) {
                if ($stmt->rowcount() == 1) {
                    session_start();
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['loggedin'] = true;
                    header("Location: index.php");
                } else {
                    echo "<p>Usuario ou senha invalidos!</p>";
                    echo "<br><a id='buttonSemConta' href='login.php'>Tentar novamente</a><br>";
                }
            }
        } catch (PDOException $e) {
            echo "Ocorreu um erro: " . $e->getMessage();
        }
    } else {
        echo $form;
    }
    ?>


</body>