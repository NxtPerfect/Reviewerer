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
  <form class="bg-black rounded-full pl-4" action="search.php">
    <input class="bg-transparent" type="text" name="search_name" maxlength="64" placeholder="Wyszukaj nazwy produktu"></input>
    <button class="text-white bg-gray-600 hover:bg-gray-700 hover:cursor-pointer active:bg-gray-500 transition rounded-r-full px-2 pr-4 py-1 h-full" type="submit">Szukaj</button>
  </form>
  <div class="flex flex-row gap-4">
  <?php
    if ($_SESSION["email"]) {
      echo "<a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href='/src/home.php'>Strona główna</a>";
      echo "<span>" . $_SESSION["email"] . "</span>";
      echo "<a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href='/src/nav.php?logout=1'>Wyloguj</a></div></nav>";
      return;
    }
  ?>
    <a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href="/src/home.php">Strona główna</a>
    <a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href="/src/login.php">Zaloguj</a>
    <a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href="/src/register.php">Zarejestruj</a>
  </div>
</nav>
