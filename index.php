<?php
$weather = "";
$error = "";

if (array_key_exists('city', $_GET)) {
    $city = filter_var(str_replace(' ', '', $_GET["city"]), FILTER_SANITIZE_STRING);
    
    // Replace "YOUR_API_KEY" with your actual OpenWeatherMap API key
    $apiKey = "YOUR_API_KEY";
    $apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey";

    $response = file_get_contents($apiUrl);

    $data = json_decode($response, true);

    if ($data['cod'] == 200) {
        $weather = "Weather in " . $city . ": " . $data['weather'][0]['description'];
        $temperature = round($data['main']['temp'] - 273.15, 2); // Convert temperature to Celsius
        $weather .= "<br>Temperature: " . $temperature . "°C";
    } else {
        $error = "The city could not be found";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Weather Website</title>
    <style type="text/css">
        html {
            background: url(".//background.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body {
            background: none;
        }

        .container {
            text-align: center;
            margin-top: 200px;
            width: 450px;
        }

        input {
            margin: 20px 0px;
        }

        #weather {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>What's the Weather</h1>
    <form>
        <div class="form-group">
            <label for="city">Enter the name of a city</label>
            <input type="text" class="form-control" name="city" id="city" placeholder="Eg.London, Tokyo"
                   value="<?php if (array_key_exists('city', $_GET)) {
                       echo $_GET["city"];
                   } ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div id="weather"><?php
        if ($weather != "") {
            echo '<div class="alert alert-success" role="alert">' . $weather . '</div>';
        } else if ($error != "") {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
        ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
