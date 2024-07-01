<?php
// update_task.php

// Incluir o arquivo de conexão com o banco de dados
require_once 'db_connection.php';

// Verificar se foram recebidos os dados do formulário via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'], $_POST['titulo'], $_POST['descricao'], $_POST['status'])) {
    $idTarefa = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $status = $_POST['status'];

    try {
        // Preparar a query SQL para atualizar os dados da tarefa pelo ID
        $stmt = $pdo->prepare("UPDATE tarefas SET titulo = :titulo, descricao = :descricao, status = :status WHERE id = :id");
        $stmt->bindParam(':id', $idTarefa, PDO::PARAM_INT);
        $stmt->bindParam(':titulo', $titulo, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);
        $stmt->execute();

        echo "Tarefa atualizada com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao atualizar tarefa: " . $e->getMessage();
    }
} else {
    echo "Dados do formulário não foram recebidos ou incompletos.";
}
?>
