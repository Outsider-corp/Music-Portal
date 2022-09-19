<? include("head.php");
include("connection.php");
if (isset($_POST["but"])){
	if ($_POST['but']<>0){
	include ("appr.php");}
else{
	include ("del.php");}}
if ($_SESSION["perm"]!=4){
	echo "<br><div class='text'><font color='red' size='5px'> Доступ запрещён</font></div>";
}else{
	$sql_sel="SELECT notes.note_id,titles.title,notes.user_id,
	notes.time_add, notes.admin_check, notes.hard,notes.comm,insts.inst_name,
	comps.comp_name,comps.comp_last,users.user_login,
	TRIM(CONCAT(comp_name,' ',comp_last,' - ',title,hard,'.pdf')) AS file FROM 
	(notes INNER JOIN insts USING(inst_id)
	INNER JOIN comps USING(comp_id)
	INNER JOIN users USING(user_id)
	INNER JOIN titles USING(title_id))
	ORDER BY notes.time_add";
	$sql_res=mysqli_query($con,$sql_sel)
		or die (mysqli_error($con));
		?>
<br><br>
<div align="center">
<?
	while($row = mysqli_fetch_array($sql_res))
		if ($row["admin_check"]==0) {$bgcolor="#FFA07A";
?>
<form class="head" method="POST" name="notes_view" action="admin.php">
<table border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<caption>
		<h1><strong>На проверке</strong></h1>
	</caption>
<tbody>
<tr>
<table align="center" border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td style="text-align:center; vertical-align:middle; width:25px">
			<p>Номер</p>

			<p><?print($row["note_id"]);?></p>
			<input type="hidden" name="note_id" value="<?print($row["note_id"]);?>">
			</td>
			<td style="text-align:center;">
			<p>Название</p>

			<p><input name="title" required="required" size="15" type="text" value="<?print($row["title"]);?>"/></p>
			</td>
			<td style="text-align:center;">
			<p>Фамилия автора</p>

			<p><input name="comp_last" required="required" size="10" type="text" value="<?print($row["comp_last"]);?>"/></p>
			</td>
			<td style="text-align:center;">
			<p>Имя автора</p>

			<p><input name="comp_name" size="10" type="text" value="<?print($row["comp_name"]);?>"/></p>
			</td>
			<td style="text-align:center;">
			<p><?print($row["file"]);?></p>
			<p><a href='download.php?id=<?print($row["note_id"]);?>
				&old_path=<?print($_SERVER["SCRIPT_NAME"]);?>' target="_blank">
				<button name="file" type="button" class="button"/>Открыть</button></p>
			</td>
		</tr>
		<tr>
			<td style="text-align:center; vertical-align:middle; width:25px">
			<p>Сложность</p>

			<p><select name="hard" required="required" size="1">
			<?for ($i=1;$i<6;$i++){
				$ch="";
				if ($i==$row["hard"]) $ch="selected";
			?>
			<option <?echo "$ch";?> value="<?print($i);?>"><?print($i);?></option><?}?>
			</select></p>
			</td>
			<td style="text-align:center;">
			<p>Комментарий</p>

			<p><textarea name="com" rows="4" value="<?print($row["comm"]);?>"></textarea></p>
			</td>
			<td style="text-align:center;">
			<p>Инструмент</p>

			<p><input name="inst" required="required" size="8" type="text" value="<?print($row["inst_name"]);?>"/></p>
			</td>
			<td style="text-align:center;">
			<p>Время загрузки</p>

			<p><?print($row["time_add"]);?></p>
			<p>Загрузил</p>
			<p><?print($row["user_login"]);?></p>
			</td>
			<td style="text-align:center;">
			<p><button name="but" type="submit" value=1< class="button">Одобрить</button></p>

			<p><button name="but" type="submit" value=0 class="button">Отклонить</button></p>
			</td>
		</tr>
	</tbody>
</table>
<p>&nbsp;</p>
</tr>
	</tbody> 
</table>
</form>	<?}}?>
</div>
<?include("foot.php");?>