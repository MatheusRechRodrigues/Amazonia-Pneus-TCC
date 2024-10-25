<?php

include '../../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();

?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Pneus</title>
    <link rel="stylesheet" href="../assets/css/crudstyle.css">
</head>

<body>
<!-- jQuery -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>

<header>
    <div class="menubar"></div>
    <img src="../assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<!-- Barra de Pesquisa -->
<div class="search-container">
    <input type="text" id="search" placeholder="Pesquisar pneus..." class="search-bar" />
    <div class="no-results">Nenhum resultado encontrado.</div> <!-- Mensagem de nenhum resultado -->
</div>

<!-- Botões de navegação -->
<button class="containerconsultavoltar">
    <a href="../pages/inicio.php"><img src="../assets/icon/seta-pequena-esquerda.png" class="mais-buttom"></a>
</button>

<?php
$codcompra = 1; // Supondo um código de compra fixo (pode ser gerenciado via sessão)

// Buscar os itens no carrinho
$queryCarrinho = $pdo->prepare("SELECT p.nomepneu, cp.qntd, cp.preco FROM tb_compras_pneus cp
                                JOIN tb_pneus p ON cp.codpneu = p.codpneu
                                WHERE cp.codcompra = :codcompra");
$queryCarrinho->bindParam(':codcompra', $codcompra);
$queryCarrinho->execute();

$itensCarrinho = $queryCarrinho->fetchAll(PDO::FETCH_ASSOC);

if ($itensCarrinho) {
    echo "<h2>Itens no Carrinho</h2>";
    echo "<table border='1'>
            <tr>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço</th>
            </tr>";
    foreach ($itensCarrinho as $item) {
        echo "<tr>
                <td>{$item['nomepneu']}</td>
                <td>{$item['qntd']}</td>
                <td>R$ " . number_format($item['preco'], 2, ',', '.') . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Seu carrinho está vazio.";
}
?>
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