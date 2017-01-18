<?php

$host = 'itp460.usc.edu';
$database_name = 'dvd';
$username = 'student';
$password = 'ttrojan';
$pdo = new PDO("mysql:host=$host;dbname=$database_name", $username, $password);

$ratings = $_GET['rating_name'];

$sql="
SELECT title, rating_name
FROM dvds, ratings
WHERE dvds.rating_id = ratings.id
AND ratings.rating_name=?";


$statement = $pdo->prepare($sql);
$statement->bindParam(1, $ratings);
$statement->execute();
$movies = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<ul>
  <?php foreach ($movies as $movie) : ?>
    <li>
      <?php echo $movie->title ?> is rated: <?php echo $movie->rating_name ?>
    </li>
  <?php endforeach; ?>
</ul>
