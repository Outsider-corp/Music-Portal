<? include("ses_start.php");
$title="Авторизация";
$login=$_POST["login"];
if ($login=="deleted") session_destroy();
$pass=$_POST["pass"];
$err=0;
include("connection.php");
$sql_sel="SELECT * FROM users WHERE user_login='".$login."'";
$sql_res=mysqli_query($con,$sql_sel)
	or die (mysqli_error($con));
if($row = mysqli_fetch_array($sql_res)){
	if (!password_verify($pass,$row["user_pass"])){
		session_destroy();
		include("head.php");
		print("<br><div class=\"text\" ><font color=\"red\" size=\"5px\"><b>Логин или пароль введены неверно<b></font></div>");
		$err=1;
	}
	else{
	$_SESSION["user_login"]=$row["user_login"];
	$_SESSION["user_id"]=$row["user_id"];
	$_SESSION["perm"]=$row["rule_id"];
	header("Location: index.php");
	exit();}
}
else
{ 
	session_destroy();
	include("head.php");
	print("<br><div class=\"text\"><b><font color=\"red\" size=\"5px\">Пользователя не существует<b></font></div>");
	$err=1;
}
mysqli_close($con);
if ($err=1){
?>
<div align="center">
		<?
			$search=false;
			$need_ac=false;
			$title="Новинки";
			$req="WHERE notes.admin_check>0 ORDER BY notes.time_add";
			include("show.php");
			include("foot.php");
		?>
</div>
<br><br>
<?include("foot.php");?>
</body>
</html>
<?}?>