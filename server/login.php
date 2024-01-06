<?php
header("Access-Control-Allow-Origin: *");

$servername = "localhost:3306";
$username = "root";
$password = "root";
$dbname = "to_do_list";

$connection = new mysqli($servername, $username, $password, $dbname);

if ($connection && $connection->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Connection failed']);
    die;
}


function login($username, $password, $connection) {
    if (!isset($_SESSION)) {
        session_start();
    }

    $stmt = $connection->prepare("SELECT * FROM `users` WHERE `username` = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $results = $stmt->get_result();

    if ($results->num_rows > 0) {
        $row = $results->fetch_assoc();

        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            echo json_encode(['success' => true, 'message' => 'Login successo']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Password errata']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Utente non trovato']);
    }
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    login($username, $password, $connection);
} else {
    echo json_encode(['success' => false, 'message' => 'Richiesta di login non valida']);
}

?>
