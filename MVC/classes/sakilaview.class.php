<?php

class SakilaView extends SakilaModel
{

    public function showFilmsBySearchString($searchString)
    {
        $sqlQueryResultsArray = $this->getFilmsBySearchString($searchString);

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
}
