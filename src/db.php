<?php
function connectDb() {
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "reviewerer";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Couldn't connect to database");
  }
  // Rozpocznij sesję użytkownika - autoryzacja
  session_start();

  // Zwróć połączenie do bazy danych
  return $conn;
}

function uuidv4()
{
  $data = random_bytes(16);

  $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
  $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    
  // Zwróc jako string
  return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
?>
