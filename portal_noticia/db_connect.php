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

// Obtém os dados do formulário
$titulo = $_POST['titulo'];
$conteudo = $_POST['conteudo'];
$fonte = $_POST['fonte'];
$url_imagem = $_POST['url_imagem'];
$categoria = $_POST['categoria'];

// Monta a query SQL para inserção
$sql = "INSERT INTO noticias (titulo, conteudo, fonte, url_imagem, categoria) VALUES ('$titulo', '$conteudo', '$fonte', '$url_imagem', '$categoria')";

// Executa a query e verifica se foi bem-sucedida
if ($conn->query($sql) === TRUE) {
    echo "Notícia publicada com sucesso!";
} else {
    echo "Erro ao publicar notícia: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
