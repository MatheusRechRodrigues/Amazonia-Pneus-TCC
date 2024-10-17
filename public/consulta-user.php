<?php
include '../app/functions/database/conect.php'; // Assumindo que você já criou uma função de conexão PDO
session_start();
$pdo = conect();
?>
<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="./assets/css/crudstyle.css">
</head>

<body>

<header>
    <div class="menubar"></div>
    <img src="./assets/image/bandaglogo.png" alt="" class="circleyellow">
</header>

<!-- jQuery -->
<script src="./assets/js/jquery-3.6.0.min.js"></script>

<!-- Barra de Pesquisa -->
<div class="search-container">
    <input type="text" id="search" placeholder="Pesquisar usuários..." class="search-bar" />
    <div class="no-results">Nenhum resultado encontrado.</div> <!-- Mensagem de nenhum resultado -->
</div>

<!-- Botões de navegação -->
<button class="containerconsultavoltar">
    <a href="./pages/inicio.php"><img src="./assets/icon/seta-pequena-esquerda.png" class="mais-buttom"></a>
</button>

<button class="containerconsultavoltar2">
    <a href="cadastro-img.php"><img src="./assets/icon/mais.png" class="mais-buttom2"></a>
</button>

<!-- Tabela de Usuários -->
<div class="containerconsulta">
    <h2>Tabela de Usuários</h2>
    <table class="table table-striped" id="categoriasTable"> <!-- Adicionei o ID necessário -->
        <thead>
            <tr class="trgreen">
                <th>ID</th>
                <th>Nome</th>
                <th>Rua</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>E-mail</th>
                <th>Data de Nascimento</th>
                <th>N° Casa</th>
                <th>Bairro</th>
                <th>Complemento</th>
                <th>Tipo</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            try {
                $sql = "SELECT * FROM tb_clientes"; // Consulta para obter os usuários
                $stmt = $pdo->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['codcliente']) . "</td>"; // ID do usuário
                    echo "<td>" . htmlspecialchars($row['nome']) . "</td>"; // Nome do usuário
                    echo "<td>" . htmlspecialchars($row['rua']) . "</td>"; // Rua
                    echo "<td>" . htmlspecialchars($row['cpf']) . "</td>"; // CPF
                    echo "<td>" . htmlspecialchars($row['fone']) . "</td>"; // Telefone
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>"; // E-mail
                    echo "<td>" . htmlspecialchars($row['datanasc']) . "</td>"; // Data de nascimento
                    echo "<td>" . htmlspecialchars($row['ncasa']) . "</td>"; // Número da casa
                    echo "<td>" . htmlspecialchars($row['bairro']) . "</td>"; // Bairro
                    echo "<td>" . htmlspecialchars($row['complemento']) . "</td>"; // Complemento
                    echo "<td>" . htmlspecialchars($row['tipo']) . "</td>"; // Tipo (cliente, admin, etc.)
                    echo "<td>" . htmlspecialchars($row['ativo']) . "</td>"; // Status ativo/inativo
                    echo "<td>
                            <a href='alter-user.php?codcliente=" . htmlspecialchars($row['codcliente']) . "' class='btn btn-danger'>Alterar</a>
                            <a href='exclusao-user.php?codcliente=" . htmlspecialchars($row['codcliente']) . "' class='btn btn-danger'>Excluir</a>
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
