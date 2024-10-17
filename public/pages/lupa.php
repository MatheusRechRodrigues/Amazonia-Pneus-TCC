<?php
session_start();
include '../../app/functions/database/conect.php';

$pdo = conect();
$sql = "SELECT * FROM tb_pneus";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - ERP Central de Materiais</title>

    <!-- Fonte Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/crudstyle.css">

   <!-- jQuery -->
   <script src="../assets/js/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!-- Main content -->
    <main>
        <section class="hero">
            <h1>Gerenciamento de Categorias</h1>
        </section>

        <!-- Barra de Pesquisa -->
        <div class="search-container">
            <input type="text" id="search" placeholder="Pesquisar categorias..." class="search-bar" />
            <div class="no-results">Nenhum resultado encontrado.</div> <!-- Mensagem de nenhum resultado -->
        </div>

        <div class="containerconsulta">
            <br><br><br><br>
            <table class="table table-striped" id="categoriasTable"> <!-- Adicionado ID aqui -->
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

    <!-- Script de Pesquisa -->
    <script>
    $(document).ready(function() {
        $('.no-results').hide(); // Ocultar a mensagem ao carregar

        $('#search').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();
            var hasResults = false;

            $('#categoriasTable tbody tr').each(function() { // ID corrigido aqui
                var row = $(this);
                var rowData = row.text().toLowerCase();

                if (rowData.includes(searchTerm)) {
                    row.fadeIn(100);
                    hasResults = true;
                } else {
                    row.fadeOut(100);
                }
            });

            if (!hasResults && searchTerm !== "") {
                $('.no-results').fadeIn(100);
            } else {
                $('.no-results').fadeOut(100);
            }
        });
    });
    </script>

</body>
</html>
