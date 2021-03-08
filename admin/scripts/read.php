<?php


function getAllMovies(){
    // get the instance of a class and then get a conn object
    $pdo = Database::getInstance()->getConnection();
    //write a query
    $queryAll = "SELECT * FROM tbl_movies";
    //execute a quary inside database
    $runAll = $pdo->query($queryAll);
    $movies = $runAll->fetchAll(PDO::FETCH_ASSOC);
    //check for errors
    if ($movies){
        return $movies;
    } else {
        return 'There was a problem accessing this info';
    }
}

function getSingleMovie($id)
{
    $pdo = Database::getInstance()->getConnection();
    // TODO: finish the line with a properSQL query fetch 1 movie for given id
    $querySingle = 'SELECT * FROM tbl_movies WHERE movies_id='. $id;
    $runSingle = $pdo->query($querySingle);
    $movie = $runSingle->fetch(PDO::FETCH_ASSOC);

    if($movie){
        return $movie;
    }else{
        return 'There was a problem to fetch single movie for'.$id;
}
}

function getMoviesByGenre($genre){
     $movie_table = 'tbl_movies';
     $genre_table = 'tbl_genre';
     $movie_genre_linking_table = 'tbl_mov_genre';

     $pdo = Database::getInstance()->getConnection();
    // TODO: finish the following SQL query that fetchall movies that belongs to same genre
    $query = 'SELECT m.*, GROUP_CONCAT(g.genre_name) as genre_name FROM ' . $movie_table . ' m';
    $query .= ' LEFT JOIN ' . $movie_genre_linking_table . ' link ON link.movies_id = m.movies_id';
    $query .= ' LEFT JOIN ' . $genre_table . ' g ON link.genre_id = g.genre_id ';
    $query .= ' GROUP BY m.movies_id';
    $query .= ' HAVING genre_name LIKE "%'.$genre.'%"';

   
    $runQuery = $pdo->query($query);

    if($runQuery){
        $movies = $runQuery->fetchAll(PDO::FETCH_ASSOC);
         //var_dump($movies);
         //exit;
        return $movies;
    } else {
        return 'There was a problem to fetch movie by genre'.$genre;
    }

}
