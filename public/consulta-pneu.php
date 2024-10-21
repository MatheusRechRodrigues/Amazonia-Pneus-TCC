<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Pneus</title>
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
    <input type="text" id="search" placeholder="Pesquisar pneus..." class="search-bar" />
    <div class="no-results">Nenhum resultado encontrado.</div> <!-- Mensagem de nenhum resultado -->
</div>

<!-- Botões de navegação -->
<button class="containerconsultavoltar">
    <a href="./pages/inicio.php"><img src="./assets/icon/seta-pequena-esquerda.png" class="mais-buttom"></a>
</button>

<button class="containerconsultavoltar2">
    <a href="cadastro-pneu.php"><img src="./assets/icon/mais.png" class="mais-buttom2"></a>
</button>

<div class="containerconsulta">
    <h2>Tabela de Pneus</h2>
    <table class="table table-striped" id="categoriasTable"> <!-- ID adicionado -->
        <thead>
            <tr class="trgreen">
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Tipo</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $sql = "SELECT * FROM tb_pneus"; // Consulta para obter os pneus
                $stmt = $pdo->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['codpneu']) . "</td>"; // ID do pneu
                    echo "<td>" . htmlspecialchars($row['nomepneu']) . "</td>"; // Nome do pneu
                    echo "<td>" . htmlspecialchars($row['descricao']) . "</td>"; // Descrição do pneu
                    echo "<td>" . htmlspecialchars($row['tipo']) . "</td>"; // Tipo do pneu
                    echo "<td>" . htmlspecialchars($row['preco']) . "</td>"; // Preço do pneu
                    echo "<td>
                            <a href='alter-pneu.php?codpneu=" . htmlspecialchars($row['codpneu']) . "' class='btn btn-danger'>Alterar</a>
                            <a href='exclusao-pneu.php?codpneu=" . htmlspecialchars($row['codpneu']) . "' class='btn btn-danger'>Excluir</a>
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

        $('#categoriasTable tbody tr').each(function() {
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
