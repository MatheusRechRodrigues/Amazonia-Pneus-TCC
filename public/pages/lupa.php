<?php
// Conexão com o banco de dados
include '../../app/functions/database/conect.php';

try {
    $pdo = conect();
    if (!$pdo) {
        die("Erro ao conectar ao banco de dados.");
    }
} catch (Exception $e) {
    die("Erro: " . $e->getMessage());
}

session_start();

// Verifica se o parâmetro de pesquisa foi enviado (somente quando o AJAX faz a requisição)
if (isset($_POST['pesquisa'])) {
    $pesquisa = $_POST['pesquisa'];

    try {
        // Consulta SQL com INNER JOIN para buscar os pneus e suas medidas
        $sql = "SELECT tb_pneus.nomepneu, tb_medidas.largura, tb_medidas.altura, tb_medidas.raio
                FROM tb_pneus
                JOIN tb_medidas ON tb_pneus.codmedida = tb_medidas.codmedida
                WHERE tb_pneus.nomepneu LIKE :pesquisa
                LIMIT 5";
        
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':pesquisa', '%' . $pesquisa . '%', PDO::PARAM_STR);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Depuração: Exibir resultados
        if ($resultados) {
            echo "<ul>";
            foreach ($resultados as $pneu) {
                echo "<li>" . htmlspecialchars($pneu['nomepneu']) . " - " . htmlspecialchars($pneu['largura']) . "/" . htmlspecialchars($pneu['altura']) . " R" . htmlspecialchars($pneu['raio']) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<ul><li>Nenhum pneu encontrado</li></ul>";
        }
        exit;  // Finaliza o script após retornar a resposta para o AJAX
    } catch (PDOException $e) {
        echo "Erro ao executar a consulta: " . $e->getMessage();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa de Pneus</title>
    <style>
        /* Estilos para o dropdown */
        .dropdown-content {
            position: absolute;
            border: 1px solid #ddd;
            background-color: white;
            max-height: 150px;
            overflow-y: auto;
            width: 300px;
            display: none; /* Começa como invisível */
        }

        .dropdown-content li {
            padding: 10px;
            cursor: pointer;
            list-style: none;
        }

        .dropdown-content li:hover {
            background-color: #f1f1f1;
        }
    </style>
    <script>
        // Função que envia a pesquisa em tempo real
        function pesquisaPneu() {
            var pesquisa = document.getElementById("pesquisa").value;

            if (pesquisa.length >= 2) {  // Começa a buscar a partir de 2 caracteres
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        document.getElementById("resultado").innerHTML = xhr.responseText;
                        document.getElementById("resultado").style.display = "block"; // Exibe o dropdown
                    }
                };
                xhr.open("POST", "", true);  // Envia a requisição para o mesmo arquivo
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("pesquisa=" + pesquisa);
            } else {
                document.getElementById("resultado").innerHTML = "";
                document.getElementById("resultado").style.display = "none"; // Esconde o dropdown
            }
        }
    </script>
</head>
<body>
    <h1>Pesquisa de Pneus</h1>
    <form method="POST" action="">
        <input type="text" id="pesquisa" name="pesquisa" placeholder="Digite o nome do pneu" onkeyup="pesquisaPneu()" autocomplete="off">
        <div class="dropdown-content" id="resultado"></div>
    </form>
</body>
</html>
