<? include("head.php");
	$search=false;
	$need_ac=false;
	$title="Избранное";
	$req="WHERE notes.note_id=f.note_id ORDER BY notes.time_add DESC";
	include("show.php");
	include("foot.php");
?>
</body>
</html>
