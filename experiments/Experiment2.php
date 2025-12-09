<?php
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>5 Star Rating System</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .rating-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 500px;
            width: 100%;
        }
        h1 {
            color: #333;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .stars {
            text-align: center;
            margin: 30px 0;
            font-size: 0;
        }
        .star {
            font-size: 50px;
            color: #ddd;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
            margin: 0 5px;
        }
        .star:hover,
        .star.active {
            color: #ffc107;
            transform: scale(1.2);
        }
        .rating-result {
            margin-top: 20px;
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }
        .rating-info {
            color: #666;
            margin-top: 10px;
            font-size: 16px;
        }
        .description {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 2px solid #f0f0f0;
            color: #555;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class='rating-container'>
        <h1>5-Star Rating System</h1>
        <p class='subtitle'>Click the stars to rate this product</p>
        <div class='stars' id='starContainer'>
            <span class='star' data-rating='1'>#9733</span>
            <span class='star' data-rating='2'>#9733</span>
            <span class='star' data-rating='3'>#9733</span>
            <span class='star' data-rating='4'>#9733</span>
            <span class='star' data-rating='5'>#9733</span>
        </div>
        <div class='rating-result' id='ratingResult'></div>
        <div class='rating-info' id='ratingInfo'></div>
        
        <div class='description'>
            <h3>How it Works:</h3>
            <ul>
                <li>JavaScript event listeners handle clicks and hover</li>
                <li>Active state changes star color and scale</li>
                <li>Rating data can be sent to server via AJAX</li>
                <li>Real-time visual feedback for better UX</li>
            </ul>
        </div>
    </div>
    
    <script>
        const stars = document.querySelectorAll('.star');
        const ratingResult = document.getElementById('ratingResult');
        const ratingInfo = document.getElementById('ratingInfo');
        const ratings = {
            1: 'Poor',
            2: 'Fair',
            3: 'Good',
            4: 'Very Good',
            5: 'Excellent'
        };
        
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.dataset.rating;
                ratingResult.textContent = 'You rated: ' + rating + '/5';
                ratingInfo.textContent = ratings[rating];
                
                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.add('active');
                        s.textContent = '★';
                    } else {
                        s.classList.remove('active');
                        s.textContent = '☆';
                    }
                });
                
                console.log('Rating saved to database: ' + rating);
            });
            
            star.addEventListener('mouseover', function() {
                const rating = this.dataset.rating;
                stars.forEach((s, index) => {
                    s.textContent = index < rating ? '★' : '☆';
                });
            });
        });
        
        document.getElementById('starContainer').addEventListener('mouseleave', function() {
            stars.forEach(s => {
                if (!s.classList.contains('active')) {
                    s.textContent = '☆';
                }
            });
        });
    </script>
</body>
</html>";
?>