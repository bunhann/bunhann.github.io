
<?php
require 'phpmailer/PHPMailerAutoload.php';
require 'FirePHPCore/fb.php';


date_default_timezone_set('Asia/Phnom_Penh');



if(isset($_POST)){

    $mail = new PHPMailer;
    $console = new FB;

    $mail->isSMTP();
    $mail->Host='smtp.gmail.com';
    $mail->SMTPAuth=true;
    $mail->SMTPDebug =0;
    $mail->Username='bunhann.ads@gmail.com';
    $mail->Password='Bunh@nn2011';
    $mail->SMTPSecure='tls';
    $mail->Port=587;
    $mail->Priority=1;
    $mail->CharSet='UTF-8';
    $mail->Encoding='8bit';


    $to='bunhann@gmail.com';
    $email=$_POST['user_email'];
    $subject='Contact Name: ' . $_POST['user_name'];
    $message=$_POST['user_msg'];
    $headers='From: '.$email;

    $mail->From =$email;
    $mail->FromName=$_POST['user_name'];
    $mail->addAddress($to);
    $mail->isHTML(true);

    $mail->Subject=$subject;
    $mail->Body = $headers .'<br/><br/>' . $message;
    $mail->AltBody = $headers.$message;

    $mail->send();
    $mail->smtpClose();
    //$mail_send=mail($to, $subject, $message, $headers);
        if ($mail->isError()){
            //$console->error($mail->ErrorInfo);
            $response = json_encode(array('error'=>'<br/> Email cannot be send.'));
            $response = json_encode(array('error'=>$mail->ErrorInfo));
            echo $response;
        }else{
            $response = json_encode(array('error'=>'work'));
            echo $response;

        }
}else{
    $response = json_encode(array('error'=>'<br/> Email cannot be send.'));
    echo $response;
}
?>
