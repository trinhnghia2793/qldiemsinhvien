<?php

class user extends Db {

    // Hàm trả về danh sách user
    function all() {
        return $this->selectQuery("select * from user");
    }

    // Trả về thông tin một user
    function get($id) {
        $sql = "select * from user where username = ?";
        $arr = [$id];
        return $this->selectQuery($sql, $arr);
    }

    // Thêm một user mới
    function add() {
        $username = $_POST['username']??'';
        $password = $_POST['password']??'';
        $name = $_POST['name']??'';
        $dateofbirth = $_POST['dateofbirth']??'';
        $email = $_POST['email']??'';
        $role = $_POST['role']??''; // fix sau
        $sql = "insert into user(username, password, name, dateofbirth, email, role) values(?, ?, ?, ?, ?, ?)";

        $arr = [$username, $password, $name, $dateofbirth, $email, $role];
        return $this->updateQuery($sql, $arr);
    }

    // Kiểm tra mật khẩu
    function check($username, $password) {
        $sql = "select * from user where username = ? and password = ?";
        $arr = [$username, $password];
        return $this->selectQuery($sql, $arr);
    }

    // Đổi email
    function change_email($username) {
        $email = $_POST['email']??'';

        // Kiểm tra xem có email nào trùng chưa?
        $sql = "select * from user where email = ?";
        $result = $this->selectQuery($sql, [$email]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "update user set email = ? where username = ?";
        $arr = [$email, $username];
        return $this->updateQuery($sql, $arr);
    }

    // kiểm tra email
    function checkemail($email) {
        $sql = "select email from user where email = ?";
        return $this->selectQuery($sql, [$email]);
    }

    // Thêm token vào user
    function addToken($email, $token) {
        $sql = "update user set token = ? where email = ?";
        return $this->updateQuery($sql, [$token, $email]);
    }

    // update password
    function updatePassword($token, $newPassword) {
        $sql = "update user set password = ? where token = ?";
        return $this->updateQuery($sql, [$newPassword, $token]);
    }

    // remove token
    function removeToken($token) {
        $sql = "update user set token = NULL where token = ?";
        return $this->updateQuery($sql, [$token]);
    }

    // Đổi mật khẩu
    function change_password($username) {
        $password = $_POST['password']??''; // mật khẩu cũ
        $password1 = $_POST['password1']??''; // mật khẩu mới
        $password2 = $_POST['password2']??''; // nhập lại mật khẩu mới

        // đánh dấu
        $check['flag'] = false; 
        $check[1] = false; // mk cũ nhập ko đúng
        $check[2] = false; // mk mới & mk nhập lại ko trùng nhau

        // Kiểm tra mật khẩu cũ nhập đúng chưa
        $sql = "select * from user where username = ? and password = ?";
        $result = $this->selectQuery($sql, [$username, $password]);
        if(Count($result) == 0) {
            $check['flag'] = true;
            $check[1] = true;
        }

        // Kiểm tra mật khẩu & nhập lại có trùng nhau chưa
        if($password1 != $password2) {
            $check['flag'] = true;
            $check[2] = true;
        }

        //
        if($check['flag'] == false) {
            $sql = "update user set password = ? where username = ?";
            $arr = [$password1, $username];
            return $this->updateQuery($sql, $arr);
        }
        else {
            return $check;
        }
        
    }
}