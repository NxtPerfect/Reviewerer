<?php
  require_once('db.php');
  $conn = connectDb();

  if (isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["score"])) {
    $_em = $_SESSION["email"];
    $sql = "SELECT id FROM users WHERE email = '$_em';";
    $res = mysqli_query($conn, $sql);
    $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
    $_uid = $res[0];
    $_pid = $_GET["id"];
    $_id = uuidv4();
    $_title = $_POST["title"];
    $_descr = $_POST["description"];
    $_score = $_POST["score"];
    $sql = "INSERT INTO reviews (user_id, product_id, id, date, title, description, score) VALUES ('$_uid', '$_pid', '$_id', CURDATE(), '$_title', '$_descr', '$_score');";
    $res = mysqli_query($conn, $sql);
    header('Location: home.php', true, 301);
  }
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
        $sql = "SELECT * FROM products p WHERE p.id = '$id';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sql = "SELECT COUNT(*) as total_reviews, SUM(score)/COUNT(*) as total_score FROM reviews WHERE product_id = '" . $row["id"] . "';";
        $count = $conn->query($sql);
        $count = $count->fetch_assoc();
        echo "<div class='flex flex-col border-2 border-black rounded-md p-4'>";
        echo "<h3><a href='review.php?id=" . $row["id"] . "'>" . $row["name"]. "</a></h3>";
        echo $count["total_reviews"] . "/" . number_format($count['total_score'], 2) . "</div>";

        echo "<h4 class='text-lg font-medium mt-4'>Najnowsze 5 recenzji</h4>";
        $sql = "SELECT * FROM reviews WHERE product_id = '" . $row["id"] . "' ORDER BY date DESC LIMIT 5;";
        $reviews = $conn->query($sql);
        echo "<div class='grid grid-cols-4 gap-4 my-4 mt-2 justify-items-center justify-center items-center'>";
        while($review = $reviews->fetch_assoc()) {
          echo "<div class='flex flex-col rounded-md bg-neutral-200 px-8 py-2 justify-items-center justify-center items-center'>";
          echo "<h3>". $review["title"] . "</h3>";
          echo "<div>" . $review["description"] . "</div>";
          echo "<div>" . $review["score"] . "</div>";
          echo "</div>";
        }
        echo "</div>";
      ?>
      <form class="flex flex-col justify-items-center items-center border-2 border-black shadow-md rounded-md p-4" method="POST">
        <label class="text-lg font-medium" for='title'>Tytuł</label>
        <input class="bg-neutral-200 rounded-md px-2 py-1 w-[40ch]" name='title' type='text' maxlength=40 placeholder="Ten produkt jest wybitny!" required></input>
        <label class="text-lg font-medium mt-2" for='description'>Opis</label>
        <textarea class="bg-neutral-200 rounded-md px-2 py-1 h-24 w-[60ch] resize-none" name='description' type='text' maxlength=500 placeholder="Dzięki niemu moje życie zmieniło się o 360 stopni. Wykonanie jest nieziemskie, czas dostawy to jedyne 24h, nie popsuł się od 36 lat, polecam!" required></textarea>
        <label class="text-lg font-medium mt-2" for='score'>Ocena</label>
        <input class="bg-neutral-200 rounded-md px-2 py-1 mb-8 w-32" name='score' type='number' min=0 max=100 placeholder=<?php echo '"' . rand(0,100) . '"'; ?> required></input>
        <button class="text-white max-w-[fit-content] bg-sky-500 rounded-md px-4 py-2 hover:cursor-pointer hover:bg-sky-600 transition active:bg-sky-400" type="submit">Wystaw ocenę</button>
      </form>
    </main>
  <?php include 'footer.php';?> 
  </body>
</html>
