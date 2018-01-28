<?php 
	ob_start();
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require "assets/PHPMailer/src/Exception.php";
	require "assets/PHPMailer/src/PHPMailer.php";
	require "assets/PHPMailer/src/SMTP.php";
	session_start();
if (isset($_POST['sendEmail'])) {
	$from = $_POST['email'];
	$body = $_POST['message'];

	$mail = new PHPMailer();                              // Passing `true` enables exceptions
	try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'munsayacmlj@gmail.com';                 // SMTP username
    $mail->Password = 'Headlines34';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->addReplyTo($from, 'hello');
    $mail->setFrom($from, $_SESSION['username']);
    $mail->addAddress('munsayacmlj@gmail.com', 'Mark Munsayac');     // Add a recipient

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Tesla Clothing';
    $mail->Body    = 'FROM: ' . $from . '<br>' . "<br>Username: " . $_SESSION['username'] . "<br>" .$body;
    $mail->AltBody = $body;

    if ($mail->send()) {
    	# code...
		$autoemail = new PHPMailer();
		$mail->setFrom('munsayacmlj@gmail.com', 'Admin');
		$mail->addAddress($from);
		$mail->Subject = 'Autoresponse';
		$mail->Body = 'We receieved your message. We will contact you soon.';
		$mail->send();
	    header('location: index.php?msg=sent');
	    // echo ("<script>location.href = '".ADMIN_URL."/index.php?msg=msg';</script>");
    }
  	
  	} /* try */

	catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
}
ob_end_flush();
 ?>