<?php

class score extends Db {

    // Hàm trả về danh sách điểm (tên sv, mã đk, tên môn học, số tín chỉ, điểm)
    function all() {
        $sql = "select * from register, student, module, semester, subject, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id";
        return $this->selectQuery($sql);
    }

    // Hàm trả về danh sách điểm theo mã module (tên sv, mã đk, tên môn học, số tín chỉ, điểm)
    function all_byid($id) {
        $sql = "select * from register, student, module, semester, subject, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.module_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Hàm trả về danh sách điểm của học phần gv đó đang dạy
    function all_byteacher($id) {
        $sql = "select * from register, student, module, semester, subject, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.teacher_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Hàm trả về danh sách điểm của học phần gv đó đang dạy
    // Theo mã module 
    function all_byteacher_id($id1, $id2) {
        $sql = "select * from register, student, module, semester, subject, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.teacher_id = ?
                and module.module_id = ?";
        return $this->selectQuery($sql, [$id1, $id2]);
    }

    // Hàm trả về danh sách điểm của sinh viên
    function all_bystudent($id) {
        $sql = "select * from register, module, semester, class, subject
                where register.module_id = module.module_id
                and module.subject_id = subject.subject_id
                and module.class_id = class.class_id
                and register.student_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Hàm trả vè danh sách điểm của sinh viên theo học kỳ
    function all_bysem_student($id, $semester_id) {
        $sql = "select * from register, module, class, subject
                where register.module_id = module.module_id
                and module.subject_id = subject.subject_id
                and module.class_id = class.class_id
                and register.student_id = ?
                and module.semester_id = ?";
        return $this->selectQuery($sql, [$id, $semester_id]);
    }

    // Lấy thông tin một điểm
    function get($id) {
        $sql = "select * from register, student, module, semester, subject, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and register_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Sửa điểm
    function update($id, $test1, $test2, $mid, $final) {
        // Kiểm tra điểm (chưa làm)

        $sql = "update register set test1 = ?, test2 = ?, mid = ?, final = ? where register_id = ?";
        $arr = [$test1, $test2, $mid, $final, $id];
        return $this->updateQuery($sql, $arr);
    }

}