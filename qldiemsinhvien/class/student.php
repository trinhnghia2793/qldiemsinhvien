<?php

class student extends Db {

    // Hàm trả về danh sách student
    function all() {
        $sql = "select student.*, user.*, major.*, class.class_name from student, user, class, major 
                where student.student_id = user.username 
                and student.student_class_id = class.class_id 
                and student.student_major_id = major.major_id";
        return $this->selectQuery($sql);
    }
    // Hàm lấy có tìm kiếm
    function searchAll($name) {
        $sql = "select student.*, user.*, major.*, class.class_name from student, user, class, major 
                where student.student_id = user.username 
                and student.student_class_id = class.class_id 
                and student.student_major_id = major.major_id 
                and user.name like '%$name%'";
        return $this->selectQuery($sql);
    }
    
    // Hàm trả về danh sách sinh viên theo khoa
    function allByMajor($major_id) {
        $sql = "select * from student, user, class
                where student.student_id = user.username
                and student.student_class_id = class.class_id
                and student.student_major_id = ?";
        return $this->selectQuery($sql, [$major_id]);
    }

     // Hàm trả về danh sách sinh viên theo lớp
     function allByClass($class_id) {
        $sql = "select * from student, user
                where student.student_id = user.username
                and student.student_class_id = ?";
        return $this->selectQuery($sql, [$class_id]);
    }

    // Lấy thông tin một sinh viên
    function get($id) {
        $sql = "select student.*, user.*, major.*, class.class_name from student, user, class, major 
        where student.student_id = user.username 
        and student.student_class_id = class.class_id 
        and student.student_major_id = major.major_id 
        and class_id = ?";
        return $this->selectQuery($sql, [$id]);
    }

    // Hàm trả về danh sách sinh viên theo đăng ký học phần
    function all_bymodule($module_id) {
        $sql = "select register.student_id, name from register, student, user
                where register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = ?";
        return $this->selectQuery($sql, [$module_id]);
    }

    // Hàm trả về danh sách sinh viên theo đăng ký học phần của giáo viên
    function all_bymoduleteacher($module_id, $teacher_id) {
        $sql = "select register.student_id, name from register, module, student, user
                where register.module_id = module.module_id 
                and register.student_id = student.student_id
                and student.student_id = user.username
                and register.module_id = ?
                and module.teacher_id = ?";
        return $this->selectQuery($sql, [$module_id, $teacher_id]);
    }

}