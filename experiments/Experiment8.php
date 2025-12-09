<?php

require_once __DIR__ . '/../config.php';
requireLogin();  // make sure this is defined in config.php

try {
    $conn = getDBConnection();
} catch (Exception $e) {
    $conn = new mysqli('localhost', 'root', 'Mish@0408', 'student_experiments');
    if ($conn->connect_error) {
        die('Database connection failed: ' . $conn->connect_error);
    }
}

$conn->query("CREATE TABLE IF NOT EXISTS demo_students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    grade VARCHAR(10) NOT NULL
)");

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'create') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $grade = trim($_POST['grade']);
        $stmt = $conn->prepare("INSERT INTO demo_students (name, email, grade) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $grade);
        if ($stmt->execute()) {
            $message = "Student '$name' created successfully!";
        } else {
            $message = "Error creating student.";
        }
    } elseif ($_POST['action'] === 'delete') {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("DELETE FROM demo_students WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = "Student deleted successfully!";
        }
    }
}

$result = $conn->query("SELECT * FROM demo_students ORDER BY id DESC");
$students = $result->fetch_all(MYSQLI_ASSOC);

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>CRUD Operations</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        .form-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        input[type='text'] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button, .btn-submit {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>CRUD Operations - Students Management</h1>";

if ($message) {
    echo "<div class='success'>" . htmlspecialchars($message) . "</div>";
}

echo "<h2>Students List (READ)</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>";

foreach ($students as $student) {
    echo "<tr>
                <td>{$student['id']}</td>
                <td>{$student['name']}</td>
                <td>{$student['email']}</td>
                <td>{$student['grade']}</td>
                <td>
                    <form method='POST' style='display:inline;'>
                        <input type='hidden' name='action' value='delete'>
                        <input type='hidden' name='id' value='{$student['id']}'>
                        <button type='submit' class='btn btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                    </form>
                </td>
            </tr>";
}

echo "</tbody>
        </table>

        <div class='form-container'>
            <h2>Add New Student (CREATE)</h2>
            <form method='POST'>
                <input type='hidden' name='action' value='create'>
                <input type='text' name='name' placeholder='Student Name' required>
                <input type='text' name='email' placeholder='Email Address' required>
                <input type='text' name='grade' placeholder='Grade (A, B, C, D, F)' required>
                <button type='submit' class='btn-submit'>Add Student</button>
            </form>
        </div>

        <div style='margin-top: 30px; padding: 20px; background: #e3f2fd; border-radius: 8px;'>
            <h3>CRUD Operations Explained:</h3>
            <ul>
                <li><strong>CREATE:</strong> INSERT INTO table (columns) VALUES (values)</li>
                <li><strong>READ:</strong> SELECT * FROM table WHERE conditions</li>
                <li><strong>UPDATE:</strong> UPDATE table SET column='value' WHERE id=X</li>
                <li><strong>DELETE:</strong> DELETE FROM table WHERE id=X</li>
            </ul>
        </div>
    </div>
</body>
</html>";

$conn->close();
?>

