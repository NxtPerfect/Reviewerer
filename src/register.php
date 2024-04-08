<?php
  require_once('db.php');
  $conn = connectDb();

  function register() {
    if (!isset($_POST["email"])) {
      return;
    }
    if (!isset($_POST["username"])) {
      return "Username field is empty.";
    }
    if (!isset($_POST["password"])) {
      return "Password field is empty.";
    }
    if (!isset($_POST["confirm_password"])) {
      return "Confirm password field is empty.";
    }
    if ($_POST["password"] != $_POST["confirm_password"]) {
      return "Passwords don't match";
    }
    $_uuid = uuidv4();
    $_username = $_POST["username"];
    $_email = $_POST["email"];
    $_password = $_POST["password"];
    $query = "INSERT INTO users (id, username, email, password, total_reviews) VALUES ('$_uuid', '$_username', '$_email', '$_password', 0);";
    $res = mysqli_query(connectDb(), $query);
    header('Location: home.php', true, 301);
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
      <form action="register.php" method="POST">
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="email@domain.io" minlength="4" maxlength="64" required></input>
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="username" minlength="2" maxlength="64" required></input>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="********" minlength="8" maxlength="64" required></input>
        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="confirm_password" placeholder="********" minlength="8" maxlength="64" required></input>
        <button type="submit">Register</button>
        <button type="button" href="login.php">Login</button>
      </form>
    <?php echo "<span class='error'>" . register() . "</span>";?>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
