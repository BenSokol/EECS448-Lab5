<html>
<head>
  <title>EECS 448 - Lab 5 - Exercise 7</title>
  <link type="text/css" rel="stylesheet" href="css/style.css">
  <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.css">
  <script type="text/javascript" src="js/DeletePost.js" defer></script>
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
  <div class="container below-navbar padding-bottom">
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
            <a class="button" href="ViewUserPosts.php">View Posts</a>
          </p>
          <p class="control">
            <a class="button is-link" href="DeletePost.php">Delete Posts</a>
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

    print "<div class=\"message-box\">";
    if (isset($_POST['posts'])) {
      print "<article class=\"message is-danger\">";
      print "<div class=\"message-header\">";
      print "<p>Posts Deleted</p>";
      print "<button class=\"delete delete-message-button\"></button>";
      print "</div>";
      print "<div class=\"message-body\">";

      print "Deleted post";
      $posts = $_POST['posts'];
      if(!sort($posts)) {
        $posts = $_POST['posts'];
      }
      if(sizeof($posts) > 1) {
        print "s";
      }
      print " ";
      for($i = 0; $i < sizeof($posts); $i++) {
        $mysqli->query("DELETE FROM Posts WHERE post_id='".$posts[$i]."'");
        print $posts[$i];
        print ($i < (sizeof($posts) - 1) ? ($i == (sizeof($posts) - 2) ? " and " : ", ") : ".");
      }
      print "</div>";
      print "</article>";
    }
    print "</div>";

    if ($result = $mysqli->query("SELECT post_id, content, author_id FROM Posts ORDER by author_id")) {
      print "<form method=\"POST\">";
      print "<table class=\"table is-hoverable\">";
      print "<thead><tr><th>Author</th><th>Post</th><th>Delete?</th></tr></thead>";
      print "<tbody>";
      while ($row = $result->fetch_assoc()) {
        print "<tr>";
        print "<td>".$row["author_id"]."</td>";
        print "<td>".nl2br($row["content"])."</td>";
        print "<td class=\"center\"><input type=\"checkbox\" name=\"posts[]\" value=\"".$row["post_id"]."\">";
        print "</tr>";
      }
      print "</tbody>";
      print "</table>";
      print "<div class=\"center-button\">";
      print "<div class=\"field is-grouped\">";
      print "<p class=\"control\"><button type=\"submit\" class=\"button is-danger is-outlined\">Delete</button></p>";
      print "<p class=\"control\"><button type=\"reset\" class=\"button is-link is-outlined\">Reset</button></p>";
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

    $mysqli->close();
    ?>

  </div>
</body>
</html>
