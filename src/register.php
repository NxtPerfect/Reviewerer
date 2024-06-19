<?php
  require_once('db.php');
  $conn = connectDb();

  function register() {
    if (!isset($_POST["email"])) { // Jesli nie podany email
      return;
    }
    if (!isset($_POST["username"])) { // Jeśli nie podana nazwa użytkownika
      return "Username field is empty.";
    }
    if (!isset($_POST["password"])) { // jeśli nie podane hasło
      return "Password field is empty.";
    }
    if (!isset($_POST["confirm_password"])) { // jeśli nie podane potwierdzenie hasła
      return "Confirm password field is empty.";
    }
    if ($_POST["password"] != $_POST["confirm_password"]) { // jeśli hasło i potwierdzenie hasła się nie zgadzają
      return "Passwords don't match";
    }
    $_uuid = uuidv4();
    $_username = $_POST["username"];
    $_email = $_POST["email"];
    $_password = password_hash($_POST["password"], PASSWORD_DEFAULT); // zaszyfruj hasło
    $query = "SELECT * FROM users WHERE email = '$_email';";
    echo $query;
    $res = mysqli_query(connectDb(), $query);
    if (count(mysqli_fetch_all($res, MYSQLI_ASSOC)) > 0) { // Jeśli użytkownik o takim mailu istnieje, pokaż błąd
      mysqli_free_result($res);
      return "Użytkownik istnieje.";
    }
    mysqli_free_result($res);
    // Dodaj użytkownika do bazy danych i przenieś na stronę główną
    $query = "INSERT INTO users (id, username, email, password, role) VALUES ('$_uuid', '$_username', '$_email', '$_password', 'user');";
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
    <main class="flex flex-col p-4 justify-center justify-items-center items-center">
      <h2 class="font-bold text-2xl mt-4">Rejestracja</h2>
      <form action="register.php" method="POST" class="flex flex-col gap-2 bg-neutral-500 rounded-md shadow-sm p-4 mt-4 max-w-[40ch] justify-center justify-items-center items-center">
        <label for="email" class="text-white font-semibold" >Email</label>
        <input type="email" name="email" class="rounded-md px-2 py-1 mb-8" placeholder="email@domain.io" minlength="4" maxlength="64" required></input>
        <label for="username" class="text-white font-semibold" >Nazwa użytkownika</label>
        <input type="text" name="username" class="rounded-md px-2 py-1 mb-8" placeholder="username" minlength="2" maxlength="64" required></input>
        <label for="password" class="text-white font-semibold" >Hasło</label>
        <input type="password" name="password" class="rounded-md px-2 py-1 mb-8" placeholder="********" minlength="8" maxlength="64" required></input>
        <label for="confirm_password" class="text-white font-semibold" >Powtórz hasło</label>
        <input type="password" name="confirm_password" class="rounded-md px-2 py-1 mb-8" placeholder="********" minlength="8" maxlength="64" required></input>
        <button type="submit" class="bg-neutral-300 hover:bg-neutral-400 active:bg-neutral-200 rounded-md shadow-md px-2 py-1 w-[20ch] mb-4">Zarejestruj</button>
        <button type="button" href="login.php" class="bg-neutral-300 hover:bg-neutral-400 active:bg-neutral-200 rounded-md shadow-md px-2 py-1 w-[20ch] mb-4">Zaloguj</button>
      </form>
    <?php echo "<span class='error'>" . register() . "</span>";?>
    </main>
    <?php include 'footer.php';?>
  </body>
</html>
