<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Imagens</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">
</head>

<body>

<header>
    <div class="menubar">
        
    </div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<div class="containerconsulta">
        <h2>Tabela de Imagens</h2>
        <table class="table table-striped">
            <thead>
                <tr class="trgreen">
                    <th>ID</th>
                    <th>Nome da Imagem</th>
                    <th>URL</th>
                    <th>Pneu Relacionado</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php
                try {
                    $sql = "SELECT * FROM tb_imagens";
                    $stmt = $pdo->query($sql);

                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['codimg']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['nomeimg']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['url']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['codpneu']) . "</td>";
                        echo "<td> 
                                <a href='alter-img.php?codimg=" . htmlspecialchars($row['codimg']) . "' class='btn btn-danger'>Alterar</a> 
                                <a href='exclusao-img.php?codimg=" . htmlspecialchars($row['codimg']) . "' class='btn btn-danger'>Excluir</a> 
                              </td>";
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
        <a href="cadastro-img.php">Cadastrar</a>
    </button>
</body>

</html>
