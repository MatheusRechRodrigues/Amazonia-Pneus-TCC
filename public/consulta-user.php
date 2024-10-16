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


<button class="containerconsultavoltar">
        <a href="./pages/inicio.php"><img src="./assets/icon/seta-pequena-esquerda.png" class="mais-buttom"></a>
    </button>

    <button class="containerconsultavoltar2">
        <a href="cadastro-img.php"><img src="./assets/icon/mais.png" class="mais-buttom2"></a>
    </button>


<div class="containerconsulta">
        <h2>Tabela de Usuarios</h2>
        <table class="table table-striped">
            <thead>
                <tr class="trgreen">
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Rua</th>
                    <th>Cpf</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                    <th>N° casa</th>
                    <th>Bairro</th>
                    <th>Complemento</th>
                    <th>Tipo</th>
                    <th>Ativo</th>
                </tr>
            </thead>

            <tbody>
                <?php


                try {

                    $sql = "SELECT * FROM tb_clientes";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['codcliente']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['rua']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['cpf']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['fone']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['datanasc']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ncasa']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['bairro']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['complemento']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['ativo']) . "</td>";
                        echo "<td> <a href='alter-user.php?codcliente=" .  htmlspecialchars($row['codcliente']) . "' class='btn btn-danger'>Alterar</a> </td>";
                        echo "<td> <a href='exclusao-user.php?codcliente=" .  htmlspecialchars($row['codcliente']) . "' class='btn btn-danger'>Excluir</a> </td>";
                       

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