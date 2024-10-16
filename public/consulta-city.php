<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Cidades</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">

</head>

<body>

<header>
    <div class="menubar">
        
    </div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>



<button class="containerconsultavoltar">
                <a href="./pages/inicio.php">Voltar</a>
           </button>


           <button class="containerconsultavoltar2">
                <a href="cadastro-city.php">Cadastrar</a>
                </button>





<div class="containerconsulta">
        <h2>Tabela de Cidades</h2>
        <table class="table table-striped">
            <thead>
                <tr class="trgreen">
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Nome</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php


                try {

                    $sql = "SELECT * FROM tb_cidades";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['codcidade']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['estado']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td> <a href='alter-city.php?codcidade=" .  htmlspecialchars($row['codcidade']) . "' class='btn btn-danger'>Alterar</a> </td>";
                        echo "<td> <a href='exclusao-city.php?codcidade=" .  htmlspecialchars($row['codcidade']) . "' class='btn btn-danger'>Excluir</a> </td>";

                        echo "</tr>";
                    }
                } catch (\PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
                ?>



            </tbody>

        </table>
    </div>

    
         
         
    </table>
</body>

</html>