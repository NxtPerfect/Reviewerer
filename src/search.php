<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "reviewerer";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Couldn't connect to database");
}

if(isset($_GET["search_name"])) {
  $name = $_GET["search_name"];
  $sql = "SELECT * FROM products WHERE name LIKE '%" . $name . "%';";
  $result = $conn->query($sql);
} ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <title>Wyszukiwanie</title>
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'nav.php';?>
    <main>
      <h3>Results</h3>
      <?php 
          while($row = $result->fetch_assoc()) {
            $sql = "SELECT COUNT(*) as total_reviews, SUM(score)/COUNT(*) as total_score FROM reviews WHERE product_id = '" . $row["id"] . "';";
            $count = $conn->query($sql);
            $count = $count->fetch_assoc();
            echo "<div class='review'>";
            echo "<h3>" . $row["name"]. "</h3>";
            echo "<p>Total Reviews: " . $count["total_reviews"] . "</p><p>Total Score: " . number_format($count["total_score"], 2) . "<a href='review.php?id=" . $row["id"] . "'>Review</a></div>";
          }
          mysqli_free_result($result);
?>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
