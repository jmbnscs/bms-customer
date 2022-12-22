<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require '../helpers/phpmailer/src/Exception.php';
    require '../helpers/phpmailer/src/PHPMailer.php';
    require '../helpers/phpmailer/src/SMTP.php';

    if (isset($_POST['email'])) {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bill.gstech@gmail.com';
        $mail->Password = 'kqrakwidvjjmstck';
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

            // $bill_end = new DateTime($data['billing_period_end']);
            // $bill_start = new DateTime($data['billing_period_start']);

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

        // $url = DIR_API . "customer/read_single.php?account_id=" . $data['account_id'];
        // curl_setopt($ch, CURLOPT_URL, $url);
        // $resp = curl_exec($ch);
        // $customer = json_decode($resp, true);
        // curl_close($ch);

        // $date = new DateTime($data['billing_period_end']);
        // $bill_date = $date->sub(new DateInterval('P10D'));

        

        // echo $status_id;

        // if ($status_id == 1) {
        //     $mail->Subject = 'GSTech Payment Reminder for Account ID: ' . $data['account_id'];
            
        //     $mail->Body = '
        //     <p>Dear valued customer, </p>
        //     <br>
        //     <p>You only have <strong>5 days left</strong> before your due date. Please pay your bill on or before ' . $bill_end->format('F j, Y') . ' to avoid internet service interruption.</p>
        //     <br>

        //     <div style="width: 500px; padding-left: 20px;">
        //         <table  style="width: 100%;">
        //             <tr>
        //                 <td style="width: 40%;"><strong>GSTech ID:</strong></td>
        //                 <td style="width: 60%;">' . $customer['gstech_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Account Number:</strong></td>
        //                 <td style="width: 60%;">' . $data['account_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Total Amount Due:</strong></td>
        //                 <td style="width: 60%;">PHP ' . $data['running_balance'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Due Date:</strong></td>
        //                 <td style="width: 60%;">' . $bill_end->format('m/d/y') . '</td>
        //             </tr>
        //         </table>
        //     </div>
        //     <br>
        //     <p><em>For any concerns, you may call us at 09652377042 or through our Facebook page @GSTechPasig.</em></p>
        //     <p>Thank you and we appreciate your patronage!</p>

        //     <p>From,
        //     </p>

        //     <img src="cid:gstechlogo" alt="GSTech Logo" style="width: 250px; height: 80px;">
            
        //     <p style="font-size: 10px;"><br> FreeInfoMsg <br>
        //         Please Do Not Reply.</p>
        //     ';

        //     if ($mail->send()) {
        //         echo 'success';
        //     }
        //     else {
        //         echo 'fail';
        //     }
        // }
        // else if ($status_id == 2) {
        //     $mail->Subject = 'GSTech Payment Reminder for Account ID: ' . $data['account_id'];

        //     $mail->Body = '
        //     <p>Dear valued customer, </p>
        //     <br>
        //     <p>We would like to let you know that your outstanding bill is due today. You may send us a screenshot of your payment on our facebook page if payment has already been made. </p>
        //     <p>You can pay via GCash, Bank Account, or Direct Payment (Home Visit).</p>
        //     <br>

        //     <div style="width: 500px; padding-left: 20px;">
        //         <table  style="width: 100%;">
        //             <tr>
        //                 <td style="width: 40%;"><strong>GSTech ID:</strong></td>
        //                 <td style="width: 60%;">' . $customer['gstech_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Account Number:</strong></td>
        //                 <td style="width: 60%;">' . $data['account_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Total Amount Due:</strong></td>
        //                 <td style="width: 60%;">PHP ' . $data['running_balance'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Due Date:</strong></td>
        //                 <td style="width: 60%;">Today</td>
        //             </tr>
        //         </table>
        //     </div>
        //     <br>
        //     <p><em>For any concerns, you may call us at 09652377042 or through our Facebook page @GSTechPasig.</em></p>
        //     <p>Thank you and we appreciate your patronage!</p>

        //     <p>From,
        //     </p>

        //     <img src="cid:gstechlogo" alt="GSTech Logo" style="width: 250px; height: 80px;">
            
        //     <p style="font-size: 10px;"><br> FreeInfoMsg <br>
        //         Please Do Not Reply.</p>
        //     ';
        //     if ($mail->send()) {
        //         echo 'success';
        //     }
        //     else {
        //         echo 'fail';
        //     }

        // }
        // else if ($status_id == 3) {
        //     $mail->Subject = 'GSTech Temporary Disconnection Notice for Account ID: ' . $data['account_id'];

        //     $mail->Body = '
        //     <p>Dear valued customer, </p>
        //     <br>
        //     <p>To continue enjoying your internet service, please pay your bill within <strong>24 to 48 hours</strong>. Failure to do so will result in temporary internet disconnection not until the total amount due is paid. </p>
        //     <br>

        //     <div style="width: 500px; padding-left: 20px;">
        //         <table  style="width: 100%;">
        //             <tr>
        //                 <td style="width: 40%;"><strong>GSTech ID:</strong></td>
        //                 <td style="width: 60%;">' . $customer['gstech_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Account Number:</strong></td>
        //                 <td style="width: 60%;">' . $data['account_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Total Amount Due:</strong></td>
        //                 <td style="width: 60%;">PHP ' . $data['running_balance'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Due Date:</strong></td>
        //                 <td style="width: 60%;">Immediately</td>
        //             </tr>
        //         </table>
        //     </div>
        //     <br>
        //     <p><em>For any concerns, you may call us at 09652377042 or through our Facebook page @GSTechPasig.</em></p>
        //     <p>Thank you and we appreciate your patronage!</p>

        //     <p>From,
        //     </p>

        //     <img src="cid:gstechlogo" alt="GSTech Logo" style="width: 250px; height: 80px;">
            
        //     <p style="font-size: 10px;"><br> FreeInfoMsg <br>
        //         Please Do Not Reply.</p>
        //     ';
        //     if ($mail->send()) {
        //         echo 'success';
        //     }
        //     else {
        //         echo 'fail';
        //     }
        // }
        // else if ($status_id == 4) {
        //     $mail->Subject = 'GSTech Disconnection Notice for Account ID: ' . $data['account_id'];

        //     $mail->Body = '
        //     <p>Dear valued customer, </p>
        //     <br>
        //     <p>Your internet service has been temporarily restricted due to an unpaid balance. To restore the service, please pay your bill <strong>immediately</strong> either via Gcash or through our payment collectors.</p>
        //     <br>

        //     <div style="width: 500px; padding-left: 20px;">
        //         <table  style="width: 100%;">
        //             <tr>
        //                 <td style="width: 40%;"><strong>GSTech ID:</strong></td>
        //                 <td style="width: 60%;">' . $customer['gstech_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Account Number:</strong></td>
        //                 <td style="width: 60%;">' . $data['account_id'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Total Amount Due:</strong></td>
        //                 <td style="width: 60%;">PHP ' . $data['running_balance'] . '</td>
        //             </tr>
        //             <tr>
        //                 <td style="width: 40%;"><strong>Due Date:</strong></td>
        //                 <td style="width: 60%;">Immediately</td>
        //             </tr>
        //         </table>
        //     </div>
        //     <br>
        //     <p>Please keep your lines open as our representative will call you to discuss the option of reconnecting your internet. Kindly disregard this message if payment has been made. </p><br>
        //     <p><em>For any concerns, you may call us at 09652377042 or through our Facebook page @GSTechPasig.</em></p>
        //     <p>Thank you and we appreciate your patronage!</p>

        //     <p>From,
        //     </p>

        //     <img src="cid:gstechlogo" alt="GSTech Logo" style="width: 250px; height: 80px;">
            
        //     <p style="font-size: 10px;"><br> FreeInfoMsg <br>
        //         Please Do Not Reply.</p>
        //     ';
        //     if ($mail->send()) {
        //         echo 'success';
        //     }
        //     else {
        //         echo 'fail';
        //     }
        // }

        // if (isset($_POST['status_id'])) {
        //     $mail->send();

        // }

        // if ($mail->send()) {
        //     echo 'success';
        // }
        // else {
        //     echo 'fail';
        // }
    }
