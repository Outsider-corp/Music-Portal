<?
$note_title=$_POST["title"];
$note_id = $_POST["note_id"];
$comp_last=$_POST["comp_last"];
if (isset($_POST["comp_name"])){
	$comp_name=$_POST["comp_name"];}
else{
	$comp_name="";}
$hard=$_POST["hard"];
$inst=$_POST["inst"];
$com=$_POST["com"];
$f_name_new = trim($comp_name . " " . $comp_last . " - " . $note_title . $hard . ".pdf");
$sql_main="SELECT notes.note_id,titles.title,titles.title_id,insts.inst_name,
	comps.comp_name,comps.comp_last,comps.comp_id,insts.inst_id, time_add,
	TRIM(CONCAT(comp_name,' ',comp_last,' - ',title,hard,'.pdf')) AS file
 FROM 
	(notes INNER JOIN insts USING(inst_id)
	INNER JOIN comps USING(comp_id)
	INNER JOIN titles USING(title_id)) WHERE notes.note_id='".$note_id."'";
$sql_r=mysqli_query($con,$sql_main)
	or die (mysqli_error($con));
$main=mysqli_fetch_array($sql_r);
$inst_id_new=$main['inst_id'];
$comp_id_new=$main['comp_id'];
$title_id_new=$main["title_id"];
$time_add=$main["time_add"];
$t=0;
if ($main["inst_name"]!=$inst){
	$sql_ch="DELETE FROM insts WHERE inst_id='".$main['inst_id']."'";
	$t=1;
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	$sql_ch="SELECT inst_id FROM insts WHERE inst_name='".$inst."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	if ($r=mysqli_fetch_array($sql_r)){
		$inst_id_new=$r["inst_id"];
	}else{		
		$sql_ch="INSERT INTO insts(inst_name) VALUES('".$inst."')";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
		$sql_ch="SELECT inst_id FROM insts WHERE inst_name='".$inst."'";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
		$r=mysqli_fetch_array($sql_r);
		$inst_id_new=$r["inst_id"];
			}}
if ($main["comp_name"]!=$comp_name or $main["comp_last"]!=$comp_last){
	$sql_ch="DELETE FROM comps WHERE comp_id='".$main["comp_id"]."'";
	$t=1;
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	$sql_ch="SELECT comp_id FROM comps WHERE comp_name='".$comp_name."' AND comp_last='".$comp_last."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	if ($row=mysqli_fetch_array($sql_r)){
		$comp_id_new=$row["comp_id"];
	}else{		
		$sql_ch="INSERT INTO comps(comp_name,comp_last) VALUES('".$comp_name."','".$comp_last."')";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
		$comp_id_new=$main["comp_id"];
		$sql_ch="SELECT comp_id FROM comps WHERE comp_name='".$comp_name."' AND comp_last='".$comp_last."'";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
		$r=mysqli_fetch_array($sql_r);
		$comp_id_new=$r["comp_id"];
}}
if ($main["title_id"]!=$note_title){
	$sql_ch="DELETE FROM titles WHERE title_id='".$main["title_id"]."'";
	$t=1;
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	$sql_ch="SELECT title_id FROM titles WHERE title='".$note_title."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
	if ($row=mysqli_fetch_array($sql_r)){
		$title_id_new=$row["title_id"];
	}else{		
		$sql_ch="INSERT INTO titles(title) VALUES('".$note_title."')";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
		$title_id_new=$main["title_id"];
		$sql_ch="SELECT title_id FROM titles WHERE title='".$note_title."'";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
		$r=mysqli_fetch_array($sql_r);
		$title_id_new=$r["title_id"];
}}
rename(__DIR__ . "/notes/" .$main["file"],__DIR__ . "/notes/" .$f_name_new);
if ($t==0){
	$sql="UPDATE notes SET inst_id='".$inst_id_new."', comp_id='".$comp_id_new."',
	title_id='".$title_id_new."', hard='".$hard."',admin_check=1,comm='".$com."'
	WHERE note_id='".$note_id."'";}
else{
	$sql="INSERT INTO notes(inst_id, comp_id,title_id,hard,admin_check,down_count,time_add,comm,user_id) VALUES(
	'".$inst_id_new."','".$comp_id_new."','".$title_id_new."','".$hard."',1,
	0,'".$time_add."','".$com."','".$_SESSION["user_id"]."')";
}
	$sql_r=mysqli_query($con,$sql)
		or die(mysqli_error($con));
?>
	<br><div class="text" align="center"><font color="green" size="5px"><b>Файл одобрен</b></div></font></tr><br>
