<?php
header("Access-Control-Allow-Origin: *");

function logout() {
    session_start();
    session_unset();
    session_destroy();

    echo json_encode(['success' => true, 'message' => 'Logout successo']);
}

if (isset($_POST['action']) && $_POST['action'] === 'logout') {
    logout();
} else {
    echo json_encode(['success' => false, 'message' => 'Richiesta di logout non valida']);
}
?>
