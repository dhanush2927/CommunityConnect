<!doctype html>
<html>
<head>
    <title>Marketplace</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
            font-family: Arial, sans-serif;
        }
        
    </style>
</head>
<body>
<div class="container">
    <nav>
        <ul>
            <li><a href="home.php">Home</a>&nbsp;&nbsp;</li>
            <li><a href="logout.php">Logout</a>&nbsp;&nbsp;</li>
        </ul>
    </nav>
</div>
<div>
<h1 style="font-size:45px;text-align:center;color:#FF0000">Community Connect</h1>

    <form class="form" method="post" name="search">
        <h2 style="text-align:center;">Marketplace</h2> <!-- Added Restaurants heading -->
        <input type="text" class="login-input" name="city" placeholder="City" autofocus="true"/>
        <input type="submit" value="Search" name="search" class="login-button"/>
    </form>
</div>

<div class="report-container">
<?php
include('authentication.php');
if(isset($_POST['city'])){
    require_once('vendor/autoload.php');
    $apiKey = "fsq3vejfe3MLgRX7xMDwSm53oty78Q5ICCwQSH30vAWrqic=";

    $city = stripslashes($_REQUEST['city']);
    $client = new \GuzzleHttp\Client();
    $restaurantApiUrl = "https://api.foursquare.com/v3/places/search?&categories=17069&near=".$city."&limit=10&v=20190425";
    $response = $client->request('GET', $restaurantApiUrl, [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => $apiKey,
        ],
    ]);

    $res = $response->getBody();
    $data = json_decode($res);
    
    echo "<table border='1' style='margin: auto;'> 
    <tr>
    <th>Marketplace Name</th>
    <th>Address</th>
    <th>Add To Favourites</th>
    </tr>";

    for($i = 0; $i < count($data->results); $i++){
        echo "<tr>";
        echo "<td>".$data->results[$i]->name."</td>";
        echo "<td>".$data->results[$i]->location->formatted_address."</td>";
        echo "<td><a href='add_fav.php?name=".urlencode($data->results[$i]->name)."'>Add To Favourites</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} 
?>
</div>
</body>
</html>
