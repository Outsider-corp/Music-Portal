<? 
$Host="localhost";
$User="root";
$Password="root";
$con = mysqli_connect($Host, $User, $Password) or die (mysqli_error());
mysqli_select_db($con,"music_portal");
mysqli_set_charset($con,"utf-8");
?>