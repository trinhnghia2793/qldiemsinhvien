<?php

class module extends Db {

    // Hàm trả về danh sách module (học phần)
    function all() {
        $sql = "select * from module, semester, subject, teacher, class, user
                where module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.teacher_id = teacher.teacher_id
                and module.class_id = class.class_id
                and teacher.teacher_id = user.username";
        return $this->selectQuery($sql);
    }

    // Hàm trả về danh sách module của 1 giáo viên
    function all_byteacher($id) {
        $sql = "select * from module, semester, subject, teacher, class
                where module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.teacher_id = teacher.teacher_id
                and module.class_id = class.class_id
                and module.teacher_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Hàm trả về danh sách module theo học kỳ (admin)
    function all_bysem($semester_id) {
        $sql = "select * from module, semester, subject, teacher, user, class
                where module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.teacher_id = teacher.teacher_id
                and teacher.teacher_id = user.username
                and module.class_id = class.class_id
                and module.semester_id = ?";
        return $this->selectQuery($sql, [$semester_id]);
    }

    // Hàm trả về danh sách module theo học kỳ của giáo viên
    function all_bysem_teacher($semester_id, $teacher_id) {
        $sql = "select * from module, semester, subject, teacher, class
                where module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.teacher_id = teacher.teacher_id
                and module.class_id = class.class_id
                and module.semester_id = ?
                and module.teacher_id = ?";
        return $this->selectQuery($sql, [$semester_id, $teacher_id]);
    }

    // Lấy thông tin một module
    function get($id) {
        $sql = "select * from module, semester, subject, teacher, class, user
                where module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.teacher_id = teacher.teacher_id
                and module.class_id = class.class_id
                and teacher.teacher_id = user.username
                and module_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Thêm một module mới
    function add() {
        $subject_id = $_POST['subject_id']??'';
        $teacher_id= $_POST['teacher_id']??'';
        $class_id = $_POST['class_id']??'';
        // $credit = $_POST['credit']??''; // fix lại (subject id --> credit)
        $semester = $_POST['semester']??'';

        // Kiểm tra trùng (not)

        $sql = "insert into module(subject_id, teacher_id, class_id, semester) values(?, ?, ?, ?, ?)";
        $arr = [$subject_id, $teacher_id, $class_id, $semester];
        return $this->updateQuery($sql, $arr);
    }

    // Xóa một module
    function delete($id) {
        // Kiểm tra khóa ngoại (register)
        $sql = "select * from register where register_id = ?";
        $result = $this->selectQuery($sql, [$id]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "delete from module where module_id = ?";
        $arr = [$id];
        return $this->updateQuery($sql, $arr);
    }

    // Sửa một module
    function update($id) {
        $subject_id = $_POST['subject_id']??'';
        $teacher_id= $_POST['teacher_id']??'';
        $class_id = $_POST['class_id']??'';
        // $credit = $_POST['credit']??''; // fix lại (subject id --> credit)
        $semester = $_POST['semester']??'';

        // Kiểm tra trùng (not)
        $sql = "update module set subject_id = ?, teacher_id = ?, class_id = ?, credit = ?, semester = ? where class_id = ?";
        $arr = [$subject_id, $teacher_id, $class_id, $semester, $id];
        return $this->updateQuery($sql, $arr);
    }

}