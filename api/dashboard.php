<?php
include "config.php";

if (isset($_GET['index'])) {
    $response = array();

    $sql = "SELECT COUNT(id) as 'total_users' FROM " . TBL_USERS . " WHERE created_by = " . $_SESSION['logged-in-user']['id'];
    $results = $connection->query($sql);

    $dashboardResults = array();

    while ($row = $results->fetch_assoc()) {
        array_push($dashboardResults, $row);
    }

    $response = createResponse(200, "Successful", "Succesful", $dashboardResults);

    echo json_encode($response);
}