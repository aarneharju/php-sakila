<?php
include 'databaseConnection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Movie search form</title>
</head>

<body>
    <form action="search.php" method="get">
        <fieldset>
            <legend>Search for a movie:</legend>
            <label for="searched-movie-name">Movie name:</label>
            <input type="text" name="searched-movie-name" id="searched-movie-name">
            <input type="submit" value="Search">
        </fieldset>
    </form>
</body>

</html>