<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO

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
<div class="container mt-5">
    <h2>Tabela de Grupos</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Rua</th>
                <th>Cpf</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Senha</th>
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
            echo "<td>" . htmlspecialchars($row['senha']) . "</td>";
            echo "<td>" . htmlspecialchars($row['datanasc']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ncasa']) . "</td>";
            echo "<td>" . htmlspecialchars($row['bairro']) . "</td>";
            echo "<td>" . htmlspecialchars($row['complemento']) . "</td>";
            echo "<td>" . htmlspecialchars($row['tipo']) . "</td>";
            echo "<td>" . htmlspecialchars($row['ativo']) . "</td>";
            echo "<td> <a href='alter.php?codcliente=" .  htmlspecialchars($row['codcliente']) . "' class='btn btn-danger'>Alterar</a> </td>";
            
            echo "</tr>";
        }
    } catch (\PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
    ?>



</tbody>

    </table>
</div>


</body>
</html>