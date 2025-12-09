<?php

$upload_dir = 'uploads';
if (!file_exists($upload_dir)) {
    @mkdir($upload_dir, 0777, true);
}

$message = '';
$uploaded_files = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['images'])) {
    foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
        if (!empty($tmp_name)) {
            $filename = basename($_FILES['images']['name'][$key]);
            $target_path = $upload_dir . '/' . time() . '_' . $filename;
            
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (in_array($ext, $allowed)) {
                if (@move_uploaded_file($tmp_name, $target_path)) {
                    $uploaded_files[] = $target_path;
                    $message .= "Image '$filename' uploaded successfully!<br>";
                } else {
                    $message .= "Failed to upload '$filename'.<br>";
                }
            } else {
                $message .= "File '$filename' is not a valid image!<br>";
            }
        }
    }
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Image Upload </title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        .container {
            max-width: 900px;
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
        .upload-form {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        input[type='file'] {
            margin: 15px 0;
        }
        button {
            background: #007bff;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #0056b3;
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .image-card {
            border: 2px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
            background: white;
        }
        .image-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .no-images {
            text-align: center;
            color: #666;
            padding: 30px;
            background: #f8f9fa;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Multiple Image Upload System</h1>";
        
if ($message) {
    echo "<div class='success'>$message</div>";
}

echo "<div class='upload-form'>
            <h2>Upload Multiple Images</h2>
            <form method='POST' enctype='multipart/form-data'>
                <label>Select Images:</label><br>
                <input type='file' name='images[]' multiple accept='image/*' required><br>
                <p style='color: #666; font-size: 14px;'>You can select multiple images at once</p>
                <button type='submit'>Upload Images</button>
            </form>
        </div>
        
        <h2>Uploaded Images</h2>
        <div class='gallery'>";

$images = @glob($upload_dir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);
if ($images && count($images) > 0) {
    foreach ($images as $image) {
        $filename = basename($image);
        echo "<div class='image-card'>
            <img src='$image' alt='$filename'>
            <p style='padding: 10px; margin: 0; word-break: break-all;'>$filename</p>
        </div>";
    }
} else {
    echo "<div class='no-images'><p>No images uploaded yet. Upload some images to get started!</p></div>";
}

echo "</div>
    </div>
</body>
</html>";
?>