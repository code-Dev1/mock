<?php
require_once 'autoload.php';
$role = $auth->authRole('admin');
if (!$role) {
    Semej::set('danger', '', 'ادرس مورد نظر موجود نیست.');
    header('location:dashboard?page=home');
    die;
}
if (isset($_GET['stdId'])) {
    $id = (int) Sanitizer::sanitize($_GET['stdId']);
    $std = new Student();
    $std->studentDelete($id);
}