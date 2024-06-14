<?php
  require_once('db.php');
  $conn = connectDb();

  function login() {
    if (!isset($_POST["email"])) {
      return;
    }
    if (!isset($_POST["password"])) {
      return;
    }
    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT email, password, role FROM users WHERE email LIKE '$email';";
    $res = mysqli_query(connectDb(), $query);
    $res = mysqli_fetch_all($res, MYSQLI_ASSOC);
    if (count($res) == 0) {
      mysqli_free_result($res);
      return "Niepoprawne dane logowania.";
    }
    if ($res[0]["password"] == $password) {
      $_SESSION["email"] = $_POST["email"];
      $_SESSION["role"] = $res[0]["role"];
      header('Location: home.php', true, 301);
      return;
    }
    return "Niepoprawne dane logowania.";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <title></title>
    <link href="../css/style.css" rel="stylesheet">
  </head>
  <body>
    <?php include 'nav.php';?>
    <main>
      <form action="login.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="email@domain.io" minlength="4" maxlength="64" required></input>
        <label for="password">Hasło</label>
        <input type="password" name="password" placeholder="********" minlength="8" maxlength="64" required></input>
        <button type="submit">Zaloguj</button>
      </form>
    <?php echo "<span class='error'>" . login() . "</span>";?>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
