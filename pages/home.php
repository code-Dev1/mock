<?php
$std = new Student();
$user = new User();
if (isset($_POST['submitBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['search']);
    $result = $std->index($data);
} else {
    $result = $std->index();
}
$totleStd = $std->totlestd();
$totleUser = $user->totleUser();


?>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="m-2 rounded-3">
            <div class="card shadow">
                <div class="card-header">
                    <h5>مجموع شاگردان</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="display-4"><span class="fa fa-users"></span></div>
                        <div class="display-4">
                            <?= $totleStd->totle ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="m-2 rounded-3">
            <div class="card shadow">
                <div class="card-header">
                    <h5>مجموع کاربران</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="display-4"><span class="fa fa-users"></span></div>
                        <div class="display-4">
                            <?= $totleUser->totle ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="ms-3">
<div>
    <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=home') ?>" method="POST">
        <div class="input-group ltr mb-4">
            <input type="text" name="search" class="form-control rtl">
            <input type="submit" name="submitBtn" value="جستوجو" class="btn btn-success">
        </div>
    </form>
    <table class="table table-responsive ms-2">
        <thead>
            <tr>
                <th># شماره</th>
                <th>نام کامل</th>
                <th>ایمیل</th>
                <th>دیپارتمینت</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Semej::show();
            foreach ($result as $row): ?>
                <tr>
                    <td>
                        <?= $row->studentId ?>
                    </td>
                    <td>
                        <?= $row->firstName . " " . $row->lastName ?>
                    </td>
                    <td>
                        <?= $row->email ?>
                    </td>
                    <td>
                        <?= $row->department ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>