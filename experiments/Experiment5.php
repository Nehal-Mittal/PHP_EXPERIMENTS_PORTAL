<?php
$demo_dir = 'demo_uploads';
if (!file_exists($demo_dir)) {
    @mkdir($demo_dir, 0777, true);
}

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>File System Functions</title>
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
        }
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        .demo {
            background: white;
            padding: 25px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .demo h3 {
            margin-top: 0;
            color: #667eea;
            font-size: 1.5rem;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }
        pre {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 20px;
            border-radius: 8px;
            overflow-x: auto;
            font-size: 14px;
            line-height: 1.6;
        }
        .info-box {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>File System Functions</h1>";

$file_path = $demo_dir . '/test.txt';
@file_put_contents($file_path, "Hello, Nehal this side!!\nCourse : MCA\nExperiment : 5");

echo "<div class='demo'>
    <h3>Creating and Writing to Files</h3>
    <p>File created: <code>$file_path</code></p>
    <pre>Content:\n" . htmlspecialchars(@file_get_contents($file_path)) . "</pre>
</div>";

echo "<div class='demo'>
    <h3>File Information</h3>
    <pre>";
if (@file_exists($file_path)) {
    echo "File exists: Yes\n";
    echo "File size: " . @filesize($file_path) . " bytes\n";
    echo "Is file: " . (@is_file($file_path) ? 'Yes' : 'No') . "\n";
    echo "Is directory: " . (@is_dir($file_path) ? 'Yes' : 'No') . "\n";
    echo "Readable: " . (@is_readable($file_path) ? 'Yes' : 'No') . "\n";
    echo "Writable: " . (@is_writable($file_path) ? 'Yes' : 'No') . "\n";
    echo "Last modified: " . date('Y-m-d H:i:s', @filemtime($file_path)) . "\n";
}
echo "</pre></div>";

@file_put_contents($demo_dir . '/lines.txt', "A\nB\nC\nD\nE");
$lines = @file($demo_dir . '/lines.txt', FILE_IGNORE_NEW_LINES);

echo "<div class='demo'>
    <h3>Reading File Line by Line</h3>
    <pre>";
if ($lines) {
    foreach ($lines as $index => $line) {
        echo "Line " . ($index + 1) . ": $line\n";
    }
}
echo "</pre></div>";

echo "<div class='demo'>
    <h3>Directory Operations</h3>
    <pre>";
echo "Current directory: " . getcwd() . "\n";
echo "Demo directory: $demo_dir\n";
echo "Is directory: " . (@is_dir($demo_dir) ? 'Yes' : 'No') . "\n\n";
echo "Directory contents:\n";
$items = @scandir($demo_dir);
if ($items) {
    foreach ($items as $item) {
        if ($item !== '.' && $item !== '..') {
            $item_path = $demo_dir . '/' . $item;
            $type = @is_dir($item_path) ? '[DIR]' : '[FILE]';
            echo "  $type $item\n";
        }
    }
}
echo "</pre></div>";

echo "<div class='demo'>
    <h3>File Operations: Copy, Rename, Delete</h3>
    <pre>";
@copy($file_path, $demo_dir . '/test_copy.txt');
echo "File copied: test.txt → test_copy.txt\n";
@rename($demo_dir . '/test_copy.txt', $demo_dir . '/test_renamed.txt');
echo "File renamed: test_copy.txt → test_renamed.txt\n";
if (@file_exists($demo_dir . '/test_renamed.txt')) {
    @unlink($demo_dir . '/test_renamed.txt');
    echo "File deleted: test_renamed.txt\n";
}
echo "</pre></div>";

echo "<div class='info-box'>
    <h3>Common PHP File Functions:</h3>
    <ul>
        <li><strong>file_exists()</strong>: Check if file exists</li>
        <li><strong>is_file()</strong>: Check if path is file</li>
        <li><strong>is_dir()</strong>: Check if path is directory</li>
        <li><strong>file_get_contents()</strong>: Read entire file</li>
        <li><strong>file_put_contents()</strong>: Write to file</li>
        <li><strong>fopen/fread/fwrite</strong>: Advanced file handling</li>
        <li><strong>mkdir()</strong>: Create directory</li>
        <li><strong>rmdir()</strong>: Remove directory</li>
        <li><strong>scandir()</strong>: List directory contents</li>
        <li><strong>copy()</strong>: Copy file</li>
        <li><strong>rename()</strong>: Rename/move file</li>
        <li><strong>unlink()</strong>: Delete file</li>
    </ul>
</div>";
echo "</div></body></html>";
?>
