<!--
@Filename: CreatePosts.php
@Author:   Ben Sokol <Ben>
@Email:    bensokol@ku.edu
@Created:  October 12th, 2017 [9:53pm]
@Modified: October 12th, 2017 [10:50pm]

Copyright (C) 2017 by Ben Sokol. All Rights Reserved.
-->


<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 3</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form">
    <h1 class="center">Create User</h1>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $mysqli = new mysqli("mysql.eecs.ku.edu", "bsokol", 'P@$$word123', "bsokol");

    if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }

    $result = $mysqli->query("SELECT COUNT(user_id) FROM Users WHERE user_id = '".$_POST["username"]."'");
    list($count) = $result->fetch_row();

    if (!isset($_POST["username"])) {
      print "ERROR: Usernames must contain at least 1 character<br><br>";
    }
    else if(!isset($_POST["post"])) {
      print "ERROR: Posts must contain at least 1 character<br><br>";
    }
    else if ($count) {
      if(!$mysqli->query("INSERT INTO Posts (author_id, content) VALUES ('".$_POST["username"]."','".$_POST["post"]."')")) {
        print "An ERROR has occured when checking if the username is in the database.";
      }
      else {
        print "Welcome ".$_POST["username"]."!<br><br>";
        print "Your post has been sucessfully created!<br><br>";
      }
    }
    else {
      print "ERROR: the username '".$_POST["username"]."' has not been created.<br><br>";
    }

    $mysqli->close();
    ?>
  </div>
</body>
</html>
