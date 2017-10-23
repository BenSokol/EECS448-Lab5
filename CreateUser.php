<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 2</title>
  <link type="text/css" rel="stylesheet" href="css/style.css">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.css">
</head>
<body>
  <div class="tabs">
    <ul>
      <li><big><big><b>Lab 5</b></big></big></li>
      <li class="is-active"><a href="CreateUser.html">Create User</a></li>
      <li><a href="CreatePosts.html">Create Post</a></li>
      <li><a href="AdminHome.html">Admin Home</a></li>
      <li class="navbar-end"><a href="https://github.com/BenSokol/Lab-5">
        <img class="github-image" src="img/Github-logo.png" alt="Github">
      </a></li>
    </ul>
  </div>

  <div class="container below-navbar">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $mysqli = new mysqli("mysql.eecs.ku.edu", "bsokol", 'P@$$word123', "bsokol");
    if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }

    if($result = $mysqli->query("SELECT COUNT(user_id) FROM Users WHERE user_id = '".$mysqli->real_escape_string($_POST["username"])."'")) {
      list($count) = $result->fetch_row();
    }
    else {
      print "<article class=\"message is-danger\">";
      print "<div class=\"message-header\">";
      print "<p>ERROR</p>";
      print "</div>";
      print "<div class=\"message-body\">";
      print "An ERROR has occured when adding the username to the database.";
      print "</div>";
      print "</article>";
      $count = 0;
    }

    if ($count) {
      print "<article class=\"message is-danger\">";
      print "<div class=\"message-header\">";
      print "<p>ERROR</p>";
      print "</div>";
      print "<div class=\"message-body\">";
      print "The username '".$_POST["username"]."' has already been taken.";
      print "</div>";
      print "</article>";
    }
    else if (!isset($_POST["username"])) {
      print "<article class=\"message is-danger\">";
      print "<div class=\"message-header\">";
      print "<p>ERROR</p>";
      print "</div>";
      print "<div class=\"message-body\">";
      print "Usernames must contain at least 1 character";
      print "</div>";
      print "</article>";
    }
    else {
      if (!$mysqli->query("INSERT INTO Users (user_id) VALUES ('".$mysqli->real_escape_string($_POST["username"])."')")) {
        print "<article class=\"message is-danger\">";
        print "<div class=\"message-header\">";
        print "<p>ERROR</p>";
        print "</div>";
        print "<div class=\"message-body\">";
        print "An ERROR has occured when adding the username to the database.";
        print "</div>";
        print "</article>";
      }
      else {
        print "<article class=\"message is-dark\">";
        print "<div class=\"message-header\">";
        print "<p>Welcome ".$_POST["username"]."!</p>";
        print "</div>";
        print "<div class=\"message-body\">";
        print "Your user has been created sucessfully";
        print "</div>";
        print "</article>";
      }
    }

    $mysqli->close();
    ?>
  </div>
</body>
</html>
