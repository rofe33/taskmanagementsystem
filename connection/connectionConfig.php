<?php
/* 2023-10-06 16:29:26 */

$db_host = "";
$db_user = "";
$db_pass = "";
$db_name = "";

try {
  $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $e) {
  die("Unable to connect: " . $e->getMessage());
}
