<?php
class Db {
    public static $conn = null;

    function __construct()
    {
        Db::$conn = new PDO('mysql:host=' . HOST . '; dbname=' . DB, U, P); // kết nối tới csdl
        Db::$conn->query('set names utf8');
    }

    // sql select
    // Trả về kết quả thực thi
    function selectQuery($sql, $params=[]) {
        $stm = Db::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    // sql select
    // Trả về số dòng được thực thi
    function updateQuery($sql, $params=[]) {
        $stm = Db::$conn->prepare($sql);
        $stm->execute($params);
        return $stm->rowCount();
    }
}