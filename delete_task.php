<?php
// delete_task.php

// Incluir o arquivo de conexão com o banco de dados
include 'db_connection.php';

// Verificar se foi recebido o ID da tarefa a ser deletada
if (isset($_POST['id'])) {
    $idTarefa = $_POST['id'];

    try {
        // Preparar a query SQL para deletar a tarefa pelo ID
        $stmt = $pdo->prepare("DELETE FROM tarefas WHERE id = :id");
        $stmt->bindParam(':id', $idTarefa, PDO::PARAM_INT);
        $stmt->execute();

        echo "Tarefa deletada com sucesso!";
    } catch (PDOException $e) {
        echo "Erro ao deletar tarefa: " . $e->getMessage();
    }
} else {
    echo "ID da tarefa não foi recebido.";
}
?>
