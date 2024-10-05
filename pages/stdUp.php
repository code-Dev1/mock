<?php
$role = $auth->authRole('admin');
if(!$role){
    Semej::set('danger','','ادرس مورد نظر موجود نیست.');
    header('location:dashboard?page=home');die;
}
$std = new Student();
if (isset($_GET['stdId'])) {
    $id = (int) Sanitizer::sanitize($_GET['stdId']);
    $result = $std->single($id);
}
if (isset($_POST['submitBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = Sanitizer::sanitize($_POST['frm']);
    $std->studentUpdate($data);
}

?>
<div class="mt-2">

    <h3>آفزودن شاگرد</h3>
    <hr>
    <div class="container gx-md-5">
        <div class="gx-md-5 px-md-5">
            <div class="gx-md-5">
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF'] . '?page=stdUp&stdId=' . $id) ?>" class="mt-5"
                    method="post">
                    <input type="hidden" name="frm[studentId]" value='<?= $result->studentId ?>'>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[firstName]" value="<?= $result->firstName ?>" type="text"
                            class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">نام</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[lastName]" value="<?= $result->lastName ?>" type="text"
                            class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">تخلص</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[email]" type="text" value="<?= $result->email ?>" class="form-control rtl pe-3"
                            required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">ایمیل</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[department]" value="<?= $result->department ?>" type="text"
                            class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">دیپارتمینت</label>
                    </div>
                    <div class="mb-3 input-group ltr">
                        <input name="frm[course]" value="<?= $result->course ?>" type="text"
                            class="form-control rtl pe-3" required>
                        <label id="addon" style="width:90px" for=""
                            class=" text-light input-group-text bg-success rtl">مضمون</label>
                    </div>
                    <div class="row mt-4"><input type="submit" name="submitBtn" value="آفزودن" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>