<?php
include 'partials/_dbconnect.php';
$b_id=$_GET["b_id"];
// echo $b_id;
$sql = "DELETE FROM `books`  WHERE book_id='$b_id'";
// echo var_dump($sql);
$res = mysqli_query($conn,$sql);
$aff = mysqli_affected_rows($conn);
// echo $aff;
$sql4="DELETE FROM `likd` WHERE `user_id`='$by_id' and `book_id`='$b_id'";
$res4 = mysqli_query($conn,$sql4);

if($res)
{
    echo "<script type='text/javascript'>window.top.location='index.php';</script>"; exit;
}
else
{
    echo "nusxs";
}

?>
