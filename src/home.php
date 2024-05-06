<?php
  require_once('db.php');
  $conn = connectDb();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'nav.php';?>
    <main>
      <h1>Reviewer</h1>
      <h2>Najnowsze recenzje</h2>
      <div class="recent_reviews">
        <?php
          // Pokaż ostatnie 20 recenzji
          $sql = "SELECT *, (SELECT name FROM products p WHERE p.id = product_id) product_name, (SELECT id FROM products p WHERE p.id = product_id) product_id FROM reviews ORDER BY date LIMIT 20;";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            echo "<div class='review'><h3><a href='review/" . $row["product_id"] . "'>" . $row["product_name"]. "</a></h3><p class='title'>". $row["title"] . "</p><p class='date'>". $row["date"] ."</p><p class='description'>" . $row["description"] . "</p></div>";
            echo "<div class='review'><h3><a href='review/" . $row["product_id"] . "'>" . $row["product_name"]. "</a></h3><p class='title'>". $row["title"] . "</p><p class='date'>". $row["date"] ."</p><p class='description'>" . $row["description"] . "</p></div>";
          }
          mysqli_free_result($result);
        ?>
      </div>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
