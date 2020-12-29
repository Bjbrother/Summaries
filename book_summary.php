<!doctype html>
<html lang="en">

<?php
    include 'partials/_navbar.php';

    $b_title=$_GET["b_name"];
    $sql="SELECT * FROM `books` WHERE book_title='$b_title' ORDER BY `likes` DESC";
    // echo $sql;
    $res=mysqli_query($conn,$sql);
    // echo var_dump($res);
  
    echo '<div class="container my-4">
    <div class="container fluid jumbotron text-center">
        <h2 class="display-4 font-weight-bold ">'.$b_title.'</h2>
        <hr class="my-5">
    </div>
</div>';
while ($row = mysqli_fetch_assoc($res)) 
{
    $book_id=$row["book_id"];
    // echo $book_id;
    $by_id=$row["summary_by_id"];
    $like=$row["likes"];
    $sum=$row["book_summary"];
    $sql2= "SELECT * FROM `users` WHERE user_id ='$by_id'";
    $res2=mysqli_query($conn,$sql2);
    while($row2=mysqli_fetch_assoc($res2))
    {
        $by_name=$row2["username"];
    }
   echo ' <div class="container">
   <div class="media border m-2">
<div class="media-body p-3">
  <a href="profile.php?user_name='.$by_name.'" class="mt-0 mx-2 my-2 h4 text-dark nounderline">'.$by_name.'</a>
  <hr>
  <div class="lead mx-2 my-2">'.substr($sum,0,199).'...'.'</div>
  <a href="summary.php?book_id='.$book_id.' " class="mx-2 text-success">Read more.</a>
  <button type="button" class="btn btn-success text-right" disabled>
  Like<span class="badge badge-light ">'.$like.'</span>
</button>
  
</div>
</div>
</div>
';
}


?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Summaries</title>

</head>



<body>


</body>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>

