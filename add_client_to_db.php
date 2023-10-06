<?php
/* 2023-10-06 16:46:30 */
require_once('connection/connectionConfig.php');

$redirect_phrase = "Redirecting you to previous page in 3 seconds...";

$Client_Username = $_GET["Client_Username"];

$cuq = $dbh->prepare("SELECT Client_Username FROM Clients WHERE Client_Username = :username");
$cuq->bindParam(':username', $Client_Username);
$cuq->execute();

if ($cuq->rowCount() > 0) {
  echo "The User Exists... <br />";
  echo $redirect_phrase;

  echo '<script>
          setTimeout(function() {
            window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
          }, 3000);
        </script>';
} else {
  $stmt = $dbh->prepare("INSERT INTO Clients (Client_Username) VALUES (:username);");

  $stmt->bindParam(':username', $Client_Username);
  $stmt->execute();
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
