<?php
include "../config.php";

class Users extends dbObject {
    protected $dbTable = "tbl_users";
    protected $primaryKey = "id";

    protected $dbFields = array(
        "fname" => array("text", "required"),
        "lname" => array("text", "required"),
        "course_id" => array("int", "required"),
        "username" => array("text", "required"),
        "password" => array("text", "required"),
        "created_at" => array("datetime", "required"),
        "is_active" => array("int", "required")
    );
}