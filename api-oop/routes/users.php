<?php
include "../models/Users.php";
include "../controller/UserController.php";

$userModel = new Users();
$userController = new UserController($userModel);

if (isset($_GET['test'])) {
    $list = Users::where("lname", "Sean Knapp")
    ->orWhere("username", "test")
    ->get();
    echo json_encode($list);
}


if (isset($_GET['index'])) 
{
    $records = (array) $userController->index();

    $list = array();
    foreach ($records as $record) {
        $list[] = $record->data;
    }

    $response = $userController->createResponse(200, "Successful", "Succesful", $list);

    echo json_encode($response);
}


if (isset($_GET['show'])) {
    $request = json_decode($_GET['show']);
    $record = $userController->show($request->id);
    $list[0] = $record->data;
    $response = $userController->createResponse(200, "Successful", "Succesful", $list);

    echo json_encode($response);
}

if (isset($_POST['update'])) {
    $request = json_decode($_POST['update']);

    $isUpdated = $userController->update($request->id, $request->record);

    $response = $userController->createResponse(200, "Successful", "Succesfully Updated");

    echo json_encode($response);
}

if (isset($_POST['destroy'])) {
    $request = json_decode($_POST['destroy']);

    $isDestroy = $userController->destroy($request->id);

    $response = $userController->createResponse(200, "Successful", "Succesfully Deleted");

    echo json_encode($response);
}

if (isset($_POST['store'])) {
    $registerRequest = json_decode($_POST['store']);
    $response = array();

    if ($registerRequest->password != $registerRequest->confirmPassword) {
        $response = $userController->createResponse(401, "Error", "Password does not match");
    } else {
        $password = password_hash($registerRequest->password, PASSWORD_DEFAULT);

        $user = new Users();
        $user->fname = $registerRequest->fname;
        $user->lname = $registerRequest->lname;
        $user->course_id = 1;
        $user->username = $registerRequest->username;
        $user->password = $password;
        $user->is_active = 1;
        $user->created_at = date('Y-m-d hh:mm');

        $id = $userController->store($user);
        /*
        Checking of errors
        print_r($user->errors);
        return;*/
        if ($id) {
            $response = $userController->createResponse(200, "Successful", "Successfully Saved");
        } else {
            $response = $userController->createResponse(300, "Error", "Error while saving user");
        }
    }

    echo json_encode($response);
}