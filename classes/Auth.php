<?php
if(!isset($_SESSION)){
    session_start();
}

require_once 'Database.php';
require_once 'config.php';

class Auth extends Database{
    
    public function login($formData){

        $email = $formData['email'];
        $password = md5($formData['password'].SALT);

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $parame = [
            $email,
            $password
        ];
        $user = $this->executeStatement($sql,$parame);
        if(count($user) != 1) {
            Semej::set("danger","Wroing","ایمیل و پسورد درست نمیباشد.");
            header("location:index");die;
        }
        $user = $user[0];
        Semej::set("success","","ورود موفقانه بود.");
        $_SESSION['auth_user'] = [

            'id' => $user->userId,
            'username' => $user->username
        ];

        $token = $this->generateToken($user->username);
        $_SESSION['auth_token'] = $token;
        header('location:dashboard');die;
    }

    protected function generateToken($username) {

        $remote_addr = $_SERVER['REMOTE_ADDR'];
        $token = sha1(SALT.$remote_addr.$username); 
        return $token;

    }
    
    public  function validateToken() {
        if(!isset($_SESSION)){
            return false;
        }
        if(!isset($_SESSION['auth_user']) || !isset($_SESSION['auth_token'])) {
              return false;
        }
        $username = $_SESSION['auth_user']['username'];
        $token = $_SESSION['auth_token'];
        $generate_token = $this->generateToken($username);
        
        if($token != $generate_token) {
            return false;
        }
        return true;
    }

    public function logout() {
        session_unset();
        session_destroy();
    }
    public function authRole($role){
        $id = $_SESSION['auth_user']['id'];
        $roleSql = "SELECT role FROM users WHERE userId = ?";
        $param = [$id];
        $result =  $this->executeStatement($roleSql,$param);
        if(count($result) !== 1){
            session_unset();
            session_destroy();
            header('location:index');die;
        }
        $result = $result[0];
        $chackRole = $result->role;
        if($chackRole !== $role){
            return false;
        }
        return true;
    }
}
// $auth = new Auth();