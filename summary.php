<!doctype html>
<html lang="en">


<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>Summaries</title>

</head>

<?php
    include 'partials/_navbar.php';
    $change=0;
    $b_id=$_GET["book_id"];
    $sql="SELECT * FROM `books` WHERE book_id='$b_id'";
    $res=mysqli_query($conn,$sql);

    while($row=mysqli_fetch_assoc($res))
    {
        $b_title=$row["book_title"];
        $b_summary=$row["book_summary"];
        $by_id=$row["summary_by_id"];
        $sub_id=$row["book_subject_id"];
        $time=$row["time"];
        $like=$row["likes"];
    }

    $sql2 = "SELECT * FROM `subjects` WHERE subject_id='$sub_id'";
    $res2 = mysqli_query($conn, $sql2);

    while ($row2 = mysqli_fetch_assoc($res2)) {
        $subname = $row2['subject_title'];
    }

    $sql2= "SELECT * FROM `users` WHERE user_id ='$by_id'";
    $res2=mysqli_query($conn,$sql2);
    session_start();

    $now=$_SESSION['username'];
    while($row2=mysqli_fetch_assoc($res2))
    {
        $by_name=$row2["username"];
    }

    $sqlnow="SELECT * FROM `users` WHERE username='$now'";
    $ress=mysqli_query($conn,$sqlnow);

    while($rowq=mysqli_fetch_assoc($ress))
    {
        $now_id=$rowq["user_id"];
    }

    $sql5="SELECT * FROM `likd` WHERE `user_id`='$now_id' and `book_id`='$b_id'";
    $res5=mysqli_query($conn,$sql5);
  
    $rows=mysqli_num_rows($res5);
    if($rows>=1)
    {
        $change=1;
    }
    else
    {
        $change=0;
    }

    $logedin=0;

    if(isset($_SESSION['loggedin']) &&$_SESSION['loggedin'] == true)
    {
        $logedin=1;
    }
 
    

    // echo var_dump($now_id);

    echo '<div class="container my-4">
    <div class="jumbotron ">
        <h2 class="display-5 font-weight-bold text-center">'.$b_title.'</h2>
        <p class="display-6 font-weight-bold text-center">('.$subname.')</p>
        <hr class="my-2">
        <p class="d-inline lead text-left">By '.$by_name.'</p>
        <div class="shadow-lg p-3 mb-5 bg-grey rounded">'.$b_summary.'</div>';
        if(!$change&&$logedin)
        {
            echo '<button type="button" id="like" class="btn btn-success" onclick="ld('.$b_id.','.$now_id.')">Like</button>';
        }
            
        else
        {
            if($logedin)
            echo '<button type="button" id="like" class="btn btn-primary" onclick="ld('.$b_id.','.$now_id.')">Liked</button>';
        }

       
     
        
        if($_SESSION['username']==$by_name)
        {
            echo ' <a class="btn btn-primary" href="update.php?b_id='.$b_id.'&&by_id='.$by_id.'">Update</a>
            <a class="btn btn-danger text-center" href="delete.php?b_id='.$b_id.'&&by_id='.$by_id.'">Delete</a>';
        }
    
 echo ' </div>
</div>';
?>




<body>


</body>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
    <script>
        function ld(w,t)
        {
            
            console.log(w);
            console.log(t);
            console.log("called");
            let p=document.getElementById('count');
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
    
                }
            };
            let button=document.getElementById('like');
            if(button.innerText=="Like")
            {
                button.innerText="Liked";
                console.log(button.className);
                button.className="btn btn-primary";
                xhttp.open("GET", `like.php?b_id=${w}&&by_id=${t}`, true);
            }
            else
            {
                button.innerText="Like";
                button.className="btn btn-success";
                xhttp.open("GET", `dislike.php?b_id=${w}&&by_id=${t}`, true);
            }
            xhttp.send();
        }
        </script>
  
</body>

</html>