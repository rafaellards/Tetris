<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    echo "Please login first to see this page.";
    header("Location: login.php");
}
if (isset($_SESSION['usuario'])) {
    $nome_usuario = $_SESSION['usuario'];
    $pont = $_GET['pontos'];
    $temp = $_GET['tempo'];
    try {
        $conn = new PDO("mysql:host=localhost;dbname=bancophp", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
        $pont = $conn->query("SELECT pontos FROM pontuacao WHERE usuario_dados='$nome_usuario' WHEN pontos < '$pont'");
        $pont2 = $conn->query("SELECT pontos FROM pontuacao WHERE usuario_dados='$nome_usuario' WHEN pontos = '$pont' AND tempo <'$temp'");
        if ($pont->rowCount() > 0 or $pont2->rowCount() > 0) {


            $sql = "INSERT INTO pontuacao VALUES (
                          '" . $_GET['pontos'] . "',
                          " . $_GET['level'] . ", 
                          '" . $_GET['tempo'] . "')";
            $grava = $conn->prepare($sql);
            $grava->execute(array());
        }
    } catch (PDOException $e) {
        echo ('Erro: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../arquivos_css/index.css">
    <title>Jogo Tetris</title>
</head>

<body>
    <h1>Jogo Tetris</h1>
    <br>
    <div class="link-container">
        <div class="button-container">
            <a href="Tela_Ranking_Global.php" class="button">Ver Global Ranking</a>
            <a href="editar_perfil.php" class="button">Editar Perfil</a>
            <a href="login.php" class="button right">Sair</a>
        </div>
    </div>
    <br>
    <br>
    <input type="text" id="controller" value="0" hidden>
    <br>
    <div id="game_setting_buttons">
        <h3 id="tamanho_h3">Escolha o Tamanho do Jogo</h3>
        <button id="t_1">Tetris 10x20</button>
        <button id="t_2">Tetris 22x44</button>
        <button id="reset" style="display: none;">Reiniciar Jogo</button>
    </div>
    <div class="main-container">
        <div class="game-container">
            <br>
            <div id="tetris" style="display: none;">
                <div id="info">
                    <div id="next_shape"></div>
                    <br>
                    <?php
                    $nivel = $_GET['nivel'];
                    $pontos = $_GET['pontos'];
                    $tempo = $_GET['tempo'];
                    $lines = $_GET['linhas'];

                    $ranks = "
                <p id='level'>Level: <span>$nivel</span></p>
                <p id='lines'>Lines: <span> $linhas</span></p>
                <p id='score'>Score: <span>$pontos</span></p>
                <p id='time'>Time: <span>$tempo</span></p>";
                    ?>

                    <br>
                    <button id='start'>Start</button>
                    <br>
                    <!-- <p class='red'>Press the Esc button to pause<span></span></p> -->
                </div>
                <div id="canvas"></div>
            </div>
        </div>

        <div class="ranking-container">
            <h1>Ranking</h1>
            <p>Rank | jogador | pontuação | nível | duração</p>
            <?php
                 $sql = "SELECT * FROM pontuacao ORDER BY pontos DESC, tempo ASC, usuario_dados ASC limit 3";
                 $grava = $conn->prepare($sql);
                 $grava->execute(array());
                 $i=0;
                 while($row = $grava->fetch(PDO::FETCH_ASSOC)) {
                     $i++;
                     echo '<ul>';
                     echo '<li><b>RANK: </b>'.$i.'<b> Nome:</b>'.$row['usuario_dados'].'<b> Points:</b>'.$row['pontos'].'<b> Nivel:</b>'.$row['level'].'<b> Tempo:</b>'.$row['tempo'].'</li>';
                     echo '</ul>';
                 }
            ?>
            
            <!-- Conteúdo da lista de ranking vai aqui -->
        </div>
    </div>
    <script type="text/javascript" src="../arquivos_javascript/index.js"></script>
</body>

</html>