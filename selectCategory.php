<?php include 'databaseConnection.php' ?>

<?php

function arrayFromUnpreparedSqlQuery($sqlQuery, $dbConnection)
{
    try {
        $query = $dbConnection->query($sqlQuery);
        return $query->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function arrayFromPreparedSqlQuery($sqlQuery, $variableArray, $dbConnection)
{
    try {
        $preparedSqlQuery = $dbConnection->prepare($sqlQuery);
        $preparedSqlQuery->execute($variableArray);
        return $preparedSqlQuery->fetchAll();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>

<body>
    <form action="selectCategory.php" method="get">
        <fieldset>
            <legend>Select category:</legend>
            <!-- <label for="selected-category">Select:</label> -->
            <select name="selected-category" id="selected-category">

                <?php

                $sqlSelectQuery = "SELECT name FROM category";

                // echo var_export($sqlSelectQuery);

                $categoriesArray = arrayFromUnpreparedSqlQuery($sqlSelectQuery, $databaseConnection);

                // echo var_export($categoriesArray);

                foreach ($categoriesArray as $category) {
                    echo '<option value="' . $category['name'] . '">' . $category['name'] . "</option>";
                }

                ?>

            </select>
            <input type="submit" value="Select">
        </fieldset>
    </form>
    <section id="search-results">
        <?php

        if (!empty($_GET['selected-category'])) {

            $preparedSqlSelectQuery = "SELECT film.title, category.name AS category FROM film LEFT JOIN film_category ON film.film_id = film_category.film_id LEFT JOIN category ON film_category.category_id = category.category_id WHERE category.name = ?";

            echo "<h2>Here's the list of " . strtolower($_GET['selected-category']) . " movies:</h2>";

            $arrayOfFilmsOfSelectedCategory = arrayFromPreparedSqlQuery($preparedSqlSelectQuery, [$_GET['selected-category']], $databaseConnection);

            echo "<ul>";
            foreach ($arrayOfFilmsOfSelectedCategory as $filmTitle) {
                echo "<li>";
                echo ucwords(strtolower($filmTitle['title']));
                echo "</li>";
            }
            echo "</ul>";
        }
        ?>
    </section>
</body>

</html>
<?php $databaseConnection = null; ?>