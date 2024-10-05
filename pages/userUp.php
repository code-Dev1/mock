<?php
$user = new User();
if (isset($_GET['userId'])) {
    $id = (int) Sanitizer::sanitize($_GET['userId']);
    $result = $user->single($id);
}
// var_dump($result);die;
if (isset($_POST['submitBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['frm']);
    $user->userUp($data);
}
$role = $user->role();
?>
<div class="mt-2">

    <h3>بروزرسانی کابر</h3>
    <hr>
    <div class="container gx-md-5">
        <div class="gx-md-5 px-md-5">
            <div class="gx-md-5">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=userUp&userId=' . $result->userId) ?>"
                    class="mt-5" method="post">
                    <input type="hidden" name="frm[userId]" value="<?= $result->userId ?>">
                    <div class="mb-3 input-group ltr">
                        <input name="frm[userName]" value="<?= $result->username ?>" type="text"
                            class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">نام کاربری</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[oldPassword]" type="text" class="form-control rtl pe-3">
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">پسورد قبلی</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[password]" type="text" class="form-control rtl pe-3">
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">پسورد جدید</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[confirmPassword]" type="text" class="form-control rtl pe-3">
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">تایید پسورد</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <select name="frm[role]" id="" class="form-control">
                            <?php foreach ($role as $row): ?>
                                <option <?= ($row == $result->role) ? 'selected' : '' ?> value="<?= $row ?>">
                                    <?= $row ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">سطح</label>
                    </div>
                    <div class="row mt-4"><input type="submit" name="submitBtn" value="آفزودن" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>