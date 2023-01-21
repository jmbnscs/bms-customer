<?php
    // DB Params
    $host = 'localhost';
    $db_name = 'u575223139_pilot_bmsdb';
    $username = 'u575223139_pilot';
    $password = 'huydI:9J[';
    $conn;

    $conn = null;

    try
    {
        $conn = new PDO('mysql:host=' .$host. ';dbname=' .$db_name, $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e)
    {
        echo 'Connection Error: '.$e->getMessage();
    }
        
    if (isset($_POST['upload_submit'])) {
        $file = $_FILES['payment_file'];

        $fileName = $_FILES['payment_file']['name'];
        $fileTmpName = $_FILES['payment_file']['tmp_name'];
        $fileSize = $_FILES['payment_file']['size'];
        $fileError = $_FILES['payment_file']['error'];
        $fileType = $_FILES['payment_file']['type'];

        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowed = array ('jpg', 'jpeg', 'png');

        if (in_array(strtolower($fileExt), $allowed)) {
            if ($fileError == 0) {
                if ($fileSize < 500000) {
                    if (count($_FILES) > 0) {
                        if (is_uploaded_file($_FILES['payment_file']['tmp_name'])) {
                            $uploaded_image = file_get_contents($_FILES['payment_file']['tmp_name']);
                            $account_id = $_POST['upload_account_id'];
                            $query = "INSERT INTO payment_approval (account_id, date_uploaded, uploaded_image) VALUES(:account_id, NOW(), :uploaded_image)";
                            $stmt = $conn->prepare($query);

                            $stmt->bindParam(':account_id', $account_id);
                            $stmt->bindParam(':uploaded_image', $uploaded_image);

                            try {
                                $stmt->execute();
                                echo "<script> toastr.success('Payment uploaded successfully.') </script>";
                                
                            } catch (Exception $e) {
                                echo "<script> toastr.error(' " . $e . " ') </script>";
                            }
                        }
                    }
                }
                else {
                    echo "<script> toastr.error('File too large. Please try again') </script>";
                }
            }
            else {
                echo "<script> toastr.error('There was an error uploading your file. Please try again') </script>";
            }
        }
        else {
            echo "<script> toastr.error('File not allowed. Please try again') </script>";
        }
    }
