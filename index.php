<? include("head.php");
	$search=false;
	$need_ac=false;
	$title="Новинки";
	$req="WHERE notes.admin_check>0 ORDER BY notes.time_add DESC";
	include("show.php");
	include("foot.php");
?>
</body>
</html>
