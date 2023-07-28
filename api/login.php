<?php
include "config.php";

if (isset($_POST['auth'])) { 

    $loginRequest = json_decode($_POST['auth']);
    $response = array();

    $sql = "SELECT * FROM " . TBL_USERS . " WHERE username = '" . $loginRequest->username . "'";
    $results = $connection->query($sql);

    $users = array();

    while ($row = $results->fetch_assoc()) {
        array_push($users, $row);
    }
    
    $response = createResponse(401, "Error", "Account doesn't exist");

    foreach ($users as $user) {
        //db vs sa input
        if (password_verify($loginRequest->password, $user['password'])) {
            $response = createResponse(200, "Succesful", "Successful");
            $_SESSION['logged-in-user'] = $user->id;
        } else {
            $response = createResponse(401, "Error", "Wrong Password please try again");
        }
    }


    echo json_encode($response);
}