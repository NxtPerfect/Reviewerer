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
    <main class="flex flex-col justify-center justify-items-center items-center content-center">
      <h1 class="text-4xl font-semibold m-8">Reviewer</h1>
      <h2 class="text-2xl m-4">Najnowsze recenzje</h2>
      <div class="flex flex-row flex-wrap flex-none basis-full gap-x-8 gap-y-4 p-4 bg-gray-200 rounded-md w-[75svw] justify-items-center justify-center items-center">
        <?php
          // Pokaż ostatnie 20 recenzji
          $sql = "SELECT *, (SELECT name FROM products p WHERE p.id = product_id) product_name, (SELECT id FROM products p WHERE p.id = product_id) product_id FROM reviews ORDER BY date LIMIT 20;";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            echo "<div class='flex flex-col justify-items-center justify-center items-center bg-gray-300 shadow-md rounded-md p-4'><h3 class='text-xl font-semibold'><a href='review.php?id=" . $row["product_id"] . "'>" . $row["product_name"]. "</a></h3><p class='text-lg'>". $row["title"] . "</p><p class='font-thin text-sm'>". $row["date"] ."</p><p class='leading-8'>" . $row["description"] . "</p><p class='font-mono'>" . $row["score"] . "</p></div>";
          }
          mysqli_free_result($result);
        ?>
      </div>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
