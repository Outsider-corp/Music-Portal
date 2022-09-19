<? include("head.php");?>
<form method="get"  name="search"> <br>
<table align="center" border="0" cellpadding="1" cellspacing="1" class="form" style="height:100%; width:75%;">
	<tbody>
		<tr style="width:25%">
			<td colspan="2"> Поиск&nbsp;
			<input name="text" size="25" type="text" value="<?if (isset($_GET['text'])) print($_GET['text']);?>"/>
			<input type=submit value="Go"></td>
			<td>Сортировка:</td>
		</tr>
		<tr>
			<td rowspan="3" style="vertical-align:middle;">Инструменты:</td>
			<td rowspan="3" style="vertical-align:middle;">
			<select name="inst" size="5">
			<option selected value="0">Все</option>
			<?include("connection.php");
			$sel=$_GET["inst"];
			if (isset($_GET["chk"])) {$seen=true;}
			else $seen=false;
			if (!$seen) {$ord="notes.time_add DESC";}
			else $ord=$_GET['chk'];
			$sql_sel="SELECT * FROM insts";
			$sql_res=mysqli_query($con,$sql_sel)
				or die (mysqli_error($con));
			while($row = mysqli_fetch_array($sql_res)){
			?>
			<option <?if ($sel==$row['inst_id']){?>selected<?}?> value="<?print($row['inst_id']);?>"><?print($row['inst_name']);?></option>
			<?}?>
			</select></td>
			<td><input name="chk" type="radio" value="notes.time_add DESC" checked />Сначала новые&nbsp; &nbsp; &nbsp; &nbsp;
			<input name="chk" type="radio" value="notes.time_add" <?if ($seen and $ord=="notes.time_add"){?> checked<?}?> />Сначала старые</td>
		</tr>
		<tr>
			<td><input name="chk" type="radio" value="notes.down_count DESC" <?if ($seen and $ord=="notes.down_count DESC"){?> checked<?}?>/>Популярные&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;
			<input name="chk" type="radio" value="notes.down_count" <?if ($seen and $ord=="notes.down_count"){?> checked<?}?>/>Непопулярные</td>
		</tr>
		<tr>
			<td><input name="chk" type="radio" value="notes.hard DESC" <?if ($seen and $ord=="notes.hard DESC"){?> checked<?}?>/>Сначала сложные&nbsp; &nbsp;
			<input name="chk" type="radio" value="notes.hard " <?if ($seen and $ord=="notes.hard "){?> checked<?}?>/>Сначала простые</td>
		</tr>
	</tbody>
</table>
</form>

<?
		$if="notes.admin_check>0";
		if ($sel!=0){
			$if.=" AND notes.inst_id=$sel";
			}
		if (isset($_GET['text']) and $_GET['text']!=""){
			$text=$_GET["text"];
			$if.=" AND (title='$text' OR comps.comp_name='$text' OR comps.comp_last='$text')";
			$search=true;}
		else $search=false;
		$need_ac=false;
		$title="Поиск";
		$req="WHERE $if ORDER BY $ord";
		include("show.php");
		include("foot.php");
	?>

</body>
</html>
