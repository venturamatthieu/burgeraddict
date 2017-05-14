<?php

require 'libs/PHPMailer-5.2.23/PHPMailerAutoload.php';

//Use api https://pixabay.com/api/docs/#api_search_images
$url="https://pixabay.com/api/?key=5363541-0aad673a3c05717ae97d15384";
$url.="&q=burger&per_page=200&image_type=photo&pretty=true";

//Get data with curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);
curl_close($ch);

// Will dump a beauty json :3
$keyResult = mt_rand (1,199);
$arrayToto = json_decode($result, true);

$url = $arrayToto["hits"][$keyResult]["webformatURL"];

//Send email with this image
$sujet = 'Burger weekly';
$message = "Burger weekly !!! <br />
<strong>Could you resist to the temptation</strong><br /><br />
<img src = '".$url."'/> <br/><br />
<a href='https://burger-addict.firebaseapp.com/' >Unsubscribe</a>
";
$to = 'matteointhebox@gmail.com';
$fromName = 'Matt';
$fromEmail = 'no-reply@matthieu-ventura.net';

$mail = new PHPMailer();
$mail->SMTPDebug = 4;                               // Enable verbose debug output

$mail->Mailer = "smtp"; //Sendmail, mail
$mail->Host = 'ssl0.ovh.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;
$mail->Username = 'no-reply@matthieu-ventura.net';
$mail->Password = 'Q9B97o5931JfAqoj';
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;

$mail->setFrom($fromEmail, $fromName);
$mail->addAddress($to, $to);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $sujet;
$mail->Body    = 'dedede';//$message;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
