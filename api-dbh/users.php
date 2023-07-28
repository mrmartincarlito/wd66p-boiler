<?php
include "config.php";

if (isset($_GET['index'])) {
    $records = $database->get(TBL_USERS);
    $length = count($records);
    $response = createResponse(200, "Successful", "Succesful", $records);

    echo json_encode($response);
}

if (isset($_GET['show'])) {
    $request = json_decode($_GET['show']);

    $database->where("id", $request->id);
    $records = $database->get(TBL_USERS);
    $response = createResponse(200, "Successful", "Succesful", $records);

    echo json_encode($response);
}

if (isset($_POST['store'])) {
    $registerRequest = json_decode($_POST['store']);
    $response = array();

    if ($registerRequest->password != $registerRequest->confirmPassword) {
        $response = createResponse(401, "Error", "Password does not match");
    } else {
        $password = password_hash($registerRequest->password, PASSWORD_DEFAULT);

        $data = array(
            "fname" => $registerRequest->fname,
            "lname" => $registerRequest->lname,
            "course_id" => 1,
            "username" => $registerRequest->username,
            "password" => $password,
            "is_active" => 1
        );

        $id = $database->insert(TBL_USERS, $data);

        if ($id) {
            $response = createResponse(200, "Successful", "Successfully Saved");
        } else {
            $response = createResponse(300, "Error", "Error while saving user");
        }
    }

    echo json_encode($response);
}

if (isset($_POST['update'])) {
    $request = json_decode($_POST['update']);

    $data = array(
        "fname" => $request->record->fname,
        "lname" => $request->record->lname,
        "username" => $request->record->username
    );

    $database->where("id", $request->id);
    $id = $database->update(TBL_USERS, $data);
    if ($id) {
        $response = createResponse(200, "Successful", "Successfully updated");
    } else {
        $response = createResponse(300, "Error", "Error while updating user");
    }

    echo json_encode($response);
}

if (isset($_POST['destroy'])) {
    $request = json_decode($_POST['destroy']);

    $database->where("id", $request->id);
    $isDeleted = $database->delete(TBL_USERS);

    $response = array();

    if ($isDeleted) {
        $response = createResponse(200, "Successful", "Successfully Deleted");
    } else {
        $response = createResponse(300, "Error", "Error while deleting user");
    }

    echo json_encode($response);
}