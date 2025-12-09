<?php
require_once 'config.php';
requireLogin();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

$experiment_no = intval($_POST['experiment_no'] ?? 0);
$experiment_name = trim($_POST['experiment_name'] ?? '');
$code = $_POST['code'] ?? '';

if (empty($experiment_no) || empty($experiment_name) || empty($code)) {
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

$conn = getDBConnection();

// Check if experiment_no already exists
$stmt = $conn->prepare("SELECT id FROM experiments WHERE experiment_no = ?");
$stmt->bind_param("i", $experiment_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => false, 'message' => 'Experiment number already exists']);
    exit();
}
$stmt->close();

// Insert into database
$stmt = $conn->prepare("INSERT INTO experiments (experiment_no, experiment_name, code) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $experiment_no, $experiment_name, $code);

if ($stmt->execute()) {
    // Create PHP file
    $exp_file = "experiments/Experiment{$experiment_no}.php";
    if (!file_exists('experiments')) {
        mkdir('experiments', 0777, true);
    }
    file_put_contents($exp_file, $code);
    
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => true, 'message' => 'Experiment added successfully']);
} else {
    $stmt->close();
    $conn->close();
    echo json_encode(['success' => false, 'message' => 'Failed to add experiment']);
}
?>

