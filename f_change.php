<?include("ses_start.php");
include("connection.php");
$old=$_GET["old"];
$old_id=$_GET["old_id"];
$path=$_GET["old_path"];
if ($old=="insert"){
	$sql_ins="INSERT INTO favourite(user_id,note_id) VALUES('".$_SESSION['user_id']."','".$old_id."')";}
else if ($old=="delete"){
	$sql_ins="DELETE FROM favourite WHERE user_id='".$_SESSION["user_id"]."' AND note_id='".$old_id."'";}
$sql_r=mysqli_query($con,$sql_ins)
	or die (mysqli_error($con));
header("Location: $path");?>