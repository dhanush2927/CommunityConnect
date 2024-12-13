<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Posts - Marketplace</title>
    <link rel="stylesheet" href="style.css"/>
    <style>
        body {
            background-color: #f0f8ff; /* Light blue background */
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            text-align: center;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #FF6347;
            color: white;
        }
        td {
            background-color: #f9f9f9;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            font-size: 16px;
            color: #1e90ff;
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
    
    <h1 style="font-size:45px;text-align:center;color:#FF0000">View Posts</h1>
    
    <?php
        require('db.php');
        include('authentication.php');

        // Fetch all posts from the database
        $query = "SELECT * FROM posts"; // Sort posts by most recent
        $result = mysqli_query($con, $query);

        // Check if there are posts
        if (mysqli_num_rows($result) > 0) {
            // Display posts in a table
            echo "<table>";
            echo "<tr><th>Username</th><th>Post</th><th>Phone Number</th></tr>";

            // Loop through the posts and display them
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                echo "<td>" . nl2br(htmlspecialchars($row['post'])) . "</td>";
                echo "<td>" . htmlspecialchars($row['phnum']) . "</td>";

                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No posts found.</p>";
        }
    ?>

    <div class="back-link">
        <p><a href="home.php">Back to Home</a></p>
    </div>
</div>

</body>
</html>
