<? include("ses_start.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 4.01 Transitional//EN" 
"http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Outside.notes</title>
	<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body background="back.jpg">
	<fieldset>
		<table border="0" align="right" width="100%" height="100%">
			<tr>
				<td>
					<form action="login.php" method="post">
						<table bgcolor="#D2B48C" width="100%" height="100%" border="0">
							<?
								$cl="black";
								if (isset($_SESSION["user_login"]))
								{
									if ($_SESSION["perm"]==4) $cl="green";
									print "<td><font color=".$cl." size=\"+3\"><b><center>".$_SESSION["user_login"]."</font></b></center></font></td>";
								}
								else{
							?>
						<tr>
							<td align="right">Логин:</td>
							<td align="left"><input type=text style="width:60; height:20;" name="login"></td>
						</tr>
						<tr>
							<td align="right">Пароль:</td>
							<td align="left"><input type=password style="width:60; height:20;" name="pass"></td>
						</tr>
						<tr><td colspan="2" align="center">
							<input type=submit value="Войти" style="height:20;"></td>
						</tr>
						<tr>
							<td colspan="2"></td>
						</tr> <?}?>
						</table>
					</form>
				</td>
				<? 
				if ($_SERVER["PHP_SELF"]=="/index.php" or $_SERVER["PHP_SELF"]=="" or $_SERVER["PHP_SELF"]=="/login.php")
					$bgcol1="#DEB887";
				else $bgcol1="#FFFFF0";
				if ($_SERVER["PHP_SELF"]=="/search.php")
					$bgcol2="#DEB887";
				else $bgcol2="#FFFFF0";
				if ($_SERVER["PHP_SELF"]=="/fav.php")
					$bgcol3="#DEB887";
				else $bgcol3="#FFFFF0";
				?>
				<td colspan="3" align="center" bgcolor="#FFFFF0" width="100%" height="100%">
					<font face="Georgia" size="+3" color="black"><b>Музыкальный портал Outside.notes </b></font>
				</td>
			</tr>
			<?$log=false;
			if (isset($_SESSION["user_login"]))
			{$log=true;
				?>
				<tr>
					<td align="center" bgcolor="#D2B48C" width="20%">
					<a href="lc.php"><b>Личный кабинет</b></a>
					</td>
			<?}
			else{
			?>
				<tr>
					<td align="center" bgcolor="#D2B48C" width="20%">
					<a href="reg.php"><b>Регистрация</b></a>
					</td>
			<?}?>
			<td align="center" bgcolor=<?print($bgcol1);?> width="20%">
				<a href="index.php"><b>Главная</b></a>
			</td>
			<td align="center" bgcolor=<?print($bgcol2);?> width="20%">
				<a href="search.php"><b>Поиск</b></a>
			</td>
			<?if ($log){?>
			<td align="center" bgcolor=<?print($bgcol3);?> width="20%">
				<a href="fav.php"><b>Избранное</b></a>
			</td>
			<?}
			else{?>
			<td align="center" bgcolor=<?print($bgcol3);?> width="20%">
			<b></b>
			</td>
			<?}?>
			</tr>
		 </table>
	</fieldset>