<?php
    // DB Params
    $host = 'localhost:3307';
    $db_name = 'gstech_bms_db';
    $username = 'root';
    $password = '';
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

    $approval_id = $_GET['approval_id'];

    $query = 'SELECT uploaded_image FROM payment_approval WHERE approval_id = :approval_id';
            
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':approval_id', $approval_id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    header('Content-Type: image/png');
    echo $row['uploaded_image'];