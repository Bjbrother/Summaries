<!doctype html>
<html lang="en">

<?php
include 'partials/_navbar.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $query = $_GET["search"];
    // echo var_dump($que);
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

    <div class="container">
        <h3 class="py-3">Results for "<?php echo $query; ?>"are... </h3>
        <?php

        $flag = 1;
        $sql = "SELECT * FROM `books` WHERE `book_summary` like '%$query%' or `book_title` like '%$query%'";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($res)) {
            $flag = 0;
            $title = $row["book_title"];
            $summary = $row["book_summary"];
            $id = $row["book_id"];
            echo '<div class="results">
        <h3><a href="summary.php?book_id=' . $id . ' " class="text-dark" >' . $title . '</a></h3>
        <p>
          ' . $summary . '
        </p><hr>';
        }

        if ($flag) {
            echo ' <div class="container my-4">
        <div class="jumbotron text-center">
            <h1 class="display-6 font-weight-bold ">No Result Found,please try again with different keyword..</h1>
            <hr class="my-5">
        </div>
    </div>';
        }

        ?>
</body>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
</body>

</html>