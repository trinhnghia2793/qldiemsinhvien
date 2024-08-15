<?php

class major extends Db {

    // Hàm trả về danh sách ngành học
    function all() {
        $sql = "select * from major";
        return $this->selectQuery($sql);
    }

    // Lấy thông tin một ngành hoc
    function get($id) {
        $sql = "select * from major where major_id = ?";
        return $this->selectQuery($sql, [$id]);
    }
}