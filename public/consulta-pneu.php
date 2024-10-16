<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Grupos</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">

</head>

<body>

<header>
    <div class="menubar">
        
    </div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>


<?php
// Verifica se o parâmetro de pesquisa foi enviado (somente quando o AJAX faz a requisição)
if (isset($_POST['pesquisa'])) {
    $pesquisa = $_POST['pesquisa'];

    try {
        // Consulta SQL com INNER JOIN para buscar os pneus e suas medidas
        $sql = "SELECT tb_pneus.codpneu, tb_medidas.largura, tb_medidas.altura, tb_medidas.raio
                FROM tb_pneus
                JOIN tb_medidas ON tb_pneus.codmedida = tb_medidas.codmedida
                WHERE tb_pneus.codpneu LIKE :pesquisa
                LIMIT 5";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%', PDO::PARAM_STR);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Depuração: Exibir resultados
        if ($resultados) {
            echo "<ul>";
            foreach ($resultados as $pneu) {
                echo "<li>" . htmlspecialchars($pneu['codpneu']) . " - " . htmlspecialchars($pneu['largura']) . "/" . htmlspecialchars($pneu['altura']) . " R" . htmlspecialchars($pneu['raio']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<ul><li>Nenhum pneu encontrado</li></ul>";
        }
        exit;  // Finaliza o script após retornar a resposta para o AJAX
    } catch (PDOException $e) {
        echo "Erro ao executar a consulta: " . $e->getMessage();
        exit;
    }
}
?>



<script>
        // Função que envia a pesquisa em tempo real
        function pesquisaPneu() {
            var pesquisa = document.getElementById("pesquisa").value;

            if (pesquisa.length >= 2) {  // Começa a buscar a partir de 2 caracteres
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("resultado").innerHTML = xhr.responseText;
                        document.getElementById("resultado").style.display = "block"; // Exibe o dropdown
                    }
                };
                xhr.open("POST", "", true);  // Envia a requisição para o mesmo arquivo
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("pesquisa=" + pesquisa);
            } else {
                document.getElementById("resultado").innerHTML = "";
                document.getElementById("resultado").style.display = "none"; // Esconde o dropdown
            }
        }
    </script>
    <h1>Pesquisa de Pneus</h1>
    <form method="POST" action="">
        <input type="text" id="pesquisa" name="pesquisa" placeholder="Digite o nome do pneu" onkeyup="pesquisaPneu()" autocomplete="off">
        <div class="dropdown-content" id="resultado"></div>
    </form>



<br><br><br>










<div class="containerconsulta">
        <h2>Tabela de Pneus</h2>
        <table class="table table-striped">
            <thead>
                <tr class="trgreen">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Tipo</th>
                    <th>Preço</th>
                </tr>
            </thead>

            <tbody>
                <?php


                try {

                    $sql = "SELECT * FROM tb_pneus";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['codpneu']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nomepneu']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['descricao']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['preco']) . "</td>";
                        echo "<td> <a href='alter-pneu.php?codpneu=" .  htmlspecialchars($row['codpneu']) . "' class='btn btn-danger'>Alterar</a> </td>";
                        echo "<td> <a href='exclusao-pneu.php?codpneu=" .  htmlspecialchars($row['codpneu']) . "' class='btn btn-danger'>Excluir</a> </td>";
                       
                        echo "</tr>";
                    }
                } catch (\PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
                ?>



            </tbody>

        </table>
    </div>

    
           <button class="containerconsultavoltar">
                <a href="./pages/inicio.php">Voltar</a>
           </button>
         

           <button class="containerconsultavoltar2">
                <a href="cadastro-pneu.php">Cadastrar</a>
                </button>
    </table>
</body>

</html>