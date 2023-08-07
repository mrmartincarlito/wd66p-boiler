<?php
include "../models/Users.php";
include "../controller/LoginController.php";

//Routes for login
// /api-oop/auth using POST method
$userModel = new Users();
$loginController = new LoginController($userModel);

if (isset($_POST['auth']))
{
    $loginCredentials = json_decode($_POST["auth"]);
    $result = $loginController->login($loginCredentials->username, $loginCredentials->password);

    echo json_encode($result);
}