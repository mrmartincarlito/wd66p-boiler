<?php
include "config.php";

if (isset($_POST['auth'])) {

    $loginRequest = json_decode($_POST['auth']);
    $response = array();

    $database->where("username", $loginRequest->username);
    $user = $database->getOne(TBL_USERS);

    if (empty($user)) {
        $response = createResponse(401, "Error", "Account doesn't exist");
    } else {
        if (password_verify($loginRequest->password, $user['password'])) {
            $response = createResponse(200, "Succesful", "Successful");
            $_SESSION['logged-in-user'] = $user['id'];
        } else {
            $response = createResponse(401, "Error", "Wrong Password please try again");
        }
    }

    echo json_encode($response);
}