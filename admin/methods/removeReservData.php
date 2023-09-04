<?php 

include_once('..\..\required/server.php');
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../PHPMailer/src/Exception.php';
require '../../PHPMailer/src/PHPMailer.php';
require '../../PHPMailer/src/SMTP.php';

$reservationData = getReservationData($_POST['controll']);

$user = getUserById($reservationData['uid']);

$controll   = $_POST['controll'];

$query = "DELETE FROM reservation where id = ".$controll."";
mysqli_query($db, $query);
 
 
$msg = '
    <h1 align="center">Welcome in Moon City Villas</h1>

<p><span style="font-size: 24px;">Your Requests Data Rejected :&nbsp;</span></p>
<table style="border-collapse: collapse; width: 100%; height: 220px;" border="1"><colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup>
<tbody>
<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
Full Name</strong></sub></span></td>
<td style="height: 22.4px;">&nbsp;'.getUserFullName($reservationData['uid']).'</td>
</tr>
 
<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
landmark</strong></sub></span></td>
<td style="height: 22.4px;">&nbsp; '.getlandmarkNameByID($reservationData['landmarkID']).' </td>
</tr>

<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
Total</strong></sub></span></td>
<td style="height: 22.4px;">&nbsp; '.$reservationData['reservIPrice'].'$ </td>
</tr>

<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
Reservation Code</strong></sub></span></td>
<td style="height: 22.4px;">&nbsp; '.$reservationData['reservCode'] .'</td>
</tr>

<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
Reservation From Date</strong></sub></span></td>
<td style="height: 22.4px;">&nbsp; '.$reservationData['reservIFrom'] .'</td>
</tr>

<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
Reservation To Date</strong></sub></span></td>
<td style="height: 22.4px;">&nbsp; '.$reservationData['reservITo'] .'</td>
</tr>

<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
Reservation Time </strong></sub></span></td>
<td style="height: 22.4px;">&nbsp; '.$reservationData['createdAt'] .'</td>
</tr>

<tr style="height: 22.4px;">
<td style="height: 22.4px; padding-left: 40px;"><span style="font-size: 18px;"><sub><strong>
Reject Time </strong></sub></span></td>
<td style="height: 22.4px;">&nbsp; '.date("Y-m-d h:i:sa") .'</td>
</tr>
 
</tbody>
</table>
<h2 align="left">Your Requests Rejected</h2>

 ';

  
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'qou.library.2021@gmail.com';                     //SMTP username
    $mail->Password   = 'vjcegrybryrirskh';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;
    //Recipients
    $mail->setFrom('qou.library.2021@gmail.com', 'Mailer');
    $mail->addAddress($user['email'], 'Joe User');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = ' Reservation Rejected ';
    $mail->Body    = $msg ;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
	} catch (Exception $e) {
	    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	}
 

?>


