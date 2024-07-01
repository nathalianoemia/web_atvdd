<?php
// read_tasks.php

// Incluir o arquivo de conexão com o banco de dados
include 'db_connection.php';

try {
    // Preparar a query SQL para selecionar todas as tarefas
    $stmt = $pdo->query("SELECT * FROM tarefas ORDER BY data_criacao DESC");
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar as tarefas como JSON
    echo json_encode($tarefas);
} catch (PDOException $e) {
    echo "Erro ao recuperar tarefas: " . $e->getMessage();
}
?>
