<?php
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Navigation Menu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        nav {
            background-color: #2c3e50;
            padding: 1rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }
        .logo {
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
            text-decoration: none;
            transition: color 0.3s;
        }
        .logo:hover { color: #3498db; }
        .nav-links {
            display: flex;
            list-style: none;
            gap: 2rem;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .nav-links a:hover {
            background-color: #34495e;
            transform: translateY(-2px);
        }
        .content {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        h1 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 2.5rem;
        }
        p {
            color: #555;
            line-height: 1.8;
            font-size: 1.1rem;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .feature-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }
        .feature-box h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <nav>
        <div class='nav-container'>
            <a href='#' class='logo'>MyWebsite</a>
            <ul class='nav-links'>
                <li><a href='#home'>Home</a></li>
                <li><a href='#about'>About</a></li>
                <li><a href='#services'>Services</a></li>
                <li><a href='#portfolio'>Portfolio</a></li>
                <li><a href='#contact'>Contact</a></li>
            </ul>
        </div>
    </nav>
    
    <div class='content'>
        <h1>Welcome to Our Navigation Menu Example</h1>
        <p>This is a fully responsive navigation menu created using HTML and CSS. It demonstrates modern web design principles including:</p>
        
        <div class='features'>
            <div class='feature-box'>
                <h3>Modern Design</h3>
                <p>Clean, professional look with smooth hover effects</p>
            </div>
            <div class='feature-box'>
                <h3>Responsive Layout</h3>
                <p>Flexbox-based layout adapts to all screen sizes</p>
            </div>
            <div class='feature-box'>
                <h3>Smooth Transitions</h3>
                <p>CSS animations for better user experience</p>
            </div>
            <div class='feature-box'>
                <h3>Interactive Elements</h3>
                <p>Hover effects and visual feedback on clicks</p>
            </div>
        </div>
    </div>
</body>
</html>";
?>