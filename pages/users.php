<?php
$user = new User();
$role = $auth->authRole('admin');
if (!$role) {
    $id = $_SESSION['auth_user']['id'];
    $result = $user->searchUser($id);
} else {
    if (isset($_POST['searchBtn']) && !empty($_POST['search']) && $_SERVER['REQUEST_METHOD'] === "POST") {
        $data = Sanitizer::sanitize($_POST['search']);
        $result = $user->searchUser($data);
    } else {
        $result = $user->index();
    }
}
$rows = $result;
?>
<h3>لیست کابران</h3>
<hr>
<div>
    <form class="<?= ($role) ? '' : 'd-none' ?>" action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . "?page=users") ?>"
        method="post">
        <div class="input-group ltr mb-4">
            <input type="text" class="form-control rtl" name="search">
            <input type="submit" value="جستوجو" class="btn btn-success" name="searchBtn">
        </div>
    </form>
    <table class="table table-responsive ms-2">
        <thead>
            <tr>
                <th># شماره</th>
                <th>نام کاربری</th>
                <th>سطح</th>
                <th>حمل</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td>
                        <?= $row->userId ?>
                    </td>
                    <td>
                        <?= $row->username ?>
                    </td>
                    <td>
                        <?= $row->role ?>
                    </td>
                    <td>
                        <button class="btn btn-success"><a href="dashboard?page=userUp&userId=<?= $row->userId ?>"
                                class="text-light text-decoration-none"> بروزرسانی </a><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger <?= ($role) ? '' : 'd-none' ?>"><a
                                href="dashboard?page=userDel&userId=<?= $row->userId ?>"
                                class="text-light text-decoration-none"> حذف </a><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center w-100 <?= ($role) ? '' : 'd-none' ?>">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item disabled">
                    <a class="page-link">Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item active" aria-current="page">
                    <a class="page-link" href="#">2</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                </li>
            </ul>
        </nav>
    </div>