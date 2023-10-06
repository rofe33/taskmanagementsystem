<?php
/* 2023-10-06 16:29:26 */

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "TaskManagementSystem";

try {
  $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
  echo "Connection Established :) <br />";
} catch (PDOException $e) {
  echo "Couldn't Connect :( <br />";
  exit();
}
