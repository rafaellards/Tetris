<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <title> TRABALHO 3 - PHP </title>
</head>
   <body>
      <?php
				try {
					$conn = new PDO("mysql:host=localhost;dbname=bancophp", "root", "");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
					$sql = "CREATE TABLE jogador (
     						nomeCompleto varchar(200) NOT NULL,
     						CPF varchar(80) NOT NULL,
     						Tel varchar(80) NOT NULL,
     						email varchar(200) NOT NULL,
     						dataNascimento date NOT NULL,
     						usuario varchar(200) NOT NULL,
     						PRIMARY KEY(usuario),
     						senha varchar(200) NOT NULL
     						)";

     				$sql2 = "CREATE TABLE pontuacao (
     						pontos int NOT NULL,
     						level int NOT NULL,
     						tempo int NOT NULL,
     						usuario_dados varchar(200) NOT NULL,
     						foreign key (usuario_dados) references jogador(usuario)
     						)";
    

					$conn->exec($sql);
                    $conn->exec($sql2);
					echo "<p>Tabela criada com sucesso</p>";

					$conn = null;
				}
				catch(PDOException $e)
				{
					echo "Erro: " . $e->getMessage();
				}
	?>

      
   </body>
</html>
