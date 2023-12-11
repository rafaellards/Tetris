<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../arquivos_css/estilo_rankingGlobal.css">
    <title>Ranking_Global</title>
</head>
<body>
    <header>
        <h1>Ranking Global</h1>
    </header>
    <br>
    <br>
    <form action="index.php" method="get"> 
        <button type="submit">Voltar ao Jogo</button> 
    </form>
    <section class="ranking">
        <div class="usu_inf">
            <h2>Sua Posição:</h2>
            <p class="usu_posicao">1º</p>
        </div>
        <div class="top_pontuacao">
            <h2>Melhores Pontuações!!!</h2>
            <?php
                    session_start();
                    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false){
                        echo "Please login first to see this page.";
                        header("Location: login.php");
                    }

                    try{
                            $conn = new PDO("mysql:host=localhost;dbname=bancophp", "root", "");
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $sql = "SELECT * FROM pontuacao ORDER BY pontos DESC, tempo ASC, usuario_dados ASC limit 10";
                            $grava = $conn->prepare($sql);
                            $grava->execute(array());
                            $i=0;
                            while($row = $grava->fetch(PDO::FETCH_ASSOC)) {
                                $i++;
                                echo '<ul>';
                                echo '<li><b>RANK: </b>'.$i.'<b> Nome:</b>'.$row['usuario_dados'].'<b> Points:</b>'.$row['pontos'].'<b> Nivel:</b>'.$row['level'].'<b> Tempo:</b>'.$row['tempo'].'</li>';
                                echo '</ul>';
                            }
                            echo "<hr>";
                                $sql = "SELECT ROW_NUMBER() OVER(ORDER BY pontos DESC, tempo ASC, usuario_dados ASC) as linha, usuario_dados
                                        FROM pontuacao";
                                $grava = $conn->prepare($sql);
                                $grava->execute(array());
                                while($row = $grava->fetch(PDO::FETCH_ASSOC)){
                                    if($row['usuario_dados'] == $_SESSION['usuario']){
                                        echo "A sua melhor classificação é ".$row['linha']."° lugar!";
                                        break;
                                    }
                                }
                    }catch(PDOException $e){
                    echo "Ocorreu um erro: " . $e->getMessage();
                } 
                ?>

        </div>
    
    </section>


</body>


</html>
