<?php

// hostname: "127.0.0.1"
// username: "mariadb"
// password: "mariadb"
// database: "mariadb"
// port:     3306

// 1. Create db connection
$db = mysqli_connect("127.0.0.1", "mariadb", "mariadb", "mariadb", 3306);

// Test db connection
if (mysqli_connect_errno()) {
  $msg = 'HEY Database connection failed';
  $msg .= mysqli_connect_error();
  $msg .= "( " . mysqli_connect_error() . ")";
  exit($msg);
}

// 2. Query db
$sql = "SELECT * FROM tasks LIMIT 1";
$result = mysqli_query($db, $sql);

// Error Handle
if (!$result) {
  exit("Nothing returned from database");
}

// 3. Return db data as an associated array
$task = mysqli_fetch_assoc($result);

?>

<!doctype html>
<html lang="en">

<head>
  <title>Task Manager: Show Task</title>
</head>

<body>

  <header>
    <h1>Task Manager</h1>
  </header>

  <section>

    <h1>Show Task</h1>

    <dl>
      <dt>ID</dt>
      <dd><?php echo $task['id']; ?></dd>
    </dl>
    <dl>
      <dt>Priority</dt>
      <dd><?php echo $task['priority']; ?></dd>
    </dl>
    <dl>
      <dt>Completed</dt>
      <dd><?php echo $task['completed'] == 1 ? 'true' : 'false'; ?></dd>
    </dl>
    <dl>
      <dt>Description</dt>
      <dd><?php echo $task['description']; ?></dd>
    </dl>

  </section>

</body>

</html>

<?php
// 4. Release returned data from db
mysqli_free_result($result);

// 5. Close db connection
mysqli_close($db);

?>