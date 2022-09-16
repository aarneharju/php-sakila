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
    <section id="search-results">
        <?php

        if (!empty($_GET['searched-movie-name'])) {
            echo "<p>You searched for: " . $_GET['searched-movie-name'] . "</p>";
            // $likeContent = "%" . $_GET['searched-movie-name'] . "%";
            $sqlSelectContent = "release_year";
            $sqlFromContent = "film";
            $sqlLikeContent = "Academy Dinosaur";

            try {
                $preparedSqlQuery = $databaseConnection->prepare("SELECT release_year FROM film WHERE title=?");
                $preparedSqlQuery->execute([$sqlLikeContent]);
                $sqlQueryResultsArray = $preparedSqlQuery->fetchAll();
                echo '<p class="debug-info">' . $database . '</p>';
            } catch (PDOException $e) {
                echo $e;
            }

            if (!empty($sqlQueryResultsArray)) {
                echo "<ul>";
                foreach ($sqlQueryResultsArray as $resultRow) {
                    echo "<li>";
                    echo $resultRow['release_year'];
                    echo "</li>";
                }
                // echo "<\ul>";
            }
        }

        ?>
    </section>
</body>

</html>