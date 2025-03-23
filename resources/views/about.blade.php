<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('css/about.css') }}"> <!-- Link to external CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #007BFF;
        }
        p {
            color: #555;
            line-height: 1.6;
        }
        .highlight {
            color: #007BFF;
            font-weight: bold;
        }
        .services {
            margin-top: 20px;
        }
        .services ul {
            list-style-type: none;
            padding: 0;
        }
        .services li {
            background: #e9f5ff;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .cta {
            margin-top: 30px;
        }
        .cta a {
            display: inline-block;
            background: #007BFF;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: 0.3s;
        }
        .cta a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>About Us</h1>
        <p>Welcome to <span class="highlight">Cazelle Event Reservation</span>, your trusted partner in event reservations and management. We specialize in crafting unforgettable experiences tailored to your needs.</p>

        <h2>Our Mission</h2>
        <p>We aim to simplify event planning by providing a seamless and efficient platform for booking event packages, catering services, and more.</p>

        <h2>What We Offer</h2>
        <div class="services">
            <ul>
                <li>🎉 Event Packages (Weddings, Birthdays, Corporate Events, and More)</li>
                <li>🍽️ Customized Meal Packages for Your Special Occasions</li>
                <li>💳 Easy Online Payment and Reservation System</li>
                <li>📅 Hassle-Free Date Selection for Your Events</li>
            </ul>
        </div>

        <div class="cta">
            <a href="/">Explore Our Packages</a>
        </div>
    </div>
</body>
</html>
