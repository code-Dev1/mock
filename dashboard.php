<?php
require_once __DIR__ . '/autoload.php';
if (!$auth->validateToken()) {
    $auth->logout();
    header("Location:index");
    die;
}

$page = 'home';
if (isset($_GET['page'])) {
    if (!empty($_GET['page'])) {
        $page = $_GET['page'];
        $page = basename($page);
        $explodePage = explode('.', $page);
        $page = $explodePage[0];

        if (!file_exists('pages/' . $page . '.php')) {
            $page = 'home';
        }

    } else
        $page = 'home';
} else
    $page = 'home';

$includePath = __DIR__ . '/pages/' . $page . '.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Side Navbar</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <!-- sidebar start -->
        <?php require_once 'pages/common/sidebar.php'; ?>
        <!-- sidebar end -->
        <!-- top navbar start  -->
        <?php require_once 'pages/common/top.php'; ?>
        <!-- top navbar end  -->
        <!-- main start  -->
        <main class="content">
            <div class="container pt-3" id="content">

                <?php Semej::show();
                require_once $includePath ?>
            </div>
        </main>
        <!-- main end  -->
    </div>

    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <script src="assets/js/script.js"></script>

    <!-- the below methode can include page without refresh page -->
    <!-- <script>
        function goToPage(page) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET',"pages/"+page+".php",true);
            xhr.onreadystatechange = function () {
                if(xhr.readyState == 4 && xhr.status == 200){
                    document.getElementById('content').innerHTML =xhr.responseText;
                    window.history.pushState({page:"new"},"page new","/mock/dashboard?page="+page)
                }
            };
            xhr.send();
        }
    </script> -->
    <!-- the above methode you can like this   goToPage('home') methode('page name do you want include') -->
</body>

</html>