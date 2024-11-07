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
    <link rel="shortcut icon" href="./assets/icon/logoamazonia.ico" type="image/x-icon">
</head>

<!-- jQuery -->
<script src="./assets/js/jquery-3.6.0.min.js"></script>

<body>

<header>
    <div class="menubar"></div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<!-- Barra de Pesquisa -->
<div class="search-container">
    <input type="text" id="search" placeholder="Pesquisar imagens..." class="search-bar" />
    <div class="no-results">Nenhum resultado encontrado.</div> <!-- Mensagem de nenhum resultado -->
</div>

<button class="containerconsultavoltar">
    <a href="./pages/inicio.php"><img src="./assets/icon/seta-pequena-esquerda.png" class="mais-buttom"></a>
</button>

<button class="containerconsultavoltar2">
    <a href="cadastro-img.php"><img src="./assets/icon/mais.png" class="mais-buttom2"></a>
</button>

<div class="containerconsulta">
    <h2>Tabela de Imagens</h2>
    <table class="table table-striped" id="categoriasTable"> <!-- Adicionado ID aqui -->
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
                    echo "<td><img src='" . htmlspecialchars($row['url']) . "' alt='Imagem' style='max-width: 100px; max-height: 100px;'></td>";
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
