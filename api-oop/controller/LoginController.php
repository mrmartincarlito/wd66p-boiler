<?php
include "BaseController.php";

class LoginController extends BaseController
{

    public function login($username, $password)
    {
        $users = (array) $this->index(); //Select * from ..

        $response = $this->createResponse(300, "Error", "Account does not exist");

        foreach ($users as $user) {
            if ($user->data["username"] === $username) {
                if (password_verify($password, $user->data["password"])) {
                    $response = $this->createResponse(200, "Succesful", "Successful");
                    $_SESSION['logged-in-user'] = $user->data['id'];
                } else {
                    $response = $this->createResponse(300, "Error", "Password do not match");
                }
            }
        }

        return $response;
    }
}