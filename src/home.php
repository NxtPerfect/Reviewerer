<?php
  require_once('db.php'); // Połącz z bazą danych
  $conn = connectDb();

  // Jeśli administrator chce usunąc post, i ma ustawioną rolę administratora
  if(isset($_POST["remove"]) && $_POST["remove"] == true && $_SESSION["role"] == "admin") {
    $sql = "DELETE FROM reviews WHERE id = '" . $_POST["id"] . "';";
    $result = $conn->query($sql);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reviewer</title>
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'nav.php';?>
    <main class="flex flex-col justify-center justify-items-center items-center content-center">
      <h1 class="text-4xl font-semibold m-8">Reviewerer</h1>
      <h2 class="text-2xl m-4">Najnowsze recenzje</h2>
      <div class="flex flex-row flex-wrap flex-none basis-full gap-x-8 gap-y-4 p-4 bg-gray-200 rounded-md w-[75svw] justify-items-center justify-center items-center">
        <?php
          // Pokaż ostatnie 20 recenzji
          $sql = "SELECT *, (SELECT name FROM products p WHERE p.id = product_id) product_name, (SELECT id FROM products p WHERE p.id = product_id) product_id FROM reviews ORDER BY date DESC LIMIT 20;";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            echo "<div class='flex flex-col justify-items-center justify-center items-center bg-gray-300 shadow-md rounded-md p-4 min-w-48'>";
            echo "<h3 class='text-xl font-semibold'>";
            echo "<a href='review.php?id=" . $row["product_id"] . "'>" . $row["product_name"]. "</a>";
            echo "</h3>";
            echo "<p class='text-lg'>". $row["title"] . "</p>";
            echo "<p class='font-thin text-sm'>". $row["date"] ."</p>";
            echo "<p class='leading-8 max-w-[40ch] mt-4 text-justify'>" . $row["description"] . "</p>";
            echo "<p class='font-mono mt-4'>" . $row["score"] . "/100</p>";
            // Administrator powinien móc usuwać recenzje
            // form musi przesłać id jako post
            // na górze pliku sql query żeby usunąć
            if ($_SESSION["role"] == "admin") {
              echo "<form method='POST' action='home.php'>";
              echo "<input type='hidden' name='id' value='" . $row["id"] . "'></input>";
              echo "<input type='hidden' name='remove' value='true'></input>";
              echo "<button class='bg-red-500 px-4 py-2 rounded-md shadow-md text-white hover:bg-red-400 active:bg-red-600' type='submit'>Usuń</button>";
              echo "</form>";
            }
            echo "</div>";
          }
          mysqli_free_result($result);
        ?>
      </div>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
