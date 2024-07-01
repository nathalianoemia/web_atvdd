<?php
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    try {
        $stmt = $pdo->prepare("INSERT INTO tarefas (titulo, descricao) VALUES (?, ?)");
        $stmt->execute([$titulo, $descricao]);
        header("Location: index.html");
    } catch (PDOException $e) {
        echo "Erro ao adicionar a tarefa: " . $e->getMessage();
    }
}
?>
