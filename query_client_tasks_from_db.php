<?php
/* 2023-10-06 20:15:44 */
require_once('connection/connectionConfig.php');

$redirect_phrase = "Redirecting you to previous page in 1 second...";

$Client_Username = $_GET["queryClient"];

$cuq = $dbh->prepare("SELECT * FROM Clients WHERE Client_Username = :username");
$cuq->bindParam(':username', $Client_Username);
$cuq->execute();

if (!($cuq->rowCount() > 0)) {
  echo "The User Doesn't Exists... <br />";
  echo $redirect_phrase;

  echo '<script>
          setTimeout(function() {
            window.location.href = "' . $_SERVER['HTTP_REFERER'] . '";
          }, 1000);
        </script>';
  exit();
} else {
  $client = $cuq->fetch(PDO::FETCH_ASSOC);

  $Client_ID = $client["Client_ID"];
  $Client_Username = $client["Client_Username"];

  $cuq = $dbh->prepare("SELECT Clients.Client_Username, Tasks.* FROM Clients, Tasks WHERE Tasks.Client_ID = :client_id AND Clients.Client_ID = :client_id; ");

  $cuq->bindValue(':client_id', $Client_ID, PDO::PARAM_STR);
  $cuq->execute();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title><?= $Client_Username ?>'s Tasks (2023-10-06 20:27:02)</title>

    <link rel="stylesheet" href="css/table-style.css">
  </head>
  <body>
    <h1><?= $Client_Username ?>'s Tasks</h1>

    <table>
      <thead>
        <tr>
          <th scope="col">Task Id</th>
          <th scope="col">Task</th>
          <th scope="col">Task Location</th>
          <th scope="col">Task Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cuq as $task) { ?>
        <tr<?php if ($task["Task_Status"] == "Completed"): ?> class="completed"<?php elseif ($task["Task_Status"] == "In-Progress"): ?> class="inprogress"<?php else: ?> class="incomplete"<?php endif ?>>
          <th scope="row"><?= $task["Task_ID"] ?></th>
          <td><?= $task["Task"] ?></td>
          <td><?= $task["Task_Location"] ?></td>
          <td><?= $task["Task_Status"] ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <a href="query_client_tasks.php">Go Back</a>
  </body>
</html>
