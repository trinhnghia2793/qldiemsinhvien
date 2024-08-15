<?php

class classs extends Db {

    // Hàm trả về danh sách class
    function all() {
        $sql = "select * from class";
        return $this->selectQuery($sql);
    }

    // Hàm lấy có tìm kiếm
    function searchAll($name) {
        $sql = "select * from class where class_name like '%$name%'";
        return $this->selectQuery($sql);
    }

    // Lấy thông tin một class
    function get($id) {
        $sql = "select * from class where class_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Thêm một class mới
    function add() {
        $class_name = $_POST['class_name']??'';

        // Kiểm tra xem có lớp nào có tên như này chưa?
        $sql = "select * from class where class_name = ?";
        $result = $this->selectQuery($sql, [$class_name]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "insert into class(class_name) values(?)";
        $arr = [$class_name];
        return $this->updateQuery($sql, $arr);
    }

    // Xóa một class
    function delete($id) {
        // Kiểm tra khóa ngoại: có student nào thuộc về class này?
        $sql = "select * from student where student_class_id = ?";
        $result = $this->selectQuery($sql, [$id]);
        if(Count($result) > 0) {
            return -1;
        }

        // Kiểm tra khóa ngoại: có học phần nào thuộc về class này?
        $sql = "select * from module where class_id = ?";
        $result = $this->selectQuery($sql, [$id]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "delete from class where class_id = ?";
        $arr = [$id];
        return $this->updateQuery($sql, $arr);
    }

    // Sửa một class
    function update($id) {
        $class_name = $_POST['class_name']??'';

        // Kiểm tra xem có lớp nào có tên như này chưa?
        $sql = "select * from class where class_name = ?";
        $result = $this->selectQuery($sql, [$class_name]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "update class set class_name = ? where class_id = ?";
        $arr = [$class_name, $id];
        return $this->updateQuery($sql, $arr);
    }

}