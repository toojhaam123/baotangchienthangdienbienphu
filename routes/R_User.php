<?php
$userControl = new C_User();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        $errors = $userControl->register();
    } elseif (isset($_POST['login'])) {
        $errors = $userControl->login();
    } elseif (isset($_POST['edit_user'])) {
        $errors = $userControl->editUser();
    } elseif (isset($_POST['delete_users'])) {
        $userControl->deleteUser();
    } elseif (isset($_POST['changePass'])) {
        $errors = $userControl->changePass();
    } elseif (isset($_POST['change_status_user'])) {
        $userControl->changeStatus();
    }
}

$users = $userControl->viewAllUser();
