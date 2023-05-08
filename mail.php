<?php
if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower(@$_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    // Eğer Ajax işlemi dışında dosyaya erişim sağlanırsa hata verdirelim
    die("Erişim engellendi!");
}
else{
	if (@$_POST['e-mail']!='' && @$_POST['ad']!='' && @$_POST['soyad']!='' && @$_POST['tel']!='' && @$_POST['text']!='') {

	require_once "mail/PHPMailerAutoload.php";
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPDebug = 1; 
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.yandex.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->IsHTML(true);
    $mail->SetLanguage("tr", "phpmailer/language");
    $mail->CharSet ="utf-8";
    $mail->Username = "sender@digma.com.tr"; 
    $mail->Password = "Parola1234";
    $mail->SetFrom("sender@digma.com.tr", (@$_POST['ad'].' '.@$_POST['soyad'])); // Mail attigimizda yazacak isim
    $mail->AddAddress("info@digma.com.tr"); // Maili gonderecegimiz kisi/ alici
    $mail->Subject = 'Digma Yorum ->'.@$_POST['ad'].' '.@$_POST['soyad']; // Konu basligi
    $mail->Body = @$_POST['text']."<br>".@$_POST['e-mail']."<br>".@$_POST['tel']; // Mailin icerigi
    if(!$mail->Send())
	{
		echo '1';
		exit;
	}
	echo '0';
	} else {
		 echo '2';
	}
}
?>
