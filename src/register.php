<?php
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
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
