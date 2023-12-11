# Tetris
Jogo Tetris para matéria de Programação Web

Criado em 1984 por Alexey Pajitnov, Tetris é um jogo muito popular em que o jogador deve rotacionar e encaixar peças (chamadas Tetriminos) que caem da parte superior de um tabuleiro com uma certa velocidade. O objetivo final do jogo é preencher totalmente o maior número possível de linhas horizontais pois, uma vez preenchidas, estas linhas desaparecem e o jogador ganha mais espaço no tabuleiro para continuar a tarefa, somando pontos no processo. Com o passar o tempo, geralmente a velocidade de queda das peças aumenta, tornando o jogo gradualmente mais difícil. A partida termina quando não há mais espaço no tabuleiro para acomodar novas peças.


Existem inúmeras variações do jogo Tetris, com modificações nos tipos de peças, no tamanho dos tabuleiros, nas regras de pontuação, na dinâmica de queda das peças etc. Mais informações podem ser obtidas aqui.

Neste trabalho você deverá desenvolver e implementar uma plataforma online, usando as ferramentas estudadas na disciplina (HTML, CSS, JavaScript e PHP), que permita que um jogador cadastrado jogue partidas de uma nova versão do jogo Tetris, chamada Mirror Tetris (MT).

MT segue regras parecidas com as da versão clássica de Tetris, mas com as seguintes particularidades:

Ao longo da partida e de maneira aleatória podem surgir peças especiais que, quando compõem uma linha eliminada, provocam o espelhamento do tabuleiro em relação ao eixo vertical (vide Figura 2). Ou seja, o jogador passa a enxergar o tabuleiro como se ele estivesse em um "espelho" (ou do "lado de dentro" da tela), o que aumenta a dificuldade da partida, uma vez que, além da alteração na posição das peças, os controles de deslocamento (esquerda e direita) ficam "invertidos". Este comportamento de espelhamento se repete toda vez que uma peça especial esteja presente em uma linha eliminada.

O jogador deverá ter a opção de escolha do tamanho do tabuleiro em que a partida se desenrolará. Pelo menos duas opções deverão ser dadas: (i) um tabuleiro clássico, com 10 células de largura e 20 células de altura (igual ao da Figura 1); e (ii) um tabuleiro maior, de dimensões 22 x 44 células (largura x altura).
Além da peça especial que leva ao espelhamento do tabuleiro, formada por uma única célula do tabuleiro (quadradinho) e exibida em cor chamativa, seis peças diferentes, cujas estruturas são dadas na Figura 3, poderão surgir na tela (sempre uma por vez). A escolha da peça que surgirá deverá ser feita aleatoriamente pelo jogo, sendo que todas as sete peças (seis da Figura 3 mais a peça especial) deverão ter a mesma probabilidade de surgimento.
Peças do Tetris

O jogador controlará a movimentação das peças utilizando as quatro setas do teclado.
A pontuação deve levar em conta um bônus, a ser aplicado sempre que o usuário eliminar mais de uma linha de uma única vez. Cada linha eliminada gerará uma soma de 10 pontos no placar total do usuário e o bônus corresponderá à multiplicação dos pontos gerados em uma eliminação pelo número de linhas eliminadas simultaneamente. Por exemplo, se o jogador eliminar 3 linhas simultaneamente, será adicionado ao seu placar (10 + 10 + 10) x 3 = 90 pontos. Lembre-se que o usuário poderá eliminar, no máximo, quatro linhas simultaneamente.
A velocidade com que cada peça desce pelo tabuleiro deve variar conforme o placar do jogador, para que a dificuldade aumente com o passar do tempo. Você deverá programar o jogo para que a velocidade aumente sempre que o jogador atingir uma pontuação múltipla de 300 pontos. Caberá a você calibrar como esta velocidade mudará. Cuide para que o jogo não se torne muito difícil muito rapidamente nem seja muito lento para se tornar desafiador.
A implementação de MT deverá ser toda feita em JavaScript, para execução no front-end. No entanto, a plataforma online do jogo também deverá contar com um módulo em back-end, responsável por gerenciar a autenticação dos jogadores, o armazenamento e recuperação dos resultados de cada partida jogada e a elaboração de um ranking dos 10 melhores jogadores de MT cadastrados na plataforma. Mais informações sobre o front-end e back-end são dadas a seguir.

Front-end

A primeira tela a ser exibida para qualquer usuário que acesse o sistema deve conter dois campos de um formulário para autenticação: um para o usuário e o outro para a senha (além de um botão para enviar os dados fornecidos). Além disso, deverá haver um link para uma página de cadastro no sistema, caso o usuário não possua usuário e senha.

Na página de cadastro o sistema deverá solicitar os seguintes dados de um novo jogador: nome completo, data de nascimento, CPF, telefone e e-mail, além do username (único) e da senha para acesso ao sistema. Estes dados deverão ser mantidos na plataforma enquanto a conta do jogador estiver ativa.

Uma vez autenticado no sistema, o jogador deverá ser redirecionado para uma página que contenha o MT implementado em JavaScript. Além do jogo em si, nessa página o usuário deverá visualizar pelo menos as seguintes informações:

Tempo da partida até o momento (caso iniciada), pontuação, número de linhas eliminadas e nível de dificuldade em que se encontra (associado à velocidade de queda das peças).
Ranking com os resultados de todas as partidas jogadas anteriormente por aquele jogador. Tal ranking deve exibir as seguintes informações: nome do jogador, pontuação obtida, nível atingido e tempo de duração da partida.
Na página que contém o MT o usuário também deverá ter acesso a hyperlinks que o levam a duas outras páginas do sistema, além de uma opção para desconectar e retornar à página de login: uma página com o ranking global de jogadores e outra onde ele poderá editar suas informações pessoais. Nesta página de edição de informações pessoais, os campos data de nascimento, CPF e username NÃO poderão ser alterados.

Por fim, na página de ranking global de jogadores o sistema deverá mostrar os usernames, pontuações e nível máximo atingido para as 10 melhores pontuações obtidas dentre todos os jogadores registrados no sistema, além de um indicativo da posição atual em que o jogador autenticado no sistema estaria dentro deste ranking global.

Ao final de cada partida, o sistema deverá permitir ao usuário escolher se ele deseja ou não iniciar uma nova partida.


Back-end

Como já mencionado, o back-end da plataforma do MT será responsável por gerenciar a autenticação dos jogadores, o armazenamento e recuperação dos resultados de cada partida jogada e a elaboração do ranking de melhores jogadores cadastrados. Toda a implementação do back-end deverá ser feita em PHP e os dados armazenados em um Sistema Gerenciador de Bancos de Dados (SGBD) MySQL ou MariaDB.

Além do armazenamento persistente dos dados e sua recuperação sempre que necessário, caberá à implementação do back-end garantir que apenas usuários autenticados tenham acesso às páginas da plataforma. Caso um usuário não esteja autenticado, ele NÃO poderá acessar nenhuma página do sistema exceto a página de login (página inicial). Para isso, deverá ser utilizado o mecanismo de sessões de PHP.

As tabelas MySQL/MariaDB em que ficarão armazenados os dados tanto das partidas quanto de usuários do sistema devem ser definidas pelo grupo. A partir dessas definições, deverá ser entregue um script PHP (separado do projeto principal) para criação das tabelas necessárias para o correto funcionamento do sistema, além de um arquivo-texto com instruções para sua utilização. Outra opção é programar o sistema para criar automaticamente as tabelas em sua primeira execução.
