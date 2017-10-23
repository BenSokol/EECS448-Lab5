<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 6</title>
  <link type="text/css" rel="stylesheet" href="style.css">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.css">
</head>
<body>
  <div class="tabs">
    <ul>
      <li><big><big><b>Lab 5</b></big></big></li>
      <li><a href="CreateUser.html">Create User</a></li>
      <li><a href="CreatePosts.html">Create Post</a></li>
      <li><a href="AdminHome.html">Admin Home</a></li>
      <li class="navbar-end"><a href="https://github.com/BenSokol/Lab-5">
        <img class="github-image" src="/~b843s521/EECS448/Lab-5/img/gh.png" alt="Github">
      </a></li>
    </ul>
  </div>
  <div class="container below-navbar">
    <article class="message is-dark">
      <div class="message-header">
        <p>CAUTION</p>
      </div>
      <div class="message-body">
        <p>The following pages contain powerful features.</p>
        <br>
        <div class="field is-grouped">
          <p class="control">
            <a class="button" href="ViewUsers.php">View Users</a>
          </p>
          <p class="control">
            <a class="button is-link" href="ViewUserPosts.php">View Posts</a>
          </p>
          <p class="control">
            <a class="button" href="DeletePost.php">Delete Posts</a>
          </p>
        </div>
      </div>
    </article>

    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    $mysqli = new mysqli("mysql.eecs.ku.edu", "bsokol", 'P@$$word123', "bsokol");
    if ($mysqli->connect_errno) {
      printf("Connect failed: %s\n", $mysqli->connect_error);
      exit();
    }

    if (!isset($_GET['username'])) {

      if ($result = $mysqli->query("SELECT user_id FROM Users")) {
        print "<form>";
        print "<div class=\"field\">";
        print "<label class=\"label\">Select a User</label>";
        print "<div class=\"control\">";
        print "<div class=\"select\">";
        print "<select>";
        while ($row = $result->fetch_assoc()) {
          print "<option value=".$row["user_id"].">".$row["user_id"]."</option>";
        }
        print "</select>";
        print "</div>";
        print "</div>";
        print "</div>";
        print "<div class=\"control\">";
        print "<button type=\"submit\" class=\"button is-primary\">Submit</button>";
        print "</div>";
        print "</form>";
        $result->free();
      }
      else {
        print "<article class=\"message is-danger\">";
        print "<div class=\"message-header\">";
        print "<p>ERROR</p>";
        print "</div>";
        print "<div class=\"message-body\">";
        print "An ERROR has occured when accessing the database.";
        print "</div>";
        print "</article>";
      }
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
  </div>
</body>
</html>
