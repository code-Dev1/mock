<?php
require_once 'autoload.php';
$role = $auth->authRole('admin');
if (!$role) {
    Semej::set('danger', '', 'ادرس مورد نظر موجود نیست.');
    header('location:dashboard?page=home');
    die;
}
if (isset($_GET['userId']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = (int) $_GET['userId'];
    $user = new User();
    $user->userDelete($id);
}