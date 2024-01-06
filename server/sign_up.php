<?php
header("Access-Control-Allow-Origin: *");

if (!isset($_SESSION)) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $servername = "localhost:3306";
    $username = "root";
    $password = "root";
    $dbname = "to_do_list";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Connection failed']);
        die;
    }

    $query1 = "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';";
    $query2 = "SET time_zone = '+00:00';";

    function signup($connection)
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $stmt_check = $connection->prepare("SELECT * FROM `users` WHERE `username` = ?");
        $stmt_check->bind_param('s', $username);
        $stmt_check->execute();

        $results_check = $stmt_check->get_result();

        if ($results_check->num_rows > 0) {
            echo json_encode(['success' => false, 'message' => 'Nome utente già esistente.']);
            return;
        }

        $hashed_passwd = password_hash($password, PASSWORD_DEFAULT);

        $stmt_insert = $connection->prepare("INSERT INTO `users` (`username`, `password_hash`, `email`) VALUES (?, ?, ?)");
        $stmt_insert->bind_param('sss', $username, $hashed_passwd, $email);

        if ($stmt_insert->execute()) {
            echo json_encode(['success' => true, 'message' => 'Utente registrato con successo!']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ERRORE durante la registrazione dell\'utente.']);
        }
    }

    signup($connection);

    $connection->close();

    exit();
}
