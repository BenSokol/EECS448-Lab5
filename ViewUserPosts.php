<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 6</title>
  <link type="text/css" rel="stylesheet" href="css/style.css">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.css">
</head>
<body>
  <div class="tabs">
    <ul>
      <li><big><big><b>Lab 5</b></big></big></li>
      <li><a href="CreateUser.html">Create User</a></li>
      <li><a href="CreatePosts.html">Create Post</a></li>
      <li class="is-active"><a>Admin Home</a></li>
      <li class="navbar-end"><a href="https://github.com/BenSokol/Lab-5">
        <img class="github-image" src="img/Github-logo.png" alt="Github">
      </a></li>
    </ul>
  </div>
  <div class="container below-navbar">
    <article class="message is-dark">
      <div class="message-header">
        <p>CAUTION - The following pages contain powerful features.</p>
      </div>
      <div class="message-body">
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
    <div class="viewuserposts">
      <?php
      error_reporting(E_ALL);
      ini_set("display_errors", 1);

      $mysqli = new mysqli("mysql.eecs.ku.edu", "bsokol", 'P@$$word123', "bsokol");
      if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
      }

      if ($result = $mysqli->query("SELECT user_id FROM Users")) {
        print "<form class=\"message-box\">";
        print "<div class=\"field is-horizontal has-addons has-addons-centered\">";
        print "<div class=\"field-label is-normal\"><label class=\"label\">Select a User</label></div>";
        print "<div class=\"control is-expanded\">";
        print "<div class=\"select\">";
        print "<select name=\"username\">";
        while ($row = $result->fetch_assoc()) {
          print "<option value=".urlencode($row["user_id"]);
          if (isset($_GET['username']) && urldecode($_GET['username']) == $row["user_id"]) {
            print " selected";
          }
          print ">".$row["user_id"]."</option>";
        }
        print "</select>";
        print "</div>";
        print "</div>";
        print "<div class=\"control\">";
        print "<button type=\"submit\" class=\"button is-primary\">Submit</button>";
        print "</div>";
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

      if(isset($_GET['username'])) {
        if ($result = $mysqli->query("SELECT content FROM Posts WHERE author_id = '".$mysqli->real_escape_string(urldecode($_GET["username"]))."'")) {
          print "<div class=\"message-box\">";
          print "<table>";
          print "<div class=\"content\">";
          print "<h1>".urldecode($_GET["username"])."'s Posts</h1>";
          print "</div>";
          while ($row = $result->fetch_assoc()) {
            print "<tr><td>";
            print "<div class=\"box message-box\">";
            print "<article class=\"media\">";
            print "<div class=\"media-left\">";
            print "</div>";
            print "<div class=\"media-content\">";
            print "<div class=\"content\">";
            print "<p>";
            print nl2br($row["content"]);
            print "</p>";
            print "</div>";
            print "</div>";
            print "</article>";
            print "</div>";
            print "</tr></td>";
          }
          print "</table>";
          print "</div>";
          $result->free();
        }
      }
      $mysqli->close();
      ?>
    </div>
  </div>
</body>
</html>
