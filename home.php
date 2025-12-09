<!DOCTYPE html>
<html>
<head>
    <title>PHP Lab - Program List</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f4f6f8;
            padding: 40px;
            margin: 0;
        }
        h1 {
            color: #222;
            text-align: center;
            margin-bottom: 20px;
        }
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 70%;
            margin: 0 auto 25px auto;
        }
        input[type="text"] {
            padding: 8px 12px;
            width: 60%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 8px 14px;
            background: #0078d4;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #005fa3;
        }
        table {
            background: white;
            border-collapse: collapse;
            width: 70%;
            margin: 0 auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        th {
            background: #0078d4;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 18px;
        }
        td {
            border-bottom: 1px solid #eee;
            padding: 12px 15px;
            font-size: 16px;
        }
        tr:hover {
            background-color: #f1f8ff;
        }
        a {
            text-decoration: none;
            color: #0078d4;
            font-weight: 500;
        }
        a:hover {
            text-decoration: underline;
        }
        .actions a {
            margin-right: 12px;
        }
        footer {
            text-align: center;
            color: #666;
            margin-top: 40px;
            font-size: 14px;
        }
        form#createForm {
            display: none;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>💻 PHP Lab - Program List</h1>

<div class="top-bar">
    <input type="text" id="search" placeholder="🔍 Search program...">
    <button onclick="toggleCreate()">+ New Program</button>
</div>

<form id="createForm" method="post" action="">
    <input type="text" name="newfile" placeholder="Enter new program name (e.g. test.php)" required>
    <button type="submit" name="create">Create</button>
</form>

<table id="programTable">
    <tr>
        <th>Program Name</th>
        <th>Action</th>
    </tr>

    <?php
    $files = glob("programs/*.php");

    if (isset($_POST['create'])) {
        $newfile = basename($_POST['newfile']);
        if (!str_ends_with($newfile, '.php')) $newfile .= '.php';
        $filepath = "programs/" . $newfile;

        if (file_exists($filepath)) {
            echo "<script>alert('File already exists!');</script>";
        } else {
            file_put_contents($filepath, "<?php\n// New PHP Program\n?>");
            header("Location: home.php");
            exit;
        }
    }

    if (empty($files)) {
        echo "<tr><td colspan='2' style='text-align:center;'>No programs found.</td></tr>";
    } else {
        foreach ($files as $file) {
            $filename = basename($file);
            $displayName = ucwords(str_replace(".php", "", $filename));
            echo "
            <tr>
                <td>$displayName</td>
                <td class='actions'>
                    <a href='index.php?file=$filename'>Open in Editor</a>

                </td>
            </tr>";
        }
    }
    ?>
</table>

<footer>PHP Practicals</footer>

<script>
function toggleCreate() {
    const form = document.getElementById("createForm");
    form.style.display = form.style.display === "none" ? "block" : "none";
}

document.getElementById('search').addEventListener('input', function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll('#programTable tr:not(:first-child)');
    rows.forEach(row => {
        let program = row.cells[0].innerText.toLowerCase();
        row.style.display = program.includes(filter) ? '' : 'none';
    });
});
</script>

</body>
</html>
