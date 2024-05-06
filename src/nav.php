<?php
  session_start();
  if (isset($_GET["logout"])) {
    session_unset();
    unset($_SESSION['email']);
    session_destroy();
    header('Location: home.php');
    exit();
  }
?>

<nav>
  <div class="logo">Logo</div>
  <form class="search" action="search.php">
    <input type="text" name="search_name" class="search_bar" maxlength="64" placeholder="Szukaj"></input>
    <button type="submit">Szukaj</button>
  </form>
  <div class="links">
  <?php
    if ($_SESSION["email"]) {
      echo "<a href='/src/home.php'>Strona główna</a>";
      echo "<span>" . $_SESSION["email"] . "</span>";
      echo "<a href='/src/nav.php?logout=1'>Wyloguj</a></div></nav>";
      return;
    }
  ?>
    <a href="/src/home.php">Strona główna</a>
    <a href="/src/login.php">Zaloguj</a>
    <a href="/src/register.php">Zarejestruj</a>
  </div>
</nav>
