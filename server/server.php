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

$query1 = "SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';";
$query2 = "SET time_zone = '+00:00';";

$connection->query($query1);
$connection->query($query2);

/* ------------------------------- */

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $selectQuery = "SELECT * FROM `task`";
    $result = $connection->query($selectQuery);



    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }



    header('Content-Type: application/json');
    echo json_encode($data);
}

/* ------------------------------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $connection->begin_transaction();

    if (isset($_POST['newTodo'])) {
        $text = $_POST['newTodo'];
        $done = 0;

        $insertQuery = "INSERT INTO `task` (`text`, `done`) VALUES (?, ?)";
        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param("si", $text, $done);
      
    } elseif (isset($_POST['toggleId'])) {
        $toggleId = $_POST['toggleId'];
        $updateQuery ="UPDATE `task` SET `done` = IF(`done` = 1, 0, 1) WHERE `id` = ?";
        $stmt = $connection->prepare($updateQuery);
        $stmt->bind_param("s", $toggleId);
        $data[] = ['id' => $toggleId];
    }
    elseif (isset($_POST['deleteId'])) {
        $deleteId = $_POST['deleteId'];
        $deleteQuery = "DELETE FROM `task` WHERE `id` = ?";
        $stmt = $connection->prepare($deleteQuery);
        $stmt->bind_param("i", $deleteId);
      

        $data[] = ['id' => $deleteId];
    }
    $stmt->execute();
    
    $selectAllQuery = "SELECT * FROM `task`";
    $data = [];
    $selectAllResult = $connection->query($selectAllQuery);
    while ($row = $selectAllResult->fetch_assoc()) {
        $data[] = $row;
    }

    $connection->commit();

    $connection->close();

    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}
