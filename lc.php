<?
include("head.php");
if (!isset($_SESSION["user_login"]))
{
	$success=false;
	print("<p class='error'>Вы не авторизованы!</p>");
}
else{
	$success=true;
	$user_login=$_SESSION["user_login"];
}
if($success)
{?>
<br>
<form method="post" action="exit.php">
<table style="background: #A0522D;" align="center" border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
		<?if ($_SESSION["perm"]>2){?>
			<td><a href='add.php'>
		<input name="add" type="button" value="Загрузить ноты" class="button"/></a></td><?}?>
			<td style="text-align:right;"><input type="submit" value="Выйти из аккаунта" class="button" /></td>
		<?if ($_SESSION["perm"]==4){?>
			<td><a href='admin.php'>
			<input name="add" type="button" value="Проверка" class="button"/></a></td>
			<td><a href='admin_panel.php'>
			<input name="add" type="button" value="Привилегии" class="button"/></a></td>
		<?}?>
		</tr>
	</tbody>
</table>
</form>

<?}
		$search=false;
		$need_ac=true;
		$title="Добавлено Вами";
		$req=" WHERE notes.user_id='".$_SESSION["user_id"]."' ORDER BY notes.time_add DESC";
		include("show.php");
?>
<form align="center" action="del_acc.php" onSubmit='return confirm("Вы уверены, что хотите удалить аккаунт?");'>
<p><input name="del" type="submit" value="Удалить аккаунт" /></p></form>
<?
		include("foot.php");
?>

