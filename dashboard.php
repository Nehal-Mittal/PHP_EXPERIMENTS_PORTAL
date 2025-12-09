<?php
require_once 'config.php';
requireLogin();

// Fetch experiments
$conn = getDBConnection();
$result = $conn->query("SELECT * FROM experiments ORDER BY experiment_no ASC");
$experiments = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Student Experiment Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">
                <strong>Student Experiment Portal</strong>
            </a>
            <div class="navbar-nav ms-auto align-items-center">
                <span class="navbar-text me-3">Welcome, <?= htmlspecialchars($_SESSION['student_name']) ?></span>
                <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="main-content">
        <div class="container mt-5 pt-4">
            <h2 class="mb-4">List of Experiments</h2>
            
            <!-- Experiments Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Experiment No</th>
                                    <th>Experiment Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="experiments-table">
                                <?php foreach ($experiments as $exp): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($exp['experiment_no']) ?></td>
                                        <td><?= htmlspecialchars($exp['experiment_name']) ?></td>
                                        <td>
    <!-- Run Button -->

       <a href="experiments/Experiment<?= $exp['experiment_no'] ?>.php" 
   target="_blank" 
   class="btn btn-success btn-sm me-1">Run</a>


    <!-- View Button -->
    <a href="view_experiment.php?id=<?= $exp['id'] ?>" 
       class="btn btn-primary btn-sm me-1">View</a>

    <!-- Delete Button -->
    <button onclick="deleteExperiment(<?= $exp['id'] ?>, <?= $exp['experiment_no'] ?>)" 
            class="btn btn-danger btn-sm">Delete</button>
</td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Add Experiment Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Add New Experiment</h5>
                </div>
                <div class="card-body">
                    <form id="addExperimentForm">
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="experiment_no" class="form-label">Experiment No</label>
                                <input type="number" class="form-control" id="experiment_no" required>
                            </div>
                            <div class="col-md-9 mb-3">
                                <label for="experiment_name" class="form-label">Experiment Name</label>
                                <input type="text" class="form-control" id="experiment_name" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="experiment_code" class="form-label">Code</label>
                            <textarea class="form-control" id="experiment_code" rows="10" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Add Experiment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
</body>
</html>

