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
        while($row = $result->fetch_assoc()) {
          echo "<div class='flex flex-col border-2 border-black rounded-md p-4'><h3><a href='review.php?id=" . $row["id"] . "'>" . $row["name"]. "</a></h3>" . $row["total_reviews"] . "/" .$row['total_score'] . "</div>";
          // Tutaj powinna być możliwość dania oceny
        }
      ?>
      <form class="flex flex-col justify-items-center items-center border-2 border-black shadow-md rounded-md p-4" method="POST">
        <label class="text-lg font-medium" for='title'>Tytuł</label>
        <input class="bg-neutral-200 rounded-md px-2 py-1" name='title' type='text' maxlength=100 placeholder="Tytuł" required></input>
        <label class="text-lg font-medium mt-2" for='description'>Opis</label>
        <input class="bg-neutral-200 rounded-md px-2 py-1" name='description' type='text' maxlength=500 placeholder="Opis" required></input>
        <label class="text-lg font-medium mt-2" for='score'>Ocena</label>
        <input class="bg-neutral-200 rounded-md px-2 py-1 mb-8" name='score' type='number' min=0 max=100 placeholder="Ocena 0-100" required></input>
        <button class="text-white max-w-[fit-content] bg-sky-500 rounded-md px-4 py-2 hover:cursor-pointer hover:bg-sky-600 transition active:bg-sky-400" type="submit">Wystaw ocenę</button>
      </form>
    </main>
  <?php include 'footer.php';?> 
  </body>
</html>
