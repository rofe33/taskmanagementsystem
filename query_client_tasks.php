<?php
/* 2023-10-06 19:55:12 */
require_once('connection/connectionConfig.php');

$cuq = $dbh->prepare("SELECT Client_Username FROM Clients");
$cuq->execute();

if (!($cuq->rowCount() > 0)) {
  echo "There are no clients <br />";
  echo "Redirecting you to add clients :)";

  echo '<script>
          setTimeout(function() {
            window.location.href = "add_client.html";
          }, 2000);
        </script>';
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Query Client Tasks (2023-10-06 19:55:53)</title>
  </head>
  <body>
    <h1>Query Client Tasks</h1>

    <form action="query_client_tasks_from_db.php" method="GET">
      <label for="queryClient">Client Username:</label>
      <select id="queryClient" name="queryClient">
        <?php
        foreach ($cuq as $row) {
          echo "<option value=\"$row[0]\">$row[0]</option>";
        }
        ?>
      </select>
      <br />

      <button type="submit">Query Tasks</button>
    </form>

    <a href="index.html">Go Back</a>
  </body>
</html>
