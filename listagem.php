<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Notícias</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Lista de Notícias</h1>

    <?php
    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portal_noticias";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // Query para selecionar todas as notícias ordenadas pela data de publicação (supondo que tenha uma coluna de data de publicação na tabela)
    $sql = "SELECT * FROM noticias ORDER BY data_publicacao DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Exibir os dados encontrados em forma de lista
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>";
            echo "<h2>" . htmlspecialchars($row['titulo']) . "</h2>";
            echo "<p>" . nl2br(htmlspecialchars($row['conteudo'])) . "</p>";
            echo "<p><strong>Fonte:</strong> " . htmlspecialchars($row['fonte']) . "</p>";
            
            if (!empty($row['url_imagem'])) {
                echo '<img src="' . htmlspecialchars($row['url_imagem']) . '" alt="Imagem da Notícia">';
            }
            
            echo "<p><strong>Categoria:</strong> " . htmlspecialchars($row['categoria']) . "</p>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "Não há notícias publicadas ainda.";
    }

    // Fechar a conexão com o banco de dados
    $conn->close();
    ?>

    <a href="index.html">Voltar para a página de publicação de notícias</a>
</body>
</html>
