<?include("ses_start.php");
include("connection.php");
$sql_ins="DELETE FROM favourite WHERE user_id='".$_SESSION["user_id"]."'";
$sql_r=mysqli_query($con,$sql_ins)
	or die (mysqli_error($con));
$sql_ins="DELETE FROM users WHERE user_id='".$_SESSION["user_id"]."'";
$sql_r=mysqli_query($con,$sql_ins)
	or die (mysqli_error($con));
$sql_ins="UPDATE notes SET user_id=0 WHERE user_id='".$_SESSION["user_id"]."'";
$sql_r=mysqli_query($con,$sql_ins)
	or die (mysqli_error($con));
session_destroy();
header("Location: index.php");?>