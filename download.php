<?include("ses_start.php");
include("connection.php");
$id=$_GET["id"];
$path=$_GET["old_path"];
$sql_ins="SELECT TRIM(CONCAT(comp_name,' ',comp_last,' - ',title,hard,'.pdf')) AS file FROM (notes
 INNER JOIN comps USING(comp_id)
 INNER JOIN titles USING(title_id))
 WHERE note_id='".$id."'";
$sql_r=mysqli_query($con,$sql_ins)
	or die (mysqli_error($con));
$row=mysqli_fetch_array($sql_r);
$file="notes/".$row['file'];
if (!file_exists($file)){
	print($file);
	print("Файл не найден");}
else{
$pdf=file_get_contents($file);
$sql_ins="UPDATE notes SET down_count=down_count+1 WHERE note_id='".$id."'";
$sql_r=mysqli_query($con,$sql_ins)
	or die (mysqli_error($con));
header('Content-type:application/pdf');
header('Content-disposition: inline; filename="'.basename($file).'"');
header('content-Transfer-Encoding:binary');
header('Accept-Ranges:bytes');
echo $pdf;
}?>