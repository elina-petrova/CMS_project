<?php

require_once 'load.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $movie = getSingleMovie($id);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
</head>
<body>
<?php include 'templates/header.php';?>

<?php
// var_dump($getMovies);
// exit;
?>

<?php if (!empty($movie)):?>
 <div class="movie-item">
    <img src="images/<?php echo $movie['movies_cover']; ?>" alt="<?php echo $movie['movies_title']; ?> Cover Image">
    <h2><?php echo $movie['movies_title']; ?></h2>
    <h4>Movie Released: <?php echo $movie['movies_release']; ?></h4>
    <h4><?php echo $movie['movies_runtime']; ?></h4>
    <p><?php echo $movie['movies_storyline']; ?></p>
    </div>
<?php else:?>
<p>There is not such a movie</p>
<?php endif;?>


<?php include 'templates/footer.php';?>

</body>
</html>