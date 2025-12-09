<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection
include 'db.php';

// Handle AJAX Request
if (isset($_POST['rating'])) {
    $rating = intval($_POST['rating']);
    $item_id = 1; // static item for demo

    $query = "INSERT INTO ratings (item_id, rating) VALUES ($item_id, $rating)";
    if ($conn->query($query)) {
        exit("Thanks for rating!");
    } else {
        exit("Database Error: " . $conn->error);
    }
}

// Get average rating and total ratings
$res = $conn->query("SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM ratings WHERE item_id=1");
$row = $res->fetch_assoc();
$avg = round($row['avg_rating'], 1);
$total = $row['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>⭐ 5-Star Rating System</title>
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }
    header {
      text-align: center;
      padding: 60px 20px 40px;
    }
    h1 {
      margin: 0;
      font-size: 36px;
      color: #222;
      letter-spacing: 1px;
    }
    p.subtitle {
      color: #555;
      font-size: 18px;
      margin-top: 10px;
    }
    ul {
      list-style-type: none;
      background-color: #333;
      margin: 0 auto;
      padding: 0;
      overflow: hidden;
      width: fit-content;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    li { float: left; }
    li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 24px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }
    li a:hover {
      background-color: #04AA6D;
    }

    /* --- Rating Styles --- */
    .stars {
      display: inline-flex;
      flex-direction: row-reverse;
      justify-content: center;
      gap: 5px;
      margin-top: 40px;
    }
    .stars input { display: none; }
    .stars label {
      font-size: 40px;
      color: #ccc;
      cursor: pointer;
      transition: 0.3s;
    }
    .stars label:hover,
    .stars label:hover ~ label {
      color: #ffb400;
    }
    .stars input:checked ~ label {
      color: #ffb400;
    }
    #message {
      margin-top: 20px;
      font-weight: bold;
      color: #0078d4;
    }
    .average-box {
      background: white;
      padding: 15px 30px;
      border-radius: 8px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      display: inline-block;
      margin-top: 25px;
    }

    footer {
      text-align: center;
      color: #666;
      font-size: 14px;
      margin-top: 50px;
    }
  </style>
</head>
<body>
  <header>
    <h1>⭐ 5-Star Rating System</h1>
    <p class="subtitle">With PHP + AJAX + MySQL</p>
  </header>

  <ul>
    <li><a href="home.php">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="Ratings.php">Rate Us</a></li>
  </ul>

  <!-- Rating Section -->
  <div class="stars">
    <input type="radio" name="star" id="star5" value="5"><label for="star5">&#9733;</label>
    <input type="radio" name="star" id="star4" value="4"><label for="star4">&#9733;</label>
    <input type="radio" name="star" id="star3" value="3"><label for="star3">&#9733;</label>
    <input type="radio" name="star" id="star2" value="2"><label for="star2">&#9733;</label>
    <input type="radio" name="star" id="star1" value="1"><label for="star1">&#9733;</label>
  </div>

  <div id="message"></div>

  <div class="average-box">
    <p><strong>Average Rating:</strong> <?php echo $avg ?: 0; ?> &#9733;</p>
    <p><small>Total Ratings: <?php echo $total; ?></small></p>
  </div>

  <footer>
    <p>Made by using pure HTML, CSS & PHP</p>
  </footer>

  <script>
    document.querySelectorAll('.stars input').forEach(input => {
      input.addEventListener('change', () => {
        const rating = input.value;
        fetch("Ratings.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "rating=" + rating
        })
        .then(res => res.text())
        .then(msg => {
          document.getElementById("message").innerText = msg;
          setTimeout(() => location.reload(), 1000);
        });
      });
    });
  </script>
</body>
</html>