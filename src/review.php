<?php
  require_once('db.php');
  $conn = connectDb();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Review</title>
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'nav.php';?> 
    <main>
      <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM products p WHERE p.id = '$id' LIMIT 1;";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
          echo "<div class='review'><h3><a href='review/" . $row["id"] . "'>" . $row["name"]. "</a></h3>" . $row["total_reviews"] . "/" .$row['total_score'] . "</div>";
          // Tutaj powinna być możliwość dania oceny
        }
      ?>
    </main>
  <?php include 'footer.php';?> 
  </body>
</html>
