<?php

include 'partials/_dbconnect.php';
$b_id = $_GET['b_id'];
$by_id=$_GET['by_id'];
// echo $b_id . $by_id;

$sql="SELECT * FROM `likd` WHERE `user_id`='$now_id' and `book_id`='$b_id'";
$res=mysqli_query($conn,$sql);

$sql2="SELECT * FROM `books` WHERE book_id='$b_id'";
$res2=mysqli_query($conn,$sql2);

while($row=mysqli_fetch_assoc($res2))
{
  $likes=(int)($row["likes"]);
}


$r = mysqli_num_rows($res); 
// echo $r;

if($r>=1)
{
    // echo (int)$likes;
}
else
{
  $likes = $likes+1;
  // echo (int)$likes;
  $sql3="UPDATE `books` SET `likes` = '$likes' WHERE `books`.`book_id` = '$b_id'";
  $res3 = mysqli_query($conn,$sql3);

  $sql4="INSERT INTO `likd` (`user_id`, `book_id`) VALUES ('$by_id', '$b_id')";
  $res4 = mysqli_query($conn,$sql4);

}



?>