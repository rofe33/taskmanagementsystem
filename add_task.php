<?php
/* 2023-10-06 17:10:01 */
require_once('connection/connectionConfig.php');

$cuq = $dbh->prepare("SELECT Client_Username FROM Clients");
$cuq->execute();

if (!($cuq->rowCount() > 0)) {
  echo "There are no usernames <br />";
  echo "Redirecting you to add clients :)";

  echo '<script>
          setTimeout(function() {
            window.location.href = "add_client.html";
          }, 3000);
        </script>';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Add Task (2023-10-06 16:33:53)</title>
  </head>
  <body>
    <h1>Add Task</h1>

    <form action="add_task_to_db.php" method="POST">
      <label for="taskClient">Client Username:</label>
      <select id="taskClient" name="taskClient">
        <?php
        foreach ($cuq as $row) {
          echo "<option value=\"$row[0]\">$row[0]</option>";
        }
        ?>
      </select>
      <br />

      <label for="taskTask">Task:</label>
      <input type="text" id="taskTask" name="taskTask" required />
      <br />

      <label for="taskLocation">Task Location:</label>
      <input type="text" id="taskLocation" name="taskLocation" />
      <br />

      <label for="taskStatus">Task Status:</label>
      <select id="taskStatus" name="taskStatus">
        <option value="In-complete">In-complete</option>
        <option value="In-Progress">In-Progress</option>
        <option value="Completed">Completed</option>
      </select>
      <br />

      <button type="submit">Add Task</button>
    </form>

    <a href="index.html">Go Back</a>
  </body>
</html>
