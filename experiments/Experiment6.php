<?php

// require_once __DIR__ . '/../config.php';
// requireLogin();  // make sure this is defined in config.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function generateCaptcha() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $captcha = '';
    for ($i = 0; $i < 6; $i++) {
        $captcha .= $characters[rand(0, strlen($characters) - 1)];
    }
    $_SESSION['captcha'] = $captcha;
    return $captcha;
}

function createCaptchaImage($text) {
    $width = 150;
    $height = 50;
    $image = @imagecreatetruecolor($width, $height);
    if (!$image) return false;
    
    $bg_color = @imagecolorallocate($image, 240, 240, 240);
    $text_color = @imagecolorallocate($image, 0, 100, 200);
    $line_color = @imagecolorallocate($image, 200, 200, 200);
    
    @imagefilledrectangle($image, 0, 0, $width, $height, $bg_color);
    
    for ($i = 0; $i < 5; $i++) {
        @imageline($image, rand(0, $width), rand(0, $height), rand(0, $width), rand(0, $height), $line_color);
    }
    
    @imagestring($image, 5, 30, 15, $text, $text_color);
    
    return $image;
}

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_captcha = strtoupper(trim($_POST['captcha'] ?? ''));
    $session_captcha = strtoupper($_SESSION['captcha'] ?? '');
    
    if ($user_captcha === $session_captcha) {
        $message = "CAPTCHA verified successfully! Form submitted.";
        $message_type = 'success';
        unset($_SESSION['captcha']);
    } else {
        $message = "Invalid CAPTCHA. Please try again.";
        $message_type = 'error';
        generateCaptcha();
    }
}

if (!isset($_SESSION['captcha'])) {
    generateCaptcha();
}

$captcha_code = $_SESSION['captcha'];
$image = createCaptchaImage($captcha_code);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>CAPTCHA Contact Form</title>
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
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
        }
        textarea { resize: vertical; }
        .captcha-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }
        .captcha-image {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
        }
        .refresh-btn {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
        }
        button[type='submit'] {
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
        .message.error {
            background: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class='form-container'>
        <h1>CAPTCHA Contact Form</h1>";
        
if ($message) {
    echo "<div class='message $message_type'>" . htmlspecialchars($message) . "</div>";
}

echo "<form method='POST'>
            <div class='form-group'>
                <label for='name'>Name</label>
                <input type='text' id='name' name='name' required>
            </div>
            
            <div class='form-group'>
                <label for='email'>Email</label>
                <input type='email' id='email' name='email' required>
            </div>
            
            <div class='form-group'>
                <label for='message'>Message</label>
                <textarea id='message' name='message' rows='4' required></textarea>
            </div>
            
            <div class='form-group'>
                <label>Enter CAPTCHA</label>
                <div class='captcha-container'>";
                
if ($image) {
    ob_start();
    @imagepng($image);
    $image_data = ob_get_contents();
    ob_end_clean();
    @imagedestroy($image);
    $base64 = base64_encode($image_data);
    echo "<img src='data:image/png;base64,$base64' alt='CAPTCHA' class='captcha-image'>";
}

echo "<a href='' class='refresh-btn'>⟳ Refresh</a>
                </div>
                <input type='text' name='captcha' required placeholder='Enter code above' style='text-transform: uppercase;'>
            </div>
            
            <button type='submit'>Submit</button>
        </form>
    </div>
</body>
</html>";
?>