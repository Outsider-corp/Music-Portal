<?include("head.php");
$title="Регистрация";
$success=false;
$message="";?><br><?
if (!isset($_POST['type'])){
$_POST['type']=0;}
$type = $_POST['type'];
if (!isset($_SESSION["login"])){
	include("connection.php");
	
	if ($type==1)
	{
		$login = $_POST["login"];
		$pass = $_POST["pass"];
		$email = $_POST["email"];
		$pass2 = $_POST["pass2"];
		if ($pass!=$pass2)
		{
			$message="<div class='text'><font color='red' size='5px'> Пароли не совападают</font></div>";
		}
		else
		{
			$sql1="SELECT user_login FROM users WHERE user_login='".$login."'";
			$sql2="SELECT user_mail FROM users WHERE user_mail='".$email."'";
			$sql_res1=mysqli_query($con,$sql1)
				or die(mysqli_error($con));
			$sql_res2=mysqli_query($con,$sql2)
				or die(mysqli_error($con));
			if ($row=mysqli_fetch_array($sql_res1))
			{
				$message="<div class='text'><font color='red' size='5px'> Это имя пользователя уже занято</font></div>";
			}
			else if ($row=mysqli_fetch_array($sql_res2))
			{
				$message="<div class='text'><font color='red' size='5px'> Этот Email уже используется</font></div>";
			}
			else  if(preg_match("|^[0-9a-z_]+@[0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email)!=1){
				$message="<div class='text'><font color='red' size='5px'> Неверный формат Email</font></div>";
			}
			else{
				$pass_h=password_hash($pass,PASSWORD_BCRYPT);
				$sql="INSERT INTO users (user_login, user_pass, user_mail) VALUES ('$login','$pass_h','$email')";
				$result1=mysqli_query($con,$sql)
					or die(mysqli_error($con));
				$message="<div class='text'><font color='green' size='5px'> Регистрация успешно завершена </font><br><font color='blue'>Войдите в свой аккаунт</font></div>";
				$success=true;
			}
		}
}
print $message;
if (!$success)
{?>
<br>
<form action="reg.php" method=post>
	<table class="menureg" cellpadding="1" cellspacing="1">
		<tr>
			<td>Имя пользователя:</td>
			<td><input type=text name="login" required> </td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type=text name="email" required> </td>
		</tr>
		<tr>
			<td>Пароль:</td>
			<td><input type=password name="pass" required> </td>
		</tr>
		<tr>
			<td>Повторите пароль:</td>
			<td><input type=password name="pass2" required> </td>
		</tr>
		<tr>
			<td colspan="2">
				<input type=submit value="Зарегистрироваться"></tr>
			</td>
	</table>
	<input type=hidden value=1 name="type">
</form>
	<? mysqli_close($con);
	}
	include("foot.php");}
	else{
		$message1="<p align='center'>Необходимо выйти из текущего аккаунта, чтобы зарегистрировать другой</p>";
		include("head.php");
		print $message1;
		include("foot.php");
	}?>
