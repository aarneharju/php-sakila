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
            $sqlSelectContent = "release_year";
            $sqlFromContent = "film";
            $sqlLikeContent = "%" . $_GET['searched-movie-name'] . "%";

            try {
                $preparedSqlQuery = $databaseConnection->prepare("SELECT title, description, rating, release_year FROM film WHERE title LIKE ?");
                $preparedSqlQuery->execute([$sqlLikeContent]);
                $sqlQueryResultsArray = $preparedSqlQuery->fetchAll();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

            if (!empty($sqlQueryResultsArray)) {
                echo "<table>";
                echo "<caption>Movie titles that contain " . $_GET['searched-movie-name'] . "</caption>";
                echo "<thead>
                    <td>Title</td>
                    <td>Description</td>
                    <td>Rating</td>
                    <td>Release Year</td>
                </thead>";
                echo "<tbody>";
                foreach ($sqlQueryResultsArray as $resultRow) {
                    echo "<tr>";
                    echo "<td>" . ucwords(strtolower($resultRow['title'])) . "<td>{$resultRow['description']}</td><td>{$resultRow['rating']}</td><td>{$resultRow['release_year']}</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
            } else {
                echo "Couldn't find any matches.";
            }
        }

        ?>
    </section>
</body>

</html>
<?php $databaseConnection = null; ?>