<?php

if (!isset($_GET['movieSearch'])) {
  header('Location: index.php');
}

$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';

$movieName = $_GET['movieSearch'];

$pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);


$sql = "
  SELECT title, genre_name, rating_name,format_name
  FROM dvds
  INNER JOIN genres
  ON dvds.genre_id = genres.id
  INNER JOIN ratings
  ON dvds.rating_id = ratings.id
  INNER JOIN formats
  ON dvds.format_id=formats.id
  WHERE title LIKE ?
";

$statement = $pdo->prepare($sql);
$like = '%' . $movieName . '%';
$statement->bindParam(1, $like);
$statement->execute();
$count = $statement->rowCount();
$movies = $statement->fetchAll(PDO::FETCH_OBJ);





if ($count==0){
  echo "Sorry no records found.";
  echo "Please use the <a href='index.php'>search </a>page.";

}

?>



  <?php foreach($movies as $movie) : ?>
    <h3>
      <?php echo $movie->title ?>
    </h3>
      Genre:
      <?php echo $movie->genre_name ?></br>
      Format: <?php echo $movie->format_name?>

    <p>Rating: <a href="ratings.php?rating_name=<?php echo $movie->rating_name ?>"><?php echo $movie->rating_name ?></a></p>
  <?php endforeach; ?>
