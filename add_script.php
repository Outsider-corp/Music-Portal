<?include("connection.php");
$title=$_POST["note_id"];
$comp_last=$_POST["comp_last"];
if (isset($_POST["comp_name"])){
	$comp_name=$_POST["comp_name"];}
else{
	$comp_name="";}
$hard=$_POST["hard"];
$inst=$_POST["inst"];
$adm=0;
if ($_SESSION["perm"]==4) $adm=1;
$com=$_POST["com"];
$f_name_new = trim($comp_name . " " . $comp_last . " - " . $title .$hard . ".pdf");
$sql_main="SELECT notes.note_id,titles.title,notes.down_count,notes.user_id,
	notes.time_add, notes.admin_check, notes.hard,notes.comm,insts.inst_name,
	comps.comp_name,comps.comp_last,comps.comp_id,insts.inst_id FROM 
	(notes INNER JOIN insts USING(inst_id)
	INNER JOIN comps USING(comp_id)
	INNER JOIN titles USING(title_id))";
$sql_ins="SELECT * FROM ($sql_main) as main WHERE 
comp_name='".$comp_name."' AND comp_last='".$comp_last."' AND 
inst_name='".$inst."' AND hard='".$hard."' AND title='".$title."'";
$sql_r=mysqli_query($con,$sql_ins)
	or die (mysqli_error($con));
 if($row=mysqli_fetch_array($sql_r)){?>
	 <br><div class="text" align="center"><font color="red" size="5px"><b>Такой файл уже существует</b></div></font></tr><br>
 <?}else{
	$sql_ch="SELECT * FROM insts WHERE inst_name='".$inst."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	if ($row=mysqli_fetch_array($sql_r)){
		$inst_id=$row["inst_id"];
	}
	else{
		$sql="INSERT INTO insts(inst_name) VALUES('".$inst."')";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$sql="SELECT inst_id FROM insts WHERE inst_name='".$inst."'";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$inst_id=mysqli_fetch_array($sql_r)["inst_id"];	
	}
	$sql_ch="SELECT comp_id FROM comps WHERE comp_name='".$comp_name."' AND comp_last='".$comp_last."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	if ($row=mysqli_fetch_array($sql_r)){
		$comp_id=$row["comp_id"];
	}else{
		$sql="INSERT INTO comps(comp_name,comp_last) VALUES('".$comp_name."','".$comp_last."')";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$sql="SELECT comp_id FROM comps WHERE comp_name='".$comp_name."' AND comp_last='".$comp_last."'";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$comp_id=mysqli_fetch_array($sql_r)["comp_id"];
	}
	$sql_ch="SELECT title_id FROM titles WHERE title='".$title."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	if ($row=mysqli_fetch_array($sql_r)){
		$title_id=$row["title_id"];
	}else{
		$sql="INSERT INTO titles(title) VALUES('".$title."')";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$sql="SELECT title_id FROM titles WHERE title='".$title."'";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$title_id=mysqli_fetch_array($sql_r)["title_id"];
	}
	$sql="INSERT INTO notes(title_id,comp_id,inst_id,down_count,user_id,
	time_add, admin_check, hard, comm) VALUES('".$title_id."','".$comp_id."',
	'".$inst_id."',0,'".$_SESSION["user_id"]."',NOW(),'".$adm."',
	'".$hard."','".$com."')";
	$sql_r=mysqli_query($con,$sql)
		or die(mysqli_error($con));
$f_saving =__DIR__ . "/notes/" . $f_name_new;
if (move_uploaded_file($_FILES['file']['tmp_name'],$f_saving)){?>
	<br><div class="text" align="center"><font color="green" size="5px"><b>Файл успешно загружен <?if ($_SESSION["perm"]!=4){?> и поставлен на проверку<?}?></b></div></font></tr><br>
<?}else{?>
	<br><div class="text" align="center"><font color="#A52A2A"  size="5px"><b>При загрузке произошла ошибка</b></div></font></tr><br>
 <?}}?>