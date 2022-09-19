<? include("head.php");
global $_FILES;
if (isset($_POST["comp_last"])){
		include("add_script.php");
}?>
<br><center>
<form method="post" enctype="multipart/form-data" name="add" action="add.php" class="form" style="width:50%">
<table align="center" border="1" cellpadding="1" cellspacing="1" style="width:100%; border: 2px solid black;">
	<caption><h1>Добавление нот</h1></caption>
	<tbody>
		<tr>
			<td style="text-align:left; width:55%">Название произведения<span style="color:#e74c3c">*</span>:</td>
			<td style="vertical-align:middle"><input name="note_id" required="required" size="15" type="text" /></td>
		</tr>
		<tr>
			<td style="text-align:left; width:50%">Имя композитора:</td>
			<td style="vertical-align:middle"><input name="comp_name" size="15" type="text" /></td>
		</tr>
		<tr>
			<td style="text-align:left; width:50%">Фамилия композитора<span style="color:#e74c3c">*</span>:<span style="font-size:18px"><br>(или псевдоним)</span></td>
			<td style="vertical-align:middle"><input maxlength="40" name="comp_last" required="required" size="15" type="text" /></td>
		</tr>
		<tr>
			<td style="text-align:left; width:50%">Инструмент<span style="color:#e74c3c">*</span>:</span></td>
			<td style="vertical-align:middle"><input maxlength="40" name="inst" required="required" size="15" type="text" /></td>
		</tr>
		<tr>
			<td style="text-align:left; width:50%">Сложность<span style="color:#e74c3c">*</span>:</td>
			<td style="text-align:center; vertical-align:middle">
			<p><input checked="checked" name="hard" type="radio" value="1" />1&nbsp;&nbsp;<input name="hard" type="radio" value="2" />2&nbsp; &nbsp;<input name="hard" type="radio" value="3" />3&nbsp; &nbsp;</p>

			<p><input name="hard" type="radio" value="4" />4&nbsp;<input name="hard" type="radio" value="5" />5</p>
			</td>
		</tr>
		<tr>
			<td style="text-align:left; width:50%">Комментарий:</td>
			<td><textarea name="com" rows="3"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center; width:50%; height:50px"><input name="file" required="required"
			accept="application/pdf" style="font-size: 20px; width: 300px;" type="file" value="Добавить файл" /></td>
		</tr>
	</tbody>
</table>
<p><input name="s" type="submit" value="Отправить" class="button" /></p>
</form></center>
<?include("foot.php");?>