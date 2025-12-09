<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';
$success = false;

// Simple demo user database
$users = [
    'john@example.com' => password_hash('password123', PASSWORD_DEFAULT),
    'jane@example.com' => password_hash('hello123', PASSWORD_DEFAULT)
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Please enter both email and password';
    } else {
        if (isset($users[$email]) && password_verify($password, $users[$email])) {
            $_SESSION['user_email'] = $email;
            $_SESSION['logged_in'] = true;
            $success = true;
        } else {
            $error = 'Invalid email or password';
        }
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}

$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'];

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Login & Authentication</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: 500;
        }
        input[type='email'],
        input[type='password'] {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        .auth-box {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 8px;
        }
        .user-info {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .logout-btn {
            background: #dc3545;
            color: white;
            text-decoration: none;
            padding: 10px 30px;
            border-radius: 8px;
            display: inline-block;
        }
        .demo-accounts {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class='container'>";

if ($is_logged_in || $success) {
    echo "<div class='auth-box'>
            <h1>✅ Welcome!</h1>
            <div class='user-info'>
                <strong>Email:</strong> " . htmlspecialchars($_SESSION['user_email']) . "
            </div>
            <p>You are successfully logged in.</p>
            <a href='?logout=1' class='logout-btn'>Logout</a>
        </div>";
} else {
    echo "<h1>🔐 User Login</h1>";
    
    if ($error) {
        echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
    }
    
    echo "<form method='POST' action=''>
                <div class='form-group'>
                    <label for='email'>Email Address</label>
                    <input type='email' id='email' name='email' required 
                           value='" . htmlspecialchars($_POST['email'] ?? '') . "'>
                </div>
                
                <div class='form-group'>
                    <label for='password'>Password</label>
                    <input type='password' id='password' name='password' required>
                </div>
                
                <button type='submit' name='login'>Login</button>
            </form>
            
            <div class='demo-accounts'>
                <strong>Demo Accounts:</strong><br>
                Email: john@example.com | Password: password123<br>
                Email: jane@example.com | Password: hello123
            </div>
            
            <p style='margin-top: 20px; text-align: center; color: #666;'>
                This demonstrates secure login with:<br>
                • Session management<br>
                • Password hashing (password_hash/password_verify)<br>
                • Form validation
            </p>";
}

echo "</div>
</body>
</html>";
?>