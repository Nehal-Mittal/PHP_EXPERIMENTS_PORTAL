<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'set':
            $_SESSION['user_data'] = [
                'username' => 'JohnDoe',
                'role' => 'Student',
                'login_time' => date('Y-m-d H:i:s')
            ];
            $_SESSION['visit_count'] = isset($_SESSION['visit_count']) ? $_SESSION['visit_count'] + 1 : 1;
            $_SESSION['message'] = 'Session data set successfully!';
            break;
            
        case 'update':
            if (isset($_SESSION['user_data'])) {
                $_SESSION['user_data']['role'] = 'Admin';
                $_SESSION['visit_count']++;
                $_SESSION['message'] = 'Session data updated!';
            }
            break;
            
        case 'destroy':
            session_destroy();
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
            break;
    }
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Session Management in PHP</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .demo {
            background: #f8f9fa;
            padding: 20px;
            margin: 20px 0;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .demo h3 {
            margin-top: 0;
            color: #007bff;
        }
        .btn-group {
            display: flex;
            gap: 10px;
            margin: 20px 0;
            flex-wrap: wrap;
        }
        button, .btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        button:hover, .btn:hover {
            background: #0056b3;
        }
        .btn-danger {
            background: #dc3545;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        pre {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            font-size: 14px;
        }
        .alert {
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
        }
        .session-info {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>PHP Session Management</h1>";
        
if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-success'>" . htmlspecialchars($_SESSION['message']) . "</div>";
    unset($_SESSION['message']);
}

echo "<div class='demo'>
        <h3>Session Operations</h3>
        <div class='btn-group'>
            <a href='?action=set'><button>Set Session Data</button></a>
            <a href='?action=update'><button>Update Session Data</button></a>
            <a href='?action=destroy' onclick=\"return confirm('Destroy session?')\">
                <button class='btn-danger'>Destroy Session</button>
            </a>
        </div>
    </div>";

        
if (isset($_SESSION['user_data']) || isset($_SESSION['visit_count'])) {
    echo "<div class='session-info'>
                <h3>Current Session Data:</h3>
                <pre>";
    print_r($_SESSION);
    echo "</pre></div>";
} else {
    echo "<div class='session-info'>
                <p><strong>No session data set yet.</strong> Click \"Set Session Data\" to begin.</p>
            </div>";
}

echo "<div class='demo'>
            <h3>Session Information</h3>
            <pre>Session ID: " . session_id() . "
                 Session Name: " . session_name() . "
                 Cookie Lifetime: " . ini_get('session.cookie_lifetime') . " seconds <br>
                 Cookie Path: " . ini_get('session.cookie_path') . "
                 Cookie Domain: " . ini_get('session.cookie_domain') . "
                 Save Path: " . session_save_path() . "
                 Cookie Secure: " . (ini_get('session.cookie_secure') ? 'Yes' : 'No') . "
                 Cookie HttpOnly: " . (ini_get('session.cookie_httponly') ? 'Yes' : 'No') . "</pre>
        </div>
        
      <div class='demo'>
    <h3>Common Session Functions</h3>
    <pre>
<strong>session_start()</strong>      - Start a new session or resume existing one
<strong>&#36;_SESSION['key']</strong>      - Access session variables
<strong>unset(&#36;_SESSION['key'])</strong> - Remove a session variable
<strong>session_destroy()</strong>     - Destroy all session data
<strong>session_id()</strong>          - Get current session ID
<strong>session_regenerate_id()</strong> - Generate new session ID
    </pre>
</div>;

        
        <div class='demo'>
            <h3>Use Cases</h3>
            <ul>
                <li><strong>User Authentication:</strong> Store logged-in user data</li>
                <li><strong>Shopping Carts:</strong> Track items in cart</li>
                <li><strong>Form Data:</strong> Preserve form data between pages</li>
                <li><strong>Security:</strong> Implement CSRF tokens</li>
                <li><strong>Preferences:</strong> Remember user preferences</li>
            </ul>
        </div>
    </div>
</body>
</html>";
?>