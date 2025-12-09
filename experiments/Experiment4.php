<?php
$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($name)) {
        $errors['name'] = 'Name is required';
    } elseif (strlen($name) < 3) {
        $errors['name'] = 'Name must be at least 3 characters';
    }
    
    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }
    
    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    }
    
    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }
    
    if (empty($errors)) {
        $success = true;
    }
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sign Up Form with Validation</title>
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
        .form-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 500px;
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
        input[type='text'],
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
        .error {
            color: #d32f2f;
            font-size: 14px;
            margin-top: 5px;
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
            transition: transform 0.2s;
        }
        button:hover {
            transform: translateY(-2px);
        }
        .message {
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .message.success {
            background: #d4edda;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class='form-container'>
        <h1>Sign Up Form</h1>";
        
if ($success) {
    echo "<div class='message success'>
        Registration successful! Welcome aboard!<br>
        Name: " . htmlspecialchars($name) . "<br>
        Email: " . htmlspecialchars($email) . "
    </div>";
}

echo "<form method='POST'>
            <div class='form-group'>
                <label for='name'>Full Name</label>
                <input type='text' id='name' name='name' value='" . htmlspecialchars($_POST['name'] ?? '') . "' required>
                " . (isset($errors['name']) ? "<div class='error'>" . htmlspecialchars($errors['name']) . "</div>" : "") . "
            </div>
            
            <div class='form-group'>
                <label for='email'>Email Address</label>
                <input type='email' id='email' name='email' value='" . htmlspecialchars($_POST['email'] ?? '') . "' required>
                " . (isset($errors['email']) ? "<div class='error'>" . htmlspecialchars($errors['email']) . "</div>" : "") . "
            </div>
            
            <div class='form-group'>
                <label for='password'>Password</label>
                <input type='password' id='password' name='password' required>
                " . (isset($errors['password']) ? "<div class='error'>" . htmlspecialchars($errors['password']) . "</div>" : "") . "
            </div>
            
            <div class='form-group'>
                <label for='confirm_password'>Confirm Password</label>
                <input type='password' id='confirm_password' name='confirm_password' required>
                " . (isset($errors['confirm_password']) ? "<div class='error'>" . htmlspecialchars($errors['confirm_password']) . "</div>" : "") . "
            </div>
            
            <button type='submit'>Sign Up</button>
        </form>
    </div>
</body>
</html>";
?>