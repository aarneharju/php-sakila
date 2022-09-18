<?php

class SakilaModel extends DatabaseConnection
{
    protected function getFilmsBySearchString($searchString)
    {
        try {
            $preparedSqlQuery = $this->connect()->prepare("SELECT title, description, rating, release_year FROM film WHERE title LIKE ?");
            $preparedSqlQuery->execute([$searchString]);
            return $sqlQueryResultsArray = $preparedSqlQuery->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
