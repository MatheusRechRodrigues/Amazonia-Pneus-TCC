<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">
</head>

<body>
<!-- jQuery -->
<script src="./assets/js/jquery-3.6.0.min.js"></script>

<header>
    <div class="menubar"></div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<!-- Barra de Pesquisa -->
<div class="search-container">
    <input type="text" id="search" placeholder="Pesquisar compras..." class="search-bar" />
    <div class="no-results">Nenhum resultado encontrado.</div> <!-- Mensagem de nenhum resultado -->
</div>

<button class="containerconsultavoltar">
    <a href="./pages/inicio.php">Voltar</a>
</button>

<button class="containerconsultavoltar2">
    <a href="cadastro-compra.php">Cadastrar</a>
</button>

<div class="containerconsulta">
    <h2>Tabela de Compras</h2>
    <table class="table table-striped" id="comprasTable"> <!-- ID adicionado -->
        <thead>
            <tr class="trgreen">
                <th>ID</th>
                <th>Entregue</th>
                <th>Entrega</th>
                <th>Código de Entrega</th>
                <th>Valor da Entrega (R$)</th>
                <th>Forma de Pagamento</th>
                <th>Data da Compra</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $sql = "SELECT * FROM tb_compras";
                $stmt = $pdo->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['codcompra']) . "</td>";
                    echo "<td>" . ($row['entregue'] ? 'Sim' : 'Não') . "</td>";
                    echo "<td>" . htmlspecialchars($row['entrega']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['codentrega']) . "</td>";
                    echo "<td>" . htmlspecialchars(number_format($row['valorentrega'], 2, ',', '.')) . "</td>";
                    echo "<td>" . htmlspecialchars($row['formapagamento']) . "</td>";
                    echo "<td>" . htmlspecialchars(date('d/m/Y', strtotime($row['dtcompra']))) . "</td>";
                    
                    
                    echo "<td>
                            <a href='alter-compra.php?codcompra=" . htmlspecialchars($row['codcompra']) . "' class='btn btn-danger'>Alterar</a>
                            <a href='exclusao-compra.php?codcompra=" . htmlspecialchars($row['codcompra']) . "' class='btn btn-danger'>Excluir</a>
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



<script>
$(document).ready(function() {
    $('.no-results').hide(); // Ocultar a mensagem ao carregar

    $('#search').on('input', function() {
        var searchTerm = $(this).val().toLowerCase();
        var hasResults = false;

        $('#comprasTable tbody tr').each(function() { // ID corrigido
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
