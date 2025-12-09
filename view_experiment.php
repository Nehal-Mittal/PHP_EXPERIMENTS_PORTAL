<?php
require_once 'config.php';
requireLogin();

$conn = getDBConnection();

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit();
}

$exp_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM experiments WHERE id = ?");
$stmt->bind_param("i", $exp_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $conn->close();
    header('Location: dashboard.php');
    exit();
}

$experiment = $result->fetch_assoc();
$conn->close();

// Load code from file if exists
$exp_file = "experiments/Experiment{$experiment['experiment_no']}.php";
$code = file_exists($exp_file) ? file_get_contents($exp_file) : ($experiment['code'] ?? '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Experiment - Student Experiment Portal</title>

    <!-- Bootstrap + Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- CodeMirror CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/theme/monokai.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            padding-top: 70px; /* Prevent navbar overlap */
        }
        .card {
            border-radius: 10px;
        }
        .CodeMirror {
            height: 70vh;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }
        iframe {
            border: none;
            border-radius: 0 0 10px 10px;
            background-color: #fff;
        }
        .output-container {
            height: 100%;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="dashboard.php">Student Experiment Portal</a>
            <div class="d-flex ms-auto">
                <a class="btn btn-outline-light btn-sm me-2" href="dashboard.php">Back to Dashboard</a>
                <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <h3 class="fw-semibold text-primary mb-0">
                        <?= htmlspecialchars($experiment['experiment_name']) ?>
                    </h3>
                    <p class="text-muted mb-0">Experiment #<?= htmlspecialchars($experiment['experiment_no']) ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Code Editor -->
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                        <span><strong>Code Editor</strong></span>
                        <button onclick="runCode()" class="btn btn-success btn-sm">▶ Run Code</button>
                    </div>
                    <div class="card-body p-0">
                        <textarea id="codeEditor"><?= htmlspecialchars($code) ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Output -->
            <div class="col-md-6 mb-3">
                <div class="card shadow-sm h-100 output-container">
                    <div class="card-header bg-secondary text-white">
                        <strong>Output</strong>
                    </div>
                    <div class="card-body p-0">
                        <iframe id="outputFrame" style="width:100%; height:70vh;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/xml/xml.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/php/php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/css/css.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/javascript/javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.2/mode/htmlmixed/htmlmixed.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Initialize CodeMirror
    const editor = CodeMirror.fromTextArea(document.getElementById('codeEditor'), {
        lineNumbers: true,
        theme: 'monokai',
        mode: 'application/x-httpd-php',
        indentUnit: 4,
        indentWithTabs: true,
        lineWrapping: true
    });

    // Run code inside iframe without opening a new page
    function runCode() {
        const code = editor.getValue();
        const outputFrame = document.getElementById('outputFrame');
        const iframeDoc = outputFrame.contentDocument || outputFrame.contentWindow.document;

        // Send the code to execute_code.php using fetch()
        fetch('execute_code.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'code=' + encodeURIComponent(code)
        })
        .then(response => response.text())
        .then(data => {
            // Display the returned HTML output directly inside iframe
            iframeDoc.open();
            iframeDoc.write(data);
            iframeDoc.close();
        })
        .catch(error => {
            iframeDoc.open();
            iframeDoc.write(`<div style="color:red; padding:10px;">Error: ${error}</div>`);
            iframeDoc.close();
        });
    }
</script>

</body>
</html>
