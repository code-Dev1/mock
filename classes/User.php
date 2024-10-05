<?php
require_once 'Database.php';
require_once 'config.php';
class User extends Database {

    public function index() {
       $sql = "SELECT * FROM users ORDER BY userId DESC LIMIT 10";
       return $this->executeStatement($sql);
    }
    public function searchUser($formData){
        $id = (int) $formData;
        $sql = "SELECT * FROM users WHERE userId = ? OR username LIKE ?";
        $param = [
            $id,
            "%".$formData."%"
        ];
        $result = $this->executeStatement($sql,$param);
        if(count($result) <1){
            Semej::set("danger","","ریکارد مورد نظر دریافت نشد.");
            header("location:dashboard?page=users");die;
        }
        return $result;
    }
    public function role(){
        $sql = "SHOW COLUMNS FROM users LIKE 'role'";
        $result = $this->executeStatement($sql);
        $enum = $result[0];
        $role = $enum->Type;
        preg_match("/^enum\(\'(.*)\'\)$/" ,$role,$matches);
        return explode("','",$matches[1]);

    }
    public function addUser($formData) {

        $sqlCheck = "SELECT email FROM student WHERE email = ?";
        $userName = $formData['userName'];
        $paramCheck = [$userName];
        $emailCheck = $this->executeStatement($sqlCheck, $paramCheck);
        if (!empty($emailCheck)) {
            Semej::set("warning", "انجام نشد", "ایمیل وارد شده قبلا موجود میباشد");
            header("location:dashboard.php?page=addStudent");die;
        } 
        if($formData['password'] !== $formData['confirmPassword']){
            Semej::set("warning", "انجام نشد", "پسورد وارد شده یکسان نمیباشد.");
            header("location:dashboard.php?page=addUser");die;
        }
        if(strlen($formData['password']) < 5 ){
            Semej::set("danger", "انجام نشد", "پسورد از ۶ حرف کم است.");
                header("location:dashboard.php?page=addUser");die;
        }
        $sql = "INSERT INTO users (userName,password,role) VALUES(?,?,?)";
        $password = md5($formData['password'].SALT);
        $param = [
            $formData['userName'],
            $password,
            $formData['role']
        ];
        $stmt = $this->executeStatement($sql, $param);
        if (!$stmt) {
            Semej::set("warning", "انجام نشد", "مشکل رخ داد");
            header("location:dashboard.php?page=addUser");die;
        } else {
            
            if ($stmt != 1) {
                Semej::set("warning", "انجام نشد", "مشکل رخ داد");
                header("location:dashboard.php?page=addUser");die;
            } else {
                Semej::set("success", "انجام شد", "کاربر جدید آضافه شد");
                header("location:dashboard.php?page=addUser");die;
            }
        }
        
    }
    public function single($id) {
        $sql = "SELECT * FROM users WHERE userId = ?";
        $param=[$id = (int) $id];
        $result = $this->executeStatement($sql ,$param);
        $result = $result[0];
        return $result;
    }
    public function userUp($formData) {

        $userName = $formData['userName'];
        $id = (int) $formData['userId'];

        $userNameSql = "SELECT userName FROM users WHERE userName = ? AND userId <> ?";
        $userParam  = [
            $userName,
            $id
        ];
        $userNameResult = $this->executeStatement($userNameSql,$userParam);

        if(count($userNameResult) != 0){
            Semej::set("danger", "انجام نشد", "نام کابری وارد شده قبلا موجود میباشد");
            header("location:dashboard.php?page=userUp&userId=$id");die;
        }
        $oldPassword = md5($formData['oldPassword'].SALT);
        if(strlen($formData['oldPassword']) > 2){
            $passSql = "SELECT password FROM users WHERE userId = ?";
            $passParam = [$id];
            $passResult = $this->executeStatement($passSql,$passParam);
            $passResult = $passResult[0];
            if($passResult->password !== $oldPassword){
                Semej::set("danger", "انجام نشد", "پسورد قبلی درست نمیباشد.");
                header("location:dashboard.php?page=userUp&userId=$id");die;
            }
            if(strlen($formData['password']) < 6){
                Semej::set("danger", "انجام نشد", "پسورد جدید از ۶ کم است.");
                header("location:dashboard.php?page=userUp&userId=$id");die;
            }
            if($formData['password'] !== $formData['confirmPassword'] ){
                Semej::set("danger", "انجام نشد", "پسورد جدید با هم مطابقت نداره.");
                header("location:dashboard.php?page=userUp&userId=$id");die;
            }           
        }
        if(strlen($formData['oldPassword']) == 0 && strlen($formData['password']) == 0 ){
            var_dump('ok');
            $sql = "UPDATE users SET userName = ?, role = ? ,updatedAt = ? WHERE userId = ?";
            $param = [
                $formData['userName'],
                $formData['role'],
                date('Y-m-d H:i:s'),
                $formData['userId']
            ];
        }
        if(strlen($formData['oldPassword']) >2 && strlen($formData['password']) >5 ){
            var_dump('ddjkjlk');
            $sql = "UPDATE users SET userName = ?, password = ? ,role = ? ,updatedAt = ? WHERE userId = ?";
            $password = md5($formData['password'].SALT);
            $param = [
                $formData['userName'],
                $password,
                $formData['role'],
                date('Y-m-d H:i:s'),
                $formData['userId']
            ];
        }
        $result = $this->executeStatement($sql,$param);
        if($result < 0):
            Semej::set("danger", "انجام نشد", "مشکل رخ داده است.");
            header("location:dashboard.php?page=userUp&userId=$id");die;
        endif;
        Semej::set("success", "انجام نشد", "ریکارد مافقانه بروز شد.");
        header("location:dashboard.php?page=users");die;
    }
    public function userDelete($id) {
        $id = (int) $id;
        $sql = "DELETE FROM users WHERE userId = ?";
        $param = [$id];
        $result = $this->executeStatement($sql,$param);
        if($result < 1){
            Semej::set("danger","","حذف ریکارد شکست خورد.");
            header("location:dashboard?page=users");die;
        }
        Semej::set("success","","حذف ریکارد $id مافقیت آمیز بود.");
        header("location:dashboard?page=users");die;
    }
    public function totleUser() {
        $sql = "SELECT COUNT(userId) as totle FROM users";
        $result = $this->executeStatement($sql);
        return $result[0];
    }
}