<?php
require_once 'config.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $qid = trim($_POST['qid'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validation
    if (empty($name) || empty($qid) || empty($password)) {
        $error = 'Please fill all required fields.';
    } elseif (!preg_match('/^245100\d{2}$/', $qid)) {
        $error = 'QID must be in format 245100XX (8 digits starting with 245100).';
    } elseif (strlen($password) < 6) {
        $error = 'Password must be at least 6 characters.';
    } else {
        $conn = getDBConnection();
        
        // Check if QID already exists
        $stmt = $conn->prepare("SELECT id FROM students WHERE qid = ?");
        $stmt->bind_param("s", $qid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $error = 'QID already registered. Please login instead.';
        } else {
            // Insert new student
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO students (name, qid, email, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $qid, $email, $hashedPassword);
            
            if ($stmt->execute()) {
                $success = 'Registration successful! Please login.';
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
        $stmt->close();
        $conn->close();
    }
}

// If already logged in, redirect to dashboard
if (isLoggedIn()) {
    header('Location: dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Student Experiment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <h2 class="text-center mb-4">Student Registration</h2>
            
            <?php if ($error): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name *</label>
                    <input type="text" class="form-control" id="name" name="name" required 
                           value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>
                
                <div class="mb-3">
                    <label for="qid" class="form-label">QID (245100XX) *</label>
                    <input type="text" class="form-control" id="qid" name="qid" required 
                           pattern="245100\d{2}" placeholder="e.g., 24510023"
                           value="<?= htmlspecialchars($_POST['qid'] ?? '') ?>">
                    <small class="form-text text-muted">Format: 245100XX (8 digits)</small>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email (Optional)</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password *</label>
                    <input type="password" class="form-control" id="password" name="password" required minlength="6">
                </div>
                
                <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
            </form>
            
            <div class="text-center">
                <p class="mb-0">Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

