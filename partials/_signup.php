<?php
$err = false;
$signup = true;
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["action"] == "signup") //for user signup
{

    $usr = $_POST["username"];
    $user = strtolower($usr);
    $pass = $_POST["password"];
    $cpass = $_POST["cpass"];
    $name = $_POST["name"];

    // echo $usr;

    $sql1 = "SELECT * from `users` where `username`='$user'";
    $res1 = mysqli_query($conn, $sql1);
    $num = mysqli_num_rows($res1);

    if ($num >= 1) {
        $exists = true;
    }

    if (($pass == $cpass)) {

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        if (!$exists) {
            $sql = "INSERT INTO `users` (`username`,`name`, `password`) VALUES ('$user','$name','$hash')";
            $res = mysqli_query($conn, $sql);

            if ($res) {
                $show = true;
            }
        } else {
            $err = "User with this username already exists,please try new one";
        }
    } else {
        $err = "Password do not matches";
    }
}

?>

<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup for Summaries</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/summaries/" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="cpass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="cpass" id="cpass" required>
                    </div>
                    <input type="hidden" name="action" value="signup">

                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>
            </div>
        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
        </div> -->
    </div>
</div>
</div>