<?php
require("class.phpmailer.php");
function sendMail($data, $subject, $message, $content)
{
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
    $mail->Subject = $subject; // Email konu başlığı
    $mail->SetFrom("info@thegettinout.com", "TheGettinOut"); // Mail atıldığında gorulecek isim ve email (genelde yukarıdaki username kullanılır)
    $mail->AddAddress($data['mail']); // Mailin gönderileceği alıcı adres
    if ($content == 'passw')
        $contentMessage = $data['passw'];
    elseif ($content == 'verifiedCode')
        $contentMessage = $data['verifiedCode'];
    $path = 'https://www.thegettinout.com/assets/img/mailBack.jpg';
    $type = pathinfo($path, PATHINFO_EXTENSION);
    $data = file_get_contents($path);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    $body = '<!DOCTYPE HTML>
            <html>
            <head>
                <meta http-equiv="Content-Type" content="text/html charset=UTF-8" />
                <style>
                    body, html {
                        height: 100%;
                        margin: 0;
                        font-family: Arial, Helvetica, sans-serif;
                    }

                    * {
                        box-sizing: border-box;
                    }

                    .bg-image{
                        height: 100%;
                        width: 100%;
                        z-index: 0;
                        opacity: 0.8;
                    }
                    .bg-text {
                        background-color: rgb(0, 0, 0);
                        background-color: rgba(0, 0, 0, 0.4);
                        color: white;
                        font-weight: bold;
                        border: 3px solid #f1f1f1;
                        position: absolute;
                        top: 50%;
                        left: 50%;
                        transform: translate(-50%, -50%);
                        z-index: 2;
                        width: 80%;
                        padding: 20px;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <img src="' . $base64 . '" class="bg-image" alt="Background"/>
                <div class="bg-text">
                    <h1>THEGETTINOUT</h1>
                    <h2>' . $message . '</h2>
                    <h1 style="font-size:50px">' . $contentMessage . '</h1>
                </div>
                
            </body>
            </html>';
    $mail->Body = $body;
    $mail->Send();
    $mail->ClearAllRecipients();
}