<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Medidas</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">

</head>

<body>

<header>
    <div class="menubar">
        
    </div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<div class="containerconsulta">
        <h2>Tabela de Medidas</h2>
        <table class="table table-striped">
            <thead>
                <tr class="trgreen">
                    <th>ID</th>
                    <th>Largura</th>
                    <th>Aro</th>
                    <th>Medida</th>
                    <th>Altura</th>
                    <th>Indice Carga</th>
                    <th>Velocidade</th>
                    <th>Construção</th>
                    <th>Raio</th>
                    
                </tr>
            </thead>

            <tbody>
                <?php


                try {

                    $sql = "SELECT * FROM tb_medidas";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['codmedida']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['largura']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['aro']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['medida']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['altura']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['indicecarga']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['velocidade']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['construcao']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['raio']) . "</td>";
                       
                        echo "<td> <a href='alter-med.php?codmedida=" .  htmlspecialchars($row['codmedida']) . "' class='btn btn-danger'>Alterar</a> </td>";
                        echo "<td> <a href='exclusao-med.php?codmedida=" .  htmlspecialchars($row['codmedida']) . "' class='btn btn-danger'>Excluir</a> </td>";
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
                <a href="cadastro-med.php">Cadastrar</a>
                </button>
         
    </table>
</body>

</html>