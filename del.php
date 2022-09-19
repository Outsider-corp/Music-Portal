<?
$note_id = $_POST["note_id"];
$sql_main="SELECT notes.note_id,titles.title_id,
	comps.comp_id,insts.inst_id, TRIM(CONCAT(comp_name,' ',comp_last,' - ',title,hard,'.pdf')) AS file FROM 
	(notes INNER JOIN insts USING(inst_id)
	INNER JOIN comps USING(comp_id)
	INNER JOIN titles USING(title_id)) WHERE notes.note_id='".$note_id."'";
$sql_r=mysqli_query($con,$sql_main)
	or die (mysqli_error($con));
$main=mysqli_fetch_array($sql_r);
unlink(__DIR__ . "/notes/" .$main["file"]);
$sql_ch="SELECT COUNT(inst_id) AS c FROM notes WHERE inst_id='".$main["inst_id"]."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
$r_inst=mysqli_fetch_array($sql_r)["c"];
$sql_ch="SELECT COUNT(comp_id) AS c FROM notes WHERE comp_id='".$main["comp_id"]."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
$r_comp=mysqli_fetch_array($sql_r)["c"];
$sql_ch="SELECT COUNT(title_id) AS c FROM notes WHERE title_id='".$main["title_id"]."'";
	$sql_r=mysqli_query($con,$sql_ch)
		or die(mysqli_error($con));
$r_title=mysqli_fetch_array($sql_r)["c"];	
	if ($r_inst==1){
		$sql_ch="DELETE FROM insts WHERE inst_id='".$main["inst_id"]."'";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
	}
	if ($r_comp==1){
		$sql_ch="DELETE FROM comps WHERE comp_id='".$main["comp_id"]."'";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
	}
	if ($r_title==1){
		$sql_ch="DELETE FROM titles WHERE title_id='".$main["title_id"]."'";
		$sql_r=mysqli_query($con,$sql_ch)
			or die(mysqli_error($con));
	}
$sql="DELETE FROM notes WHERE note_id='".$note_id."'";
	$sql_r=mysqli_query($con,$sql)
		or die(mysqli_error($con));
$sql="DELETE FROM favourite WHERE note_id='".$note_id."'";
	$sql_r=mysqli_query($con,$sql)
		or die(mysqli_error($con));		
?>
	<br><div class="text" align="center"><font color="green" size="5px"><b>Файл Удалён</b></div></font></tr><br>
