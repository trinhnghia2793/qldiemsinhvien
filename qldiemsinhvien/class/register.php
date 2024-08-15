<?php

class register extends Db {

    // Hàm trả về danh sách đăng ký học phần (mã, tên sinh viên, tên môn, tên lớp, học kỳ, số tc)
    function all() {
        $sql = "select * from register, module, semester, student, subject, class, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.class_id = class.class_id";
        return $this->selectQuery($sql);
    }

    // Hàm trả về danh sách đăng ký học phần (mã, tên sinh viên, tên môn, tên lớp, học kỳ, số tc)
    // theo giáo viên
    function all_byteacher($id) {
        $sql = "select * from register, module, semester, student, subject, class, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.class_id = class.class_id
                and module.teacher_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Hàm trả về danh sách đăng ký học phần (mã, tên môn, tên lớp, học kỳ, số tc, giáo viên dạy)
    // theo sinh viên
    function all_bystudent($id) {
        $sql = "select module.module_id, subject.subject_name, class.class_name, module.credit, user.name, module.semester_id 
                from register, module, semester, teacher, subject, class, user
                where register.module_id = module.module_id
                and module.subject_id = subject.subject_id
                and module.class_id = class.class_id
                and module.semester_id = semester.semester_id
                and module.teacher_id = teacher.teacher_id
                and teacher.teacher_id = user.username
                and register.student_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Hàm trả về danh sách đăng ký học phần (mã, tên môn, tên lớp, học kỳ, số tc, giáo viên dạy)
    // theo sinh viên & học kỳ
    function all_bysem_student($id, $semester_id) {
        $sql = "select module.module_id, subject.subject_name, class.class_name, module.credit, user.name, module.semester_id 
                from register, module, teacher, subject, class, user
                where register.module_id = module.module_id
                and module.subject_id = subject.subject_id
                and module.class_id = class.class_id
                and module.teacher_id = teacher.teacher_id
                and teacher.teacher_id = user.username
                and register.student_id = ?
                and module.semester_id = ?";
        return $this->selectQuery($sql, [$id, $semester_id]);
    }

    // Lấy thông tin một register
    function get($id) {
        $sql = "select * from register, module, semester, student, subject, class, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = module.module_id
                and module.semester_id = semester.semester_id
                and module.subject_id = subject.subject_id
                and module.class_id = class.class_id
                and register_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Thêm một register mới
    function add() {
        $module_id = $_POST['module_id']??'';
        $student_id = $_POST['student_id']??'';

        // Kiểm tra sinh viên học môn này chưa
        $sql = "select * from register where module_id = ? and student_id = ?";
        $result = $this->selectQuery($sql, [$module_id], $student_id);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "insert into register(module_id, student_id) values(?, ?)";
        $arr = [$module_id, $student_id];
        return $this->updateQuery($sql, $arr);
    }

    // Xóa một register (hủy)
    function delete($id) {
        // Kiểm tra khóa ngoại: score
        $sql = "select * from score where id = ?";
        $result = $this->selectQuery($sql, [$id]);
        if(Count($result) > 0) {
            return -1;
        }

        $sql = "delete from register where register_id = ?";
        $arr = [$id];
        return $this->updateQuery($sql, $arr);
    }

}