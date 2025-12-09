<?php
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Sort Associative Arrays</title>
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
        }
        h1 {
            text-align: center;
            color: white;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }
        .array-box {
            background: white;
            padding: 25px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .array-box h3 {
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
        <h1>Sort Associative Arrays in PHP</h1>";
        
$students = [
    'John' => 85,
    'Alice' => 92,
    'Bob' => 78,
    'Charlie' => 95,
    'Diana' => 88,
    'Edward' => 82
];

echo "<div class='array-box'>
    <h3>Original Array (Student Grades)</h3>
    <pre>";
print_r($students);
echo "</pre></div>";

$students_asc = $students;
asort($students_asc);

echo "<div class='array-box'>
    <h3>⬆Sorted by Value (Ascending - asort)</h3>
    <pre>";
print_r($students_asc);
echo "</pre></div>";

$students_desc = $students;
arsort($students_desc);

echo "<div class='array-box'>
    <h3>⬇Sorted by Value (Descending - arsort)</h3>
    <pre>";
print_r($students_desc);
echo "</pre></div>";

$students_key = $students;
ksort($students_key);

echo "<div class='array-box'>
    <h3>Sorted by Key Alphabetically (ksort)</h3>
    <pre>";
print_r($students_key);
echo "</pre></div>";

echo "<div class='info-box'>
    <h3>PHP Array Sorting Functions:</h3>
    <ul>
        <li><strong>asort()</strong>: Sort by value (ascending), preserve keys</li>
        <li><strong>arsort()</strong>: Sort by value (descending), preserve keys</li>
        <li><strong>ksort()</strong>: Sort by key (ascending)</li>
        <li><strong>krsort()</strong>: Sort by key (descending)</li>
        <li><strong>sort()</strong>: Sort by value, reindex keys</li>
        <li><strong>rsort()</strong>: Sort by value (desc), reindex keys</li>
    </ul>
</div>";
echo "</div></body></html>";
?>