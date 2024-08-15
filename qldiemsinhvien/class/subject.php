<?php

class subject extends Db {

    // Hàm trả về danh sách môn học
    function all() {
        $sql = "select * from subject, major where subject.major_id = major.major_id";
        return $this->selectQuery($sql);
    }

    // Hàm lấy có tìm kiếm
    function searchAll($name) {
        $sql = "select * from subject, major where subject.major_id = major.major_id and subject_name like '%$name%'";
        return $this->selectQuery($sql);
    }

    // Lấy thông tin một subject
    function get($id) {
        $sql = "select * from subject where subject_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Thêm một subject mới
    function add() {
        $subject_name = $_POST['subject_name']??'';

        // Kiểm tra xem có lớp nào có tên như này chưa?
        $sql = "select * from subject where subject_name = ?";
        $result = $this->selectQuery($sql, [$subject_name]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "insert into subject(subject_name) values(?)";
        $arr = [$subject_name];
        return $this->updateQuery($sql, $arr);
    }

    // Xóa một subject
    function delete($id) {
        // Kiểm tra khóa ngoại
        // module
        $sql = "select * from module where subject_id = ?";
        $result = $this->selectQuery($sql, [$id]);
        if(Count($result) > 0) {
            return -1;
        }

        // teacher_subject
        $sql = "select * from teacher_subject where subject_id = ?";
        $result = $this->selectQuery($sql, [$id]);
        if(Count($result) > 0) {
            return -1;
        }  

        $sql = "delete from subject where subject_id = ?";
        $arr = [$id];
        return $this->updateQuery($sql, $arr);
    }

    // Sửa một subject
    function update($id) {
        $subject_name = $_POST['subject_name']??'';

        // Kiểm tra xem có môn nào có tên như này chưa?
        $sql = "select * from subject where subject_name = ?";
        $result = $this->selectQuery($sql, [$subject_name]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "update subject set subject_name = ? where subject_id = ?";
        $arr = [$subject_name, $id];
        return $this->updateQuery($sql, $arr);
    }

}