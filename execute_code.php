
<?php
require_once 'config.php';
requireLogin();

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

$code = $_POST['code'] ?? '';

// Security: Clean output buffer
ob_start();

// Execute the code in a safe manner
// Note: eval() is dangerous but required for this use case
// In production, consider using safer sandbox environments

try {
    // Strip the opening <?php tag if it exists, then evaluate
    $code = preg_replace('/^<\?php\s*/', '', $code);
    $code = preg_replace('/\?>\s*$/', '', $code);
    
    // Use output buffering to capture result
    eval($code);
    $output = ob_get_clean();
    
    echo $output;
} catch (Throwable $e) {
    ob_end_clean();
    echo '<div class="alert alert-danger m-3">';
    echo '<strong>Error:</strong> ' . htmlspecialchars($e->getMessage());
    echo '<br><strong>Line:</strong> ' . htmlspecialchars($e->getLine());
    echo '</div>';
}
?>

 