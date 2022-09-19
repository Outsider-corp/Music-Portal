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
	$sql_ch1="SELECT COUNT(inst_name) FROM notes
	INNER JOIN insts USING(inst_id) WHERE inst_name='".$main["inst_name"]."'";
	$sql_r=mysqli_query($con,$sql_ch1)
		or die(mysqli_error($con));
	if ($r=mysqli_fetch_array($sql_r)==1){
		$sql_ch2="UPDATE insts SET inst_name='".$inst."' WHERE inst_id='".$main["inst_id"]."'";}
	else {
		$sql_ch2="INSERT INTO insts(inst_name) VALUES('".$inst."')";
		$sql="SELECT inst_id FROM notes INNER JOIN insts USING(inst_id) WHERE inst_name='".$inst."'";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$inst_id_new=mysqli_fetch_array($sql_r);}
	$sql_r=mysqli_query($con,$sql_ch2)
		or die(mysqli_error($con));
	}
if ($main["comp_name"]!=$comp_name or $main["comp_last"]!=$comp_last){
	$sql_ch1="SELECT COUNT(comp_id) FROM notes
	INNER JOIN comps USING(comp_id) WHERE comp_name='".$comp_name."' AND comp_last='".$comp_last."'";
	$sql_r=mysqli_query($con,$sql_ch1)
		or die(mysqli_error($con));
	if ($r=mysqli_fetch_array($sql_r)==1){
		$sql_ch2="UPDATE comps SET comp_name='".$comp_name."', comp_last='".$comp_last."' 
		WHERE comp_id='".$main["comp_id"]."'";}
	else {
		$sql_ch2="INSERT INTO comps(comp_name, comp_last) VALUES('".$comp_name."','".$comp_last."')";
	$sql="SELECT comp_id FROM notes INNER JOIN comps USING(comp_id) WHERE
	comp_name='".$comp_name."' AND comp_last='".$comp_last."'";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$comp_id_new=mysqli_fetch_array($sql_r);}
	$sql_r=mysqli_query($con,$sql_ch2)
	or die(mysqli_error($con));
	}
if ($main["title"]!=$note_title){
	$sql_ch1="SELECT COUNT(title) FROM notes
	INNER JOIN titles USING(title_id) WHERE title='".$main["title"]."'";
	$sql_r=mysqli_query($con,$sql_ch1)
		or die(mysqli_error($con));
	if ($r=mysqli_fetch_array($sql_r)==1){
		$sql_ch2="UPDATE titles SET title='".$note_title."' WHERE title_id='".$main["title_id"]."'";}
	else {
	$sql_ch2="INSERT INTO titles(title) VALUES('".$note_title."')";
	$sql="SELECT title_id FROM notes INNER JOIN titles USING(title_id) WHERE title='".$note_title."'";
		$sql_r=mysqli_query($con,$sql)
			or die(mysqli_error($con));
		$title_id_new=mysqli_fetch_array($sql_r);}
	$sql_r=mysqli_query($con,$sql_ch2)
		or die(mysqli_error($con));
	}
rename(__DIR__ . "/notes/" .$main["file"],__DIR__ . "/notes/" .$f_name_new);
$sql="UPDATE notes SET inst_id='".$inst_id_new."', comp_id='".$comp_id_new."',
	title_id='".$title_id_new."', hard='".$hard."',admin_check=1,comm='".$com."'
	WHERE note_id='".$note_id."'";
$sql_r=mysqli_query($con,$sql)
		or die(mysqli_error($con));
?>
	<br><div class="text" align="center"><font color="green" size="5px"><b>Файл одобрен</b></div></font></tr><br>
