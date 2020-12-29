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