<?php
  if (isset($_GET["logout"])) {
    session_start();
    $_SESSION["email"] = '';
    $_SESSION["role"] = '';
    unset($_SESSION["email"]);
    unset($_SESSION["role"]);
    session_unset();
    session_destroy();
    echo $_SESSION["email"] . " " . $_SESSION["role"];
  }
?>

<nav class="grid grid-col-3 justify-items-center max-sm:justify-between max-sm:px-0 justify-center items-center gap-4 bg-neutral-200 w-full py-4">
  <div class="logo">Reviewerer</div>
  <form class="flex flex-row bg-black rounded-full pl-4" action="search.php">
    <input class="bg-transparent text-white w-full" type="text" name="search_name" maxlength="64" placeholder="Wyszukaj nazwy produktu"></input>
    <button class="text-white bg-gray-600 hover:bg-gray-700 hover:cursor-pointer active:bg-gray-500 transition rounded-r-full xl:px-2 xl:pr-4 xl:py-1 h-full" type="submit">Szukaj</button>
  </form>
  <div class="flex xl:flex-row flex-col gap-4">
  <?php
    if (isset($_SESSION["email"])) {
      echo "<a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href='/src/home.php'>Strona główna</a>";
      echo "<span>" . $_SESSION["email"] . "</span>";
      echo "<a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href='/src/home.php?logout=1'>Wyloguj</a></div></nav>";
      return;
    }
  ?>
    <a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href="/src/home.php">Strona główna</a>
    <a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href="/src/login.php">Zaloguj</a>
    <a class='text-sky-500 hover:text-sky-600 hover:cursor-pointer active:text-sky-400 transition underline' href="/src/register.php">Zarejestruj</a>
  </div>
</nav>
