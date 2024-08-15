<?php

class teacher extends Db {

    // Hàm trả về danh sách giảng viên
    function all() {
        $sql = "select * from teacher, user, major
                where teacher.teacher_id = user.username
                and teacher.major_id = major.major_id";
        return $this->selectQuery($sql);
    }

    // Hàm trả về danh sách giảng viên theo khoa
    function allByMajor($major_id) {
        $sql = "select * from teacher, user
                where teacher.teacher_id = user.username
                and teacher.major_id = ?";
        return $this->selectQuery($sql, [$major_id]);
    }

    // Hàm lấy có tìm kiếm
    function searchAll($name) {
        $sql = "select * from teacher, user, major
                where teacher.teacher_id = user.username
                and teacher.major_id = major.major_id
                and user.name like '%$name%'";
        return $this->selectQuery($sql);
    }

    // Lấy thông tin một giảng viên
    function get($id) {
        $sql = "select * from teacher, user, major
                where teacher.teacher_id = user.username 
                and teacher.teacher_id = ?
                and teahcer.major_id = major.major_id";
        return $this->selectQuery($sql, [$id]);
    }

}