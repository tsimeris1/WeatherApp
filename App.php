<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Weather Information</h2>
        <div class="search-container">
           <form class="search" action="app.php" method="GET">

            <input type="text" class="search-input"  name="city" placeholder="Search the city..">
              <button type="submit" class="search-btn">Get the weather</button>
</form>
</div>

        <div class="weather-info">
            <?php
            error_reporting(0);
            $apiKey = "510eb7be47904818b8a174646202809";
            if (isset($_GET['city'])){
                $city = $_GET['city']; 
                $apiUrl = "https://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city";
                
                $weatherData = json_decode(file_get_contents($apiUrl), true);

                if ($weatherData && isset($weatherData['location'])) {
                    $location = $weatherData['location'];
                    $current = $weatherData['current'];
                    

                    echo "<p><strong>Name:</strong> {$location['name']}</p>";
                    echo "<p><strong>Region:</strong> {$location['region']}</p>";
                    echo "<p><strong>Country:</strong> {$location['country']}</p>";
                    echo "<p><strong>Temperature:</strong> {$current['temp_c']}°C</p>";
                    echo "<p><strong>Weather Condition:</strong> {$current['condition']['text']}</p>";
                    
                    $timezone = $location['tz_id']; 
                    date_default_timezone_set($timezone);
                    echo "<p><strong>Local Time:</strong> " . date('d-m-Y H:i:s') . "</p>";
                    
                } else {
                    echo "<p>Failed to find weather information. Please try again.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
