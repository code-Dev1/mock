<?php
$role = $auth->authRole('admin');
if(!$role){
    Semej::set('danger','','ادرس مورد نظر موجود نیست.');
    header('location:dashboard?page=home');die;
}
$user = new User();
if (isset($_POST['submitBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['frm']);
    $user->addUser($data);
}
$role = $user->role();
?>
<div class="mt-2">

    <h3>آفزودن کابر</h3>
    <hr>
    <div class="container gx-md-5">
        <div class="gx-md-5 px-md-5">
            <div class="gx-md-5">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=addUser') ?>" class="mt-5" method="post">
                    <div class="mb-3 input-group ltr">
                        <input name="frm[userName]" type="text" class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">نام کاربری</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[password]" type="text" class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">پسورد</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[confirmPassword]" type="text" class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">تایید پسورد</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <select name="frm[role]" id="" class="form-control roleSelector" required>
                            <option value="">Select Role</option>
                            <?php foreach ($role as $row): ?>
                                <option value="<?= $row ?>">
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