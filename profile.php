<!doctype html>
<html lang="en">

<?php
    include 'partials/_navbar.php';

    $user=$_GET["user_name"];
    $sql="SELECT * FROM `users` WHERE `username`='$user'";

    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $user_id=$row["user_id"];
        $name=$row["name"];
    }

    // echo $user_id . $name;
    echo '<div class="container my-4">
    <div class="jumbotron text-center">
        <h2 class="display-5 font-weight-bold ">'.$name.'</h2>
        <hr class="my-3">
    </div>
</div>';

    echo '<div class="container fluid"><p class="lead">Summaries By '.$name.'</p></div>';
    $sql="SELECT * FROM `books` WHERE summary_by_id='$user_id'";
    $res=mysqli_query($conn,$sql);
    while ($row = mysqli_fetch_assoc($res)) 
    {
        $book_id=$row["book_id"];
        $b_name=$row["book_title"];
        $sum=$row["book_summary"];
        $like=$row["likes"];
        echo var_dump($like);
        echo '<div class="container">
        <div class="media border m-2">
        <div class="media-body p-3">
        <h5 class="mt-0 mx-2 my-2">'.$b_name.'</h5>
        <hr>
        <div class="lead mx-2 my-2">'.substr($sum,0,199).'...'.'</div>
        <a href="summary.php?book_id='.$book_id.' " class="mx-2 text-success">Read more.</a>
        <button type="button" class="btn btn-success" disabled>
        Like<span class="badge badge-light ">'.$like.'</span>
        
        </div>
        </div>
        </div>
        ';
    }
    echo '<hr>';

    echo '<div class="container fluid"><p class="lead">Summaries Liked By '.$name.'</p></div>';
    $sql="SELECT * FROM `likd` WHERE `user_id`='$user_id'";
    $res=mysqli_query($conn,$sql);
    // echo $sql;
    while ($row = mysqli_fetch_assoc($res)) 
    {
        $book_id=$row["book_id"];
        $like=$row["likes"];
        $sql2="SELECT * FROM `books` WHERE `book_id`='$book_id'";
        $res2=mysqli_query($conn,$sql2);

    while($row2=mysqli_fetch_assoc($res2))
    {
        $b_title=$row2["book_title"];
        $b_summary=$row2["book_summary"];
        $like=$row2["likes"];
    }
        echo '<div class="container">
        <div class="media border m-2">
        <div class="media-body p-3">
        <h5 class="mt-0 mx-2 my-2">'.$b_title.'</h5>
        <hr>
        <div class="lead mx-2 my-2">'.substr($b_summary,0,199).'...'.'</div>
        <a href="summary.php?book_id='.$book_id.' " class="mx-2 text-success">Read more.</a>
        <button type="button" class="btn btn-success" disabled>
        Like<span class="badge badge-light ">'.$like.'</span>
        
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
</body>

</html>