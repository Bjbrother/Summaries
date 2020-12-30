<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Summaries</title>
</head>

<body>
    <?php include 'partials/_navbar.php';

    $sub_id = $_GET['sub_id'];

    $sql = "SELECT * FROM `subjects` WHERE subject_id='$sub_id'";
    // echo $sql;
    $res = mysqli_query($conn, $sql);


    while ($row = mysqli_fetch_assoc($res)) {
        $subname = $row['subject_title'];
        $subdesc = $row['subject_description'];
    }



    ?>
    <div class="container my-4">
        <div class="jumbotron text-center">
            <h1 class="display-4 font-weight-bold "><?php echo $subname; ?></h1>
            <p class="lead "><?php echo $subdesc; ?></p>
            <hr class="my-5">
        </div>
    </div>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Book Title</th>
                </tr>
            </thead>
            <tbody>
                <!-- <tr> -->
                <?php

                $sql2 = "SELECT DISTINCT `book_title` FROM `books` WHERE book_subject_id='$sub_id'";
                // echo $sql2;
                $res2 = mysqli_query($conn, $sql2);
                // echo var_dump($res2);
                while ($row = mysqli_fetch_assoc($res2)) {
                    echo '<tr>';
                    // echo $b_t;
                    $b_t = $row['book_title'];
                    // $b_id=$row['book_id'];
                    echo '<td class="text-center"><a href="book_summary.php?b_name=' . $b_t . '">' . $b_t . '</a></td>';
                    echo '</tr>';
                }
                ?>
                <!-- </tr> -->
            </tbody>
        </table>
    </div>

    <!-- slider starts here -->

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