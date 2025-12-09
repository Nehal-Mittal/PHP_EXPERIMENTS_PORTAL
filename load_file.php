<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if file is passed in URL
if (isset($_GET['file'])) {
    // Extract only filename (prevent directory traversal)
    $file = basename($_GET['file']);

    // Always look inside the /programs folder
    $path = __DIR__ . "/programs/" . $file;

    // Check if file exists inside programs/
    if (file_exists($path)) {
        echo file_get_contents($path);
    } else {
        echo "// ❌ File not found inside programs/: $file";
    }
} else {
    echo "// ⚠️ No file specified!";
}
?>
