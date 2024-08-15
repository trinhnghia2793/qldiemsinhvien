<?php

class semester extends Db {

    // Hàm trả về danh sách học kỳ
    function all() {
        $sql = "select * from semester";
        return $this->selectQuery($sql);
    }

    // Lấy thông tin một học kỳ
    function get($id) {
        $sql = "select * from semester where semester_id = ?";
        return $this->selectQuery($sql, [$id]);
    }
}