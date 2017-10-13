<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 6</title>
  <link type="text/css" rel="stylesheet" href="style.css">
</head>
<body>
  <h1 class="center">View User Posts</h1>
  <?php
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $mysqli = new mysqli("mysql.eecs.ku.edu", "bsokol", 'P@$$word123', "bsokol");
  if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
  }

  if (!isset($_GET['username'])) {
    print "<form>";
    if ($result = $mysqli->query("SELECT user_id FROM Users")) {
      print "<select name=\"username\">";
      while ($row = $result->fetch_assoc()) {
        print "<option value=".$row["user_id"].">".$row["user_id"]."</option>";
      }
      print "</select>";
      $result->free();
    }
    print "<input type=\"submit\">";
    print "</form>";
  }
  else {
    print "User: ".$_GET['username']." detected<br>";
    // if ($result = $mysqli->query("SELECT user_id FROM Users")) {
    //   while ($row = $result->fetch_assoc()) {
    //     print $row["user_id"]."<br>";
    //   }
    //   $result->free();
    // }
  }


  $mysqli->close();
  ?>
</body>
</html>
