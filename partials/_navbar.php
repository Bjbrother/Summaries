<?php

session_start();
if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
{
  $loggedin=true;
}

include 'partials/_dbconnect.php';
include 'partials/_login.php';
include 'partials/_signup.php';

echo '<style>
.nounderline {
  text-decoration: none !important;
}
</style>';


echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">Summaries</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/summaries/index.php#write">Write</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Categories
        </a>';
        echo '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT * FROM `subjects`";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['subject_id'];
            $title = $row['subject_title'];
        
            echo '<li><a class="dropdown-item" href="books.php?sub_id='.$id.'">'.$title.'</a></li>';
        }
        
      echo ' </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php" >About</a>
      </li>
    </ul>
    <form class="d-flex"  method="GET" action="search.php">
      <input class="form-control me-2"  name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>';

    if($loggedin)
    {
      $user=$_SESSION['username'];


        echo '<a href="profile.php?user_name='.$user.'"class="mx-2 text-success nounderline">'.$_SESSION['username'].'</a>';
        echo '<a href="logout.php" class="btn btn-danger">Logout</a>';
        
    }
    else
    {
      echo '<button type="button" class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
      <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
    }
  echo '</div>
</div>
</nav>';



?>