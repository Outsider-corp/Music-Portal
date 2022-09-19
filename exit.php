<?session_name("log");
session_start();
session_unset();
unset($_SESSION['user_login']);
session_destroy();
header("Location: index.php");
exit();
?>