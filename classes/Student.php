<?php

require_once 'Database.php';
class Student extends Database
{
    public function index($formData = [])
    {
        if (!empty($formData)) {
            $sql = "SELECT * FROM student WHERE studentId = ? OR firstName LIKE ? LIMIT 10";
            $param = [
                $formData,
                "%$formData%"
            ];
            $result = $this->executeStatement($sql, $param);
            if (empty($result)) {
                Semej::set('danger', "ok", "There is no record");
                header("location:dashboard.php?page=home");die();
            }
        }
        else{
            $sql = "SELECT * FROM student ORDER BY studentId DESC  LIMIT 10";
            $result = $this->executeStatement($sql);
        }
        // var_dump($result);
            return $result;
    }
    public function studnets()
    {
        $sql = "SELECT * FROM student";
        return $this->executeStatement($sql); 
    }
    public function addStudent($formData)
    {
        $sqlCheck = "SELECT email FROM student WHERE email = ?";
        $email = $formData['email'];
        $paramCheck = [$email];
        $emailCheck = $this->executeStatement($sqlCheck, $paramCheck);
        if (!empty($emailCheck)) {
            Semej::set("warning", "انجام نشد", "ایمیل وارد شده قبلا موجود میباشد");
            header("location:dashboard.php?page=addStudent");die;
        } else {
            $sql = "INSERT INTO student (firstName,lastName,email,department,course) VALUES(?,?,?,?,?)";
            $param = [
                $formData['firstName'],
                $formData['lastName'],
                $formData['email'],
                $formData['department'],
                $formData['cours']
            ];
            $stmt = $this->executeStatement($sql, $param);
            if (!$stmt) {
                Semej::set("warning", "انجام نشد", "مشکل رخ داد");
                header("location:dashboard.php?page=addStudent");die;
            } else {
                
                if ($stmt != 1) {
                    Semej::set("warning", "انجام نشد", "مشکل رخ داد");
                    header("location:dashboard.php?page=addStudent");die;
                } else {
                    Semej::set("success", "انجام شد", "شاگرد جدید آضافه شد");
                    header("location:dashboard.php?page=addStudent");die;
                }
            }
        }
    }
    public function single($id)
    {
    $sql = "SELECT * FROM student WHERE studentId = ?";
    $param = [$id];
    $result = $this->executeStatement($sql,$param);
    return $result[0];
    }

    public function studentUpdate($formData)
    {
        $email = $formData['email'];
        $id = (int) $formData['studentId'];
        // var_dump($email,$id);die;

        $emailSql = "SELECT email FROM student WHERE email = ? AND studentId <> ?";
        $param = [
            $email,
            $id
        ];
        $emailResult = $this->executeStatement($emailSql,$param);

        if(count($emailResult) != 0){
            Semej::set("danger", "انجام نشد", "ایمیل وارد شده قبلا موجود میباشد");
            header("location:dashboard.php?page=stdUp&stdId=$id");die;
        }
        $sql = "UPDATE student SET firstName = ?,lastName = ?, email = ?,department = ?,cuorse = ?";
        $result = $this->executeStatement($sql,array_values($formData));
        if($result == 0){
            Semej::set("danger", "انجام نشد", "مشکل رخ داد است.");
            header("location:dashboard.php?page=stdUp&stdId=$id");die;
        }
        Semej::set("success", "انجام شد", "ریکارد $id مافقانه بروزرسانی شد.");
        header("location:dashboard?page=students");die;
    }
    public function studentDelete($id)
    {
        $id = (int) $id;
        $sql = "DELETE FROM student WHERE studentId = ?";
        $param = [$id];
        $result = $this->executeStatement($sql,$param);
        if($result < 1){
            Semej::set("danger","","حذف ریکارد شکست خورد.");
            header("location:dashboard?page=students");die;
        }
        Semej::set("success","","حذف ریکارد $id مافقیت آمیز بود.");
        header("location:dashboard?page=students");die;
    }
    public function totlestd(){
        $sql = "SELECT COUNT(studentId) as totle FROM student";
        $result = $this->executeStatement($sql);
        return $result[0];
    }
}