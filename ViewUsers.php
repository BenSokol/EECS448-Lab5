<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 5</title>
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
        <img class="github-image" src="img/gh.png" alt="Github">
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
            <a class="button is-link">View Users</a>
          </p>
          <p class="control">
            <a class="button" href="ViewUserPosts.php">View Posts</a>
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

    if ($result = $mysqli->query("SELECT user_id FROM Users")) {
      print "<div class=\"form\">";
      print "<table class=\"table is-striped\">";
      print "<thead><tr><th>Users</th><th>Total Posts</th></tr></thead>";
      print "<tbody>";
      while ($row = $result->fetch_assoc()) {
        $result_count = $mysqli->query("SELECT COUNT(author_id) FROM Posts WHERE author_id = '".$mysqli->real_escape_string($row["user_id"])."'");
        list($count) = $result_count->fetch_row();
        print "<tr><td>".$row["user_id"]."</td><td class=\"center\">".$count."</tr>";
      }
      print "</tbody>";
      print "</table>";
      print "</div>";
      $result->free();
    }

    $mysqli->close();
    ?>
  </div>
</body>
</html>
