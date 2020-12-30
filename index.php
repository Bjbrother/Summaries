<?php

session_start();
$added = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $b_title = $_POST["book"];
    $sub_title = $_POST["sub"];
    $sum = $_POST["summary"];
    $by_name = $_SESSION["username"];

    $sql = "SELECT * FROM `users` WHERE username='$by_name'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $by_id = $row["user_id"];
    }

    $summ = str_replace("'", '"', $sum);


    $sql = "SELECT * FROM `subjects` WHERE subject_title='$sub_title'";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $sub_id = $row["subject_id"];
    }

    $sql2 = "INSERT INTO `books` (`book_title`, `book_subject_id`, `summary_by_id`, `book_summary`,`likes`, `time`) VALUES ( '$b_title', '$sub_id', '$by_id', '$summ','0', current_timestamp());";
    $res2 = mysqli_query($conn, $sql2);

    if ($res2) {
        $added = true;
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!DOCTYPE html>
    <script src="https://cdn.tiny.cloud/1/uztolk6laoyuep1660614vvckmlu1qmwj0bjxjnolbskfn65/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <title>Summaries</title>

</head>

<body>

    <?php include 'partials/_navbar.php' ?>
    <!-- slider starts here -->




    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/first.jpeg" class=" d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/second.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="img/third.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </a>
    </div>

    <?php

    if ($err) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> ' . $err .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    if ($show) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You account created successfully.Now you can login.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    ?>

    <?php

    if ($errlog) {
        echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> ' . $errlog .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    if ($login) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are successfully logged in.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }

    if ($added) {
        echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> book summary added successfully..
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    ?>

    <div class="container my-3">
        <h2 class="text-center my-3">Browse subject</h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM `subjects`";
            $res = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['subject_id'];
                $title = $row['subject_title'];
                $desc = $row['subject_description'];

                echo ' <div class="col-md-4 my-2">
              <div class="card" style="width: 18rem;">
                  <img src="img/' . $title . '.jpeg" class="img-fluid" alt="...">
                  <div class="card-body">
                      <h5 class="card-title">' . $title . '</h5>
                      <p class="card-text">' . $desc . '</p>
                      <a href="books.php?sub_id=' . $id . '" class="btn btn-success">Deep Dive</a>
                  </div>
              </div>
          </div>';
            }

            ?>
        </div>

    </div>
    <div class="container lead text-center" id="write">Want to Write A summary on a book?</div>
    <?php

    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
        echo '<h4 class="container lead text-center">Please First Login to Write A summary..</h4>';
    } else {
        echo '<div class="container my-2 ">
        <form method="post" action="index.php" >

            <div class="form-group my-1">
                <label for="bsub">Book Subject</label>
                <select class="form-control my-1" id="bsub" name="sub" onchange="populate(`bsub`,`bname`)">
                   
                  <option value=""></option>';

        $sql = "SELECT * FROM `subjects`";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $title = $row['subject_title'];

            echo '<option  value="' . $title . '">' . $title . '</option>';
        }
        echo  '</select>
            </div>';
        echo '
            <div class="form-group">
                <label for="bname">Book Name</label>
                <select class="form-control my-1" id="bname" name="book">
                </select>

            </div>

            <div class="form-group">
                <label for="summary">Book Summary</label>
                <textarea class="form-control my-1" id="summary" name="summary" rows="12" placeholder="write here.."></textarea>
            </div>
            <div class="
   text-center">
                <button type="submit" class="btn btn-success my-2">Post</button>
            </div>

        </form>
    </div>';
    }

    ?>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>


    <script>
        function populate(t, u) {

            let s1 = document.getElementById(t);
            let s2 = document.getElementById(u);
            let p = document.getElementById('hell');
            let w = s1.value;

            console.log(w);
            console.log('called');
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    s2.innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", `new.php?sub_name=${w}`, true);
            xhttp.send();
        }
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


    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>