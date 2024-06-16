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
    if (password_verify($password, $res[0]["password"])) {
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
    <main class="flex flex-col p-4 justify-center justify-items-center items-center">
      <h2 class="font-bold text-2xl mt-4">Logowanie</h2>
      <form action="login.php" method="POST" class="flex flex-col gap-2 bg-neutral-500 rounded-md shadow-sm p-4 mt-4 max-w-[40ch] justify-center justify-items-center items-center">
        <label for="email" class="text-white font-semibold">Email</label>
        <input type="email" name="email" class="rounded-md px-2 py-1" placeholder="email@domain.io" minlength="4" maxlength="64" required></input>
        <label for="password" class="text-white font-semibold" >Hasło</label>
        <input type="password" name="password" class="rounded-md px-2 py-1 mb-8" placeholder="********" minlength="8" maxlength="64" required></input>
        <button type="submit" class="bg-neutral-300 hover:bg-neutral-400 active:bg-neutral-200 rounded-md shadow-md px-2 py-1 w-[20ch] mb-4">Zaloguj</button>
      </form>
    <?php echo "<span class='error'>" . login() . "</span>";?>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
