<!DOCTYPE html>
<html>
<head>
  <title>Simple Menu</title>
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
    li {
      float: left;
    }
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
    <h1>My Navigation Menu</h1>
    <p class="subtitle">A menu design using HTML & CSS</p>
  </header>

  <ul>
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Contact</a></li>
    <li><a href="?file=programs/Ratings.php">Rate Us</a></li>

  </ul>

  <footer>
    <p>Made by using pure HTML & CSS</p>
  </footer>

</body>
</html>
