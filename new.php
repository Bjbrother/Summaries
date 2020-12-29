<?php
        include 'partials/_dbconnect.php';
        $sub_name = $_GET['sub_name'];

        $sql="SELECT * FROM `subjects` WHERE subject_title='$sub_name'";
        $res = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($res))
        {
           $id=$row['subject_id'];
        }

        $sql2="SELECT DISTINCT `book_title` FROM `books`WHERE book_subject_id='$id'";
        // echo $sql2;
        $res2 = mysqli_query($conn, $sql2);
        while($row = mysqli_fetch_assoc($res2))
        {
            $b_t=$row['book_title'];
            echo '<option value="'.$b_t.'">'.$b_t.'</option>';
        }
?>
