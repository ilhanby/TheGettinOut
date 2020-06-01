<?php
require("class.phpmailer.php");
$mail = null;
$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->SMTPDebug = 1; // Hata ayıklama değişkeni: 1 = hata ve mesaj gösterir, 2 = sadece mesaj gösterir
$mail->SMTPAuth = true; //SMTP doğrulama olmalı ve bu değer değişmemeli
$mail->SMTPSecure = 'tls'; // Normal bağlantı için tls , güvenli bağlantı için ssl yazın
$mail->Host = "thegettinout.com"; // Mail sunucusunun adresi (IP de olabilir)
$mail->Port = 587; // Normal bağlantı için 587, güvenli bağlantı için 465 yazın
$mail->IsHTML(true);
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet = "utf-8";
$mail->Username = "mail@thegettinout.com"; // Gönderici adresinizin sunucudaki kullanıcı adı (e-posta adresiniz)
$mail->Password = "maillendiniz"; // Mail adresimizin sifresi
$mail->Subject = 'Web Form'; // Email konu başlığı
$mail->SetFrom($_POST['email'], $_POST['name']); // Mail atıldığında gorulecek isim ve email (genelde yukarıdaki username kullanılır)
$mail->AddAddress("info@thegettinout.com"); // Mailin gönderileceği alıcı adres

$body = "<h1 style='text-align: center;color: aqua'>WEB SİTEMİZDEN BİR MESAJ</h1><br/>";
$body .= '<div style="text-align: left;">';
$body .= '<b>İsim</b> : ' . $_REQUEST['name'] . '<br>';
$body .= '<b>E-Mail</b> : ' . $_REQUEST['email'] . '<br><hr/>';
$body .= '<b>Mesaj</b> : ' . $_REQUEST['message'] . '<br>';
$body .= '</div>';
$mail->Body = $body;// Mailin içeriği
$mail->Send();
$mail->ClearAllRecipients();