<? include("head.php");
include("connection.php");
if (isset($_POST["ok"])){
	include ("perm_change.php");}
if ($_SESSION["perm"]!=4){
	echo "<br><div class='text'><font color='red' size='5px'> Доступ запрещён</font></div>";
}else{
	$sql_sel="SELECT * FROM (users INNER JOIN rules USING(rule_id))";
	$sql_res=mysqli_query($con,$sql_sel)
		or die (mysqli_error($con));
		?>
<br><br>
<div align="center">
<form class="form" method="POST" name="notes_view" onSubmit='return confirm("Вы уверены?");'>
<table border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<caption>
		<h1><strong>Привилегии</strong></h1>
	</caption>
<tbody>
	<tr>
		<td style="text-align:center; width:15%">Пользователь</td>
		<td style="text-align:center; width:15%">Нет доступа</td>
		<td style="text-align:center; width:15%">Доступ к сайту</td>
		<td style="text-align:center; width:15%">Добавление нот</td>
		<td style="text-align:center; width:15%">Права администратора</td>
	</tr>
<?$o=-1;
	while($row = mysqli_fetch_array($sql_res)){
		if ($row["user_id"]==$_SESSION["user_id"] or $row["user_login"]=="deleted") continue;
		$o++;
?>
		
		<tr>
			<td style="text-align:center; width:15%"><?print($row["user_login"]);?></td>
			<td style="text-align:center; width:15%"><input name="chk[<?print($o);?>]" value="1" type="radio" <?if ($row["rule_id"]>0) echo "checked";?> /></td>
			<td style="text-align:center; width:15%"><input name="chk[<?print($o);?>]" value="2" type="radio" <?if ($row["rule_id"]>1) echo "checked";?> /></td>
			<td style="text-align:center; width:15%"><input name="chk[<?print($o);?>]" value="3" type="radio" <?if ($row["rule_id"]>2) echo "checked";?>/></td>
			<td style="text-align:center; width:15%"><input name="chk[<?print($o);?>]" value="4" type="radio" <?if ($row["rule_id"]>3) echo "checked";?>/></td>
		</tr>
<?}?><tr>
<td colspan="5" style="text-align:center; width:50%; height:50px">
<p><input name="ok" type="submit" value="Подтвердить" /></p></td></tr></form>
<?}?>
	</tbody> 
</table>
</form>
</div>
<?include("foot.php");?>