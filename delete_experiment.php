<?php
require_once 'config.php';
requireLogin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

$experiment_id = intval($_POST['id'] ?? 0);
$experiment_no = intval($_POST['experiment_no'] ?? 0);

if (empty($experiment_id)) {
    echo json_encode(['success' => false, 'message' => 'Invalid experiment ID']);
    exit();
}

$conn = getDBConnection();

// Delete from database
$stmt = $conn->prepare("DELETE FROM experiments WHERE id = ?");
$stmt->bind_param("i", $experiment_id);

if ($stmt->execute()) {
    // Delete PHP file
    $exp_file = "experiments/Experiment{$experiment_no}.php";
    if (file_exists($exp_file)) {
        unlink($exp_file);
    }
    
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => true, 'message' => 'Experiment deleted successfully']);
} else {
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => false, 'message' => 'Failed to delete experiment']);
}
?>

