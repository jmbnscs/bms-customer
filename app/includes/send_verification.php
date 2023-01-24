<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../helpers/phpmailer/src/Exception.php';
    require '../helpers/phpmailer/src/PHPMailer.php';
    require '../helpers/phpmailer/src/SMTP.php';

    if (isset($_POST['email'])) {
        $ch = require 'curl.init.php';
        $url = DIR_API . "logs/get_mail_auth.php?id=1";
        curl_setopt($ch, CURLOPT_URL, $url);
        $resp = curl_exec($ch);
        $mail_data = json_decode($resp, true);
        curl_close($ch);

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $mail_data['email'];
        $mail->Password = $mail_data['password'];
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $account_id = $_POST['account_id'];
        $email = $_POST['email'];

        $random_hash = substr(md5(uniqid(rand(), true)), 6, 6); 

        $ch = require 'curl.init.php';
        $url = DIR_API . "customer/forgot_password.php";
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( 
            array (
                'account_id' => $account_id,
                'customer_password' => $random_hash 
            )));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response) {
            $mail->setFrom('bill.gstech@gmail.com');

            $mail->addAddress($email);

            $mail->AddEmbeddedImage('../images/gstech-logo.jpg', 'gstechlogo');
            $mail->isHTML(true);

            $mail->Subject = 'Forgot your password?';
                
            $mail->Body = '
            <p>Dear valued customer, </p>
            <br>
            <p>We have received your request to reset your password.</p>
            <p>Here is your access code: ' . $random_hash . ' </p>
            <p>To access your account, please login using the given access code. You will then be prompted to change your password.</p>
            <br>

            <p><em>For any concerns, you may call us at 09652377042 or through our Facebook page @GSTechPasig.</em></p>
            <p>Thank you and we appreciate your patronage!</p>

            <p>From,
            </p>

            <img src="cid:gstechlogo" alt="GSTech Logo" style="width: 250px; height: 80px;">
            
            <p style="font-size: 10px;"><br> FreeInfoMsg <br>
                Please Do Not Reply.</p>
            ';

            if ($mail->send()) {
                echo 'success';
            }
            else {
                echo 'fail';
            }
        }
    }
