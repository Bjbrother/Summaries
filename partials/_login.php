<?php
$login = false;
$errlog=false;
if($_SERVER["REQUEST_METHOD"]=="POST" && $_POST["action"]=="login")
{
    $usr=$_POST["username"];
    $user=strtolower($usr);
    $pass=$_POST["password"];

    $sql = "SELECT * from users where username='$user'";
    $res=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($res);
    if($num==1)
    {
        while($row=mysqli_fetch_assoc($res))
        {
            if(password_verify($pass,$row['password'])){
                $login=true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['username']=$user;
                header("location:/summaries/index.php");
            }
            else
            {
                $errlog="Credentials are wrong";
                session_destroy();
            }
        }
    }
    else
    {
        $errlog="Username doesn't exist so please try to create an account";
    }




}
?>
<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login in Summaries</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/summaries/" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <input type="hidden" name="action" value="login">
                    <button type="submit" class="btn btn-primary">login</button>
                </form>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div> -->
        </div>
    </div>
</div>