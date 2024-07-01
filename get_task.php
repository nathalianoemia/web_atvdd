<?php require_once 'db_connection.php';

// Verificar se foi recebido o ID da tarefa via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $idTarefa = $_POST['id'];

    try {
        // Preparar a query SQL para obter os dados da tarefa pelo ID
        $stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id = :id");
        $stmt->bindParam(':id', $idTarefa, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar se encontrou a tarefa
        if ($stmt->rowCount() > 0) {
            $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode($tarefa);
        } else {
            echo json_encode(['error' => 'Tarefa não encontrada']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro ao obter detalhes da tarefa: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'ID da tarefa não foi recebido']);
}?>