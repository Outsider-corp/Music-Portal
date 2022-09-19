<?$o=0;
$sql_sel="SELECT * FROM (users INNER JOIN rules USING(rule_id))";
$sql=mysqli_query($con,$sql_sel)
	or die (mysqli_error($con));
while($row = mysqli_fetch_array($sql)){
	if ($row["user_id"]==$_SESSION["user_id"] or $row["user_login"]=="deleted") continue;
	$perm=$_POST["chk"][$o];
	if ($row["rule_id"]!=$perm){
		$s="UPDATE users SET rule_id='".$perm."' WHERE user_id='".$row['user_id']."'";
		$sql_r=mysqli_query($con,$s)
			or die (mysqli_error($con));
	}
	$o+=1;}
?>
<br><div class="text" align="center"><font color="green" size="5px"><b>Изменения внесены</b></div></font></tr><br>
