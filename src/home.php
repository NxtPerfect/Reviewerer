<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "reviewerer";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Couldn't connect to database");
}
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
    <nav>
      <div class="logo">Logo</div>
      <form class="search">
        <input type="text" name="name" class="search_bar" maxlength="64" placeholder="Search Product"></input>
        <button type="submit">Search</button>
      </form>
      <div class="links">
        <a href="/src/login.php">Login</a>
        <a href="/src/register.php">Register</a>
      </div>
    </nav>
    <main>
      <h1>Reviewer</h1>
      <h2>Recent reviews</h2>
      <div class="recent_reviews">
        <?php
          // Pokaż ostatnie 20 recenzji
          $sql = "SELECT *, (SELECT name FROM products p WHERE p.id = product_id) product FROM reviews ORDER BY date LIMIT 20;";
          $result = $conn->query($sql);
          while($row = $result->fetch_assoc()) {
            echo "<div class='review'><h3>" . $row["product"]. "<p class='title'>". $row["title"] . "</p><p class='date'>". $row["date"] ."</p><p class='description'>" . $row["description"] . "</p></div>";
          }
          $conn->close();
        ?>
        <div class="review">R1</div>
        <div class="review">R2</div>
        <div class="review">R3</div>
        <div class="review">R4</div>
      </div>
    </main>
    <footer>
        <a href="/src/login.php">Login</a>
        <a href="/src/register.php">Register</a>
    </footer> 
  </body>
</html>
