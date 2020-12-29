<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.tiny.cloud/1/uztolk6laoyuep1660614vvckmlu1qmwj0bjxjnolbskfn65/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Summaries</title>

</head>



<body>

    <?php

    include 'partials/_navbar.php';

    $b_id = $_GET["b_id"];
    // var_dump($b_id);

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $area=$_POST["summary"];
        
        $sql = "UPDATE `books` SET `book_summary` = '$area' WHERE book_id='$b_id'";
        $res = mysqli_query($conn,$sql);
        
        
        if($res)
        {
           
            echo "<script type='text/javascript'>window.top.location='index.php';</script>"; exit;
        }
        else
        {
            echo "Sorry We Can't Updated it";
            // $change=0;
        }

        // echo $change;
        
    }

   else
   {
    $sql="SELECT * FROM `books` WHERE `book_id`='$b_id'";
    // echo $sql;
    $res=mysqli_query($conn,$sql);

    $by_id = $_GET["by_id"];
    $sql2 = "SELECT * FROM `users` WHERE user_id ='$by_id'";
    $res2 = mysqli_query($conn, $sql2);
    while ($row2 = mysqli_fetch_assoc($res2)) {
        $by_name = $row2["username"];
    }

    while($row=mysqli_fetch_assoc($res))
    {
        $b_summary=$row["book_summary"];
    }

    session_start();
    if ($_SESSION["username"] == $by_name) {
        echo ' <form method="post" action="'.$_SERVER['REQUEST_URI']. '" >
    

    <div class="form-group">
        <label for="summary" class="display-6 text-center lead">Update Summary</label>
        <textarea class="form-control my-1" id="summary" name="summary">'.$b_summary.'</textarea>
    </div>
    <div class="
text-center">
        <button type="submit" class="btn btn-success my-2">Post</button>
    </div></form>';
    } else {
    }
   }


  
    
    ?>
</body>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
        toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
</script>
</body>

</html>