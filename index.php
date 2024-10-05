<?php
require_once 'autoload.php';
if (isset($_SESSION['auth_token'])) {
  $auth = new Auth();
  if (!$auth->validateToken()) {
    $auth->logout();
    header("Location:index");
    die;
  } else {
    header('location:dashboard');
    die;
  }
} elseif (isset($_POST['submitBtn']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = Sanitizer::sanitize($_POST['frm']);
  $auth = new Auth();
  $auth->login($data);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="assets/css/bootstrap.css" />
  <!-- <link rel="stylesheet" href="assets/css/style.css" /> -->
</head>

<body>
  <section>
    <div class="d-flex vh-100">
      <div class="col bg-white col-lg-4 col-md-6 col-sm-12">
        <div class="display-3 text-success font-monospace ita text-center mt-5 pt-5">MOCK</div>
        <div class="d-flex justify-content-center align-items-center" style="height: 60%;">
          <div class="card shadow" style="width: 90%; z-index: 222;">
            <div class="card-header h5 text-center">Login</div>
            <div class="m-1">
              <?php Semej::show() ?>
            </div>
            <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
              <div class="card-body">
                <div class="form-floating mb-3">
                  <input type="text" name="frm[email]" class="form-control" placeholder="Userneme">
                  <label for="">Userneme</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="password" name="frm[password]" class="form-control" placeholder="Password">
                  <label for="">Password</label>
                </div>
                <div class="card-footer row bg-white">
                  <input name="submitBtn" type="submit" value="Login" class="btn btn-success">
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="col col-lg-8 col-md-6 col-sm-0 d-none d-sm-block"
      style="background-image: url(assets/image/photo1.png);">
    </div>
    </div>
  </section>
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/script.js"></script>
</body>

</html>