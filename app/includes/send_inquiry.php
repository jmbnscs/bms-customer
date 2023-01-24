<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../helpers/phpmailer/src/Exception.php';
    require '../helpers/phpmailer/src/PHPMailer.php';
    require '../helpers/phpmailer/src/SMTP.php';

    if (isset($_POST['inquire_name']) && isset($_POST['inquire_email']) && isset($_POST['inquire_subject']) && isset($_POST['inquire_message'])) {
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

        // Inquirer Details
        $name = $_POST['inquire_name'];
        $email = $_POST['inquire_email'];
        $subject = $_POST['inquire_subject'];
        $message = $_POST['inquire_message'];

        $ch = require 'curl.init.php';
        $url = DIR_API . "plan/read_active.php";
        curl_setopt($ch, CURLOPT_URL, $url);
        $resp = curl_exec($ch);
        $plan_name = json_decode($resp, true);
        curl_close($ch);

        // Request
        $mail->setFrom('bill.gstech@gmail.com');
        // Admin email
        // $mail->setFrom('bill.gstech@gmail.com');
        $mail->addAddress('bill.gstech@gmail.com');

        $mail->AddEmbeddedImage('../images/gstech-logo.jpg', 'gstechlogo');
        $mail->isHTML(true);

        $mail->Subject = $subject;
        
        $mail->Body = '
        <p>Dear Administrator, </p>
        <br>
        <p>We have received a new customer inquiry from ' . $name . '.</p>
        <p>Please wait for the customer to send their account details.</p>
        <br>

        <p>Inquirer Message: '. $message . ' </p>

        <p><em>For any concerns, you may send an email to the inquirer at ' . $email . '.</em></p>
        <p>Thank you!</p>

        <p>From,
        </p>

        <img src="cid:gstechlogo" alt="GSTech Logo" style="width: 250px; height: 80px;">
        
        <p style="font-size: 10px;"><br> FreeInfoMsg <br>
            Please Do Not Reply.</p>
        ';

        if ($mail->send()) {
            $mail->setFrom('bill.gstech@gmail.com');

            $mail->addAddress($email);

            $mail->Subject = 'GSTech: Inquiry Confirmation';

            $mail->AddEmbeddedImage('../images/gstech-logo.jpg', 'gstechlogo');
            $mail->isHTML(true);
                
            $mail->Body = '
            <p>Dear valued customer, </p>
            <br>
            <p>We have received your inquiry. Please wait for the response of our customer service.</p>
            <p>Meanwhile, if you want to subscribe to our services please reply to this email with the following information:</p>
            <br>

            <p>First Name: </p>
            <p>Middle Name: </p>
            <p>Last Name: </p>
            <p>Billing Address: </p>
            <p>Mobile Number: </p>
            <p>Birthdate: </p>
            <p>Subscription Plan: </p>

            <p> You can choose from these plans: </p>';

            foreach($plan_name as $row) {
                $mail->Body .= '<p>&emsp;' . $row['plan_name'] . ' - ' . $row['bandwidth'] . ' mbps</p>';
            }

            $mail->Body .= '
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
                echo 'fail customer message';
            }
        }
        else {
            echo 'fail admin message';
        }
    }
    else {
        echo 'fail inputs';
    }
