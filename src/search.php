<?php
  require_once('db.php');
  $conn = connectDb(); // Połącz z bazą danych

  if(isset($_GET["search_name"])) { // Jeśli wpisana nazwa, wyszukaj podobnych
    $name = $_GET["search_name"];
    $sql = "SELECT * FROM products WHERE name LIKE '%" . $name . "%';";
    $result = $conn->query($sql);
  }
?>

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
    <main class="flex flex-col justify-center justify-items-center items-center content-center">
      <h3>Results</h3>
      <?php 
          while($row = $result->fetch_assoc()) { // Zwróć każdy obiekt którego nazwa posiada frazę
            $sql = "SELECT COUNT(*) as total_reviews, SUM(score)/COUNT(*) as total_score FROM reviews WHERE product_id = '" . $row["id"] . "';";
            $count = $conn->query($sql);
            $count = $count->fetch_assoc();
            echo "<div class='flex flex-col mb-4 px-4 py-2 rounded-md shadow-sm border-2 border-black'>";
            echo "<h3 class='font-semibold text-lg'>" . $row["name"]. "</h3>";
            echo "<p>Total Reviews: " . $count["total_reviews"] . "</p>";
            echo "<p>Total Score: " . number_format($count["total_score"], 2) . "</p>";
            echo "<a href='review.php?id=" . $row["id"] . "' class='bg-neutral-300 hover:bg-neutral-400 active:bg-neutral-200 rounded-md shadow-md max-w-fit px-4 py-1'>Oceń</a></div>";
          }
          mysqli_free_result($result);
?>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
