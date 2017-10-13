<!--
@Filename: CreatePosts.php
@Author:   Ben Sokol <Ben>
@Email:    bensokol@ku.edu
@Created:  October 12th, 2017 [9:53pm]
@Modified: October 12th, 2017 [11:18pm]

Copyright (C) 2017 by Ben Sokol. All Rights Reserved.
-->


<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 5</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  <h1 class="center">View Users</h1>
  <?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $mysqli = new mysqli("mysql.eecs.ku.edu", "bsokol", 'P@$$word123', "bsokol");

  if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }
  if ($result = $mysqli->query("SELECT user_id FROM Users")) {
    while ($row = $result->fetch_assoc()) {
      print $row["user_id"]."<br>";
    }
    $result->free();
  }

  $mysqli->close();
  ?>
</body>
</html>
