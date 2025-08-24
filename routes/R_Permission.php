<?php
$permissControl = new C_Permission();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['permissions_user'])) {
        $permissControl->permissionsUser();
    }
}

$permissions = $userControl->viewAllPermission();
