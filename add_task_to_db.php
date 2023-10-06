<?php
/* 2023-10-06 16:46:30 */
require_once('connection/connectionConfig.php');

$redirect_phrase = "Redirecting you to previous page in 1 second...";

$Client_Username = $_POST["taskClient"];
$taskTask = $_POST["taskTask"];
$taskLocation = $_POST["taskLocation"];
$taskStatus = $_POST["taskStatus"];

$cuq = $dbh->prepare("SELECT * FROM Clients WHERE Client_Username = :username");
$cuq->bindParam(':username', $Client_Username);
$cuq->execute();

if (!($cuq->rowCount() > 0)) {
  echo "The User Doesn't Exists... <br />";
  echo $redirect_phrase;

} else {
  $client = $cuq->fetch(PDO::FETCH_ASSOC);

  $taskClient_ID = $client["Client_ID"];

  $stmt = $dbh->prepare("INSERT INTO `Tasks` (Client_ID, Task_Status, Task, Task_Location) VALUES (:Client_ID, :Task_Status, :taskTask, :Task_Location);");

  echo "Adding Task to database... <br />";

  $stmt->bindValue(':Client_ID', $taskClient_ID, PDO::PARAM_INT);
  $stmt->bindValue(':Task_Status', $taskStatus, PDO::PARAM_STR);
  $stmt->bindValue(':taskTask', $taskTask, PDO::PARAM_STR);
  $stmt->bindValue(':Task_Location', $taskLocation, PDO::PARAM_STR);
  $stmt->execute();

  echo "The task is added to the database... <br />";
  echo $redirect_phrase;
}


echo '<script>
        setTimeout(function() {
          window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
        }, 1000);
      </script>';

exit();
