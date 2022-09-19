<?include("connection.php");
	if (isset($_POST["note_id"])){
	include("del.php");}
	if (isset($_SESSION["user_id"])){
		$sql_sel="SELECT notes.note_id,titles.title,notes.down_count,notes.user_id,
	notes.time_add, notes.admin_check, notes.hard,notes.comm,insts.inst_name,
	comps.comp_name,comps.comp_last,f.user_id, 
	TRIM(CONCAT(comp_name,' ',comp_last,' - ',title,hard,'.pdf')) AS file FROM 
	(notes INNER JOIN insts USING(inst_id)
	INNER JOIN comps USING(comp_id)
	INNER JOIN titles USING(title_id)
	LEFT OUTER JOIN (SELECT * FROM favourite WHERE favourite.user_id='".$_SESSION["user_id"]."') as f ON f.note_id=notes.note_id)
	$req";}
	else {
		$sql_sel="SELECT notes.note_id,titles.title,notes.down_count,notes.user_id,
	notes.time_add, notes.admin_check, notes.hard,notes.comm,insts.inst_name,
	comps.comp_name,comps.comp_last, TRIM(CONCAT(comp_name,' ',comp_last,' - ',title,hard,'.pdf')) AS file FROM 
	(notes INNER JOIN insts USING(inst_id)
	INNER JOIN comps USING(comp_id)
	INNER JOIN titles USING(title_id))
	$req";}
	$sql_res=mysqli_query($con,$sql_sel)
		or die (mysqli_error($con));
		?>
<br><br>
<div align="center">
<form class="head" onSubmit='return confirm("Вы уверены, что хотите удалить запись?");'
 method="POST" action="<?print($_SERVER["SCRIPT_NAME"]);?>" name="notes_view">
<table border="1" cellpadding="1" cellspacing="1" style="width:100%">
	<caption>
		<h1><strong><?print($title);?></strong></h1>
	</caption>
<tbody>
<?
	while($row = mysqli_fetch_array($sql_res)){
		if ($need_ac and $row["admin_check"]==0) $bgcolor="#FFA07A";
		else $bgcolor="#FAEBD7";
?>
<tr>
	<td>
	<table border="0" cellpadding="2" cellspacing="0" style="width:100%; background-color:<?print($bgcolor);?>">
		<tbody>
			<tr>
				<td style="text-align:left">
				<h2><strong><?echo "{$row['comp_name']} {$row['comp_last']} - {$row['title']}";
				if ($need_ac and $row["admin_check"]==0) print("<font color='#800000'> [На проверке]</font>");?></strong></h2>
				</td>
				<?
					if (isset($_SESSION["user_login"]) and ($_SESSION["perm"]>1)){
				?>
				<td style="text-align:center; width:100px">
				<a href='download.php?id=<?print($row["note_id"]);?>
				&old_path=<?print($_SERVER["SCRIPT_NAME"]);?>' target="_blank"><input name="download"
				type="button" value="Открыть"></a>
				<?if ($_SESSION["perm"]==4){?>
					<br><br>
					<input name="delete" type="submit" value="Удалить"/>
				<input type="hidden" name="note_id" value="<?print($row["note_id"]);?>">
				<?}?></td>
						<td style="text-align:center; width:110px">
						<?if ($row["user_id"]!=NULL){
							$n="В Избранном";
							$old="delete";
							$old_id=$row["note_id"];}
						else{
							$n="Добавить";
							$old="insert";
							$old_id=$row["note_id"];}
						?>
						<a href="f_change.php?old=<?print($old);?>&old_id=<?print($old_id)?>
						&old_path=<?print($_SERVER["SCRIPT_NAME"]);?>"><?print($n);?></a>
						</td>
						<?}?>
			</tr>
			<tr>
				<td style="text-align:left">
				<h3 style="font-style:italic"><?print($row['inst_name']);?></h3>
				</td>
				<td style="text-align:center; width:100px">Сложность: <?print($row['hard']);?>/5</td>
				<td style="text-align:center; width:110px">
				<div  data-tooltip="<?
				if ($row['comm']!=""){
echo "Скачано раз: {$row['down_count']}\nДата загрузки: {$row['time_add']} \n {$row['comm']}";
				}else{
				echo "Скачано раз: {$row['down_count']}\nДата загрузки: {$row['time_add']}";}
?>">
<font color="blue">Подробнее</font></div>
				</td>
			</tr>
		</tbody>
	</table>
	</td>
</tr>
	<?}?>
	</tbody> 
</table>
</form>
</div>
<br><br>