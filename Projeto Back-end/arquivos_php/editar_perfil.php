<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header("Location: login.php");
} else {
    try {
        $conn = new PDO("mysql:host=localhost;dbname=bancophp", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $usuario = $_SESSION['usuario'];

    } catch (PDOException $e) {
        echo "Ocorreu um erro: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arquivos_css/editar_perfil.css">
    <title>Edição do Perfil</title>
</head>

<body>
    <div class="container">
        <h1>Edite suas informações:</h1>
        <p>Preencha o campo a seguir e clique em "Salvar" para mudar seu dado.</p>
        <?php
        $form = "<form action='editar_perfil.php' method='POST'>
            <label for='TelNew'>Novo Telefone:</label>
            <input type='number' id='TelNew' name='TelNew' required>
            <button type='submit'>Salvar</button>
        </form></br>";
        if (isset($_POST['TelNew'])) {
            $tel = $_POST['TelNew'];
            $sql = "UPDATE jogador SET tel = '$tel' WHERE usuario = '$usuario'";
            $conn->exec($sql);

            $form2 = "<form action='editar_perfil.php' method='POST'>
            <label for='emailNew'>Novo Email:</label>
            <input type='email' id='emailNew' name='emailNew' required>
            <button type='submit'>Salvar</button>
            </form></br>";
        }
        if (isset($_POST['emailNew'])) {
            $email = $_POST['emailNew'];
            $sql = "UPDATE jogador SET email = '$email' WHERE usuario = '$usuario'";
            $conn->exec($sql);

            $form3 = "<form action='editar_perfil.php' method='POST'>
                <label for='nomeCompletoNew'>Novo Nome Completo:</label>
                <input type='text' id='nomeCompletoNew' name='nomeCompletoNew' required>
                <button type='submit'>Salvar</button>
            </form><br>";
        }
        if (isset($_POST['nomeCompletoNew'])) {
            $nome = $_POST['nomeCompletoNew'];
            $sql = "UPDATE jogador SET nomeCompleto = '$nome' WHERE usuario = '$usuario'";
            $conn->exec($sql);
        }


        $aviso = "<p>Por questões de segurança, preencha sua senha atual além de confirmar a senha nova duas vezes.</p>";

        $form4 = "<form action='editar_perfil.php' method='POST'>
            <label for='senhaOld'>Senha Antiga:</label>
            <input type='password' id='senhaOld' name='senhaOld' required>
            <label for='senhaNew'>Senha Nova:</label>
            <input type='password' id='senhaNew' name='senhaNew' required>
            <label for='senhaNew2'>Confirme a Senha Nova:</label>
            <input type='password' id='senhaNew2' name='senhaNew2' required>
            
            <button type='submit'>Salvar</button>
        </form>";
        if (isset($_POST['senhaOld']) && isset($_POST['senhaNew']) && isset($_POST['senhaNew2'])) {
            $senhavelha = $_POST["senhaOld"];
            $senhanova = $_POST["senhaNew"];
            $senhanova2 = $_POST["senhaNew2"];

            $comp = $conn->prepare("SELECT senha FROM jogador WHERE usuario = '$usuario'");
            $comp->execute();
            $hash_senha_antiga = $comp->fetchColumn();

            if (password_verify($senhavelha, $hash_senha_antiga)) {
                if ($senhanova == $senhanova2) {
                    $hash_senha_nova = password_hash($senhanova, PASSWORD_DEFAULT);
                    $sql = "UPDATE jogador SET senha = :senha WHERE usuario = '$usuario'";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':senha', $hash_senha_nova);
                    $stmt->execute();
                } else {
                    $aviso = "<p> Senhas novas não correspondem</p>";
                }
            } else {
                $aviso = "<p> Senha antiga incorreta</p>";
            }
        }

        ?>
        <br><br>
        <h3> Volte para o jogo clicando no botão abaixo. </h3>
        <form action="index.php" method="get">
            <button type="submit">Voltar ao Jogo</button>
        </form>

    </div>
</body>

</html>