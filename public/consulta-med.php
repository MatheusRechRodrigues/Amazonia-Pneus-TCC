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
<!-- jQuery -->
<script src="./assets/js/jquery-3.6.0.min.js"></script>

<header>
    <div class="menubar"></div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<!-- Barra de Pesquisa -->
<div class="search-container">
    <input type="text" id="search" placeholder="Pesquisar medidas..." class="search-bar" />
    <div class="no-results">Nenhum resultado encontrado.</div> <!-- Mensagem de nenhum resultado -->
</div>

<button class="containerconsultavoltar">
    <a href="./pages/inicio.php">Voltar</a>
</button>

<button class="containerconsultavoltar2">
    <a href="cadastro-med.php">Cadastrar</a>
</button>

<div class="containerconsulta">
    <h2>Tabela de Medidas</h2>
    <table class="table table-striped" id="categoriasTable"> <!-- ID adicionado -->
        <thead>
            <tr class="trgreen">
                <th>ID</th>
                <th>Largura</th>
                <th>Aro</th>
                <th>Medida</th>
                <th>Altura</th>
                <th>Índice de Carga</th>
                <th>Velocidade</th>
                <th>Construção</th>
                <th>Raio</th>
                <th>Ações</th>
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
                    echo "<td>
                            <a href='alter-med.php?codmedida=" . htmlspecialchars($row['codmedida']) . "' class='btn btn-danger'>Alterar</a>
                            <a href='exclusao-med.php?codmedida=" . htmlspecialchars($row['codmedida']) . "' class='btn btn-danger'>Excluir</a>
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

        $('#categoriasTable tbody tr').each(function() { // ID corrigido
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
