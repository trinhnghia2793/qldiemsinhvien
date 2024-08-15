-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th6 10, 2024 lúc 07:36 PM
-- Phiên bản máy phục vụ: 10.3.39-MariaDB-cll-lve
-- Phiên bản PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ngannhat_qldiemsinhvien`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `class`
--

CREATE TABLE `class` (
  `class_id` int(10) NOT NULL,
  `class_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(1, 'Lớp 12DHTH01'),
(2, 'Lớp 12DHTH02'),
(3, 'Lớp 12DHTH03'),
(4, 'Lớp 12DHTCKT01'),
(5, 'Lớp 12DHTHKT02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `major`
--

CREATE TABLE `major` (
  `major_id` int(10) NOT NULL,
  `major_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `major`
--

INSERT INTO `major` (`major_id`, `major_name`) VALUES
(1, 'Công nghệ thông tin'),
(2, 'Tài chính kế toán');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `module`
--

CREATE TABLE `module` (
  `module_id` int(10) NOT NULL,
  `subject_id` int(10) NOT NULL,
  `teacher_id` varchar(10) NOT NULL,
  `class_id` int(10) NOT NULL,
  `credit` int(11) DEFAULT NULL,
  `semester_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `module`
--

INSERT INTO `module` (`module_id`, `subject_id`, `teacher_id`, `class_id`, `credit`, `semester_id`) VALUES
(1, 1, 'gv001', 1, 2, 1),
(2, 1, 'gv002', 1, 2, 1),
(3, 2, 'gv003', 3, 2, 1),
(4, 2, 'gv004', 2, 2, 1),
(5, 3, 'gv002', 2, 3, 1),
(6, 3, 'gv004', 3, 3, 1),
(7, 6, 'gv005', 4, 2, 1),
(8, 6, 'gv006', 4, 2, 1),
(9, 7, 'gv007', 4, 3, 1),
(10, 8, 'gv005', 5, 3, 1),
(11, 4, 'gv001', 1, 3, 2),
(12, 4, 'gv002', 1, 3, 2),
(13, 4, 'gv003', 3, 3, 2),
(14, 5, 'gv004', 2, 3, 2),
(15, 5, 'gv002', 2, 3, 2),
(16, 9, 'gv005', 4, 3, 2),
(17, 9, 'gv006', 5, 3, 2),
(18, 10, 'gv007', 4, 1, 2),
(19, 10, 'gv005', 5, 1, 2);

--
-- Bẫy `module`
--
DELIMITER $$
CREATE TRIGGER `trigger1` BEFORE INSERT ON `module` FOR EACH ROW BEGIN
  -- Select the 'credit' from the 'SUBJECT' table where the 'subject_id' matches the new row in 'MODULE'
  SELECT credit INTO @subjectCredit FROM SUBJECT WHERE subject_id = NEW.subject_id;

  -- Set the 'credit' in the new row of 'MODULE' before it is inserted
  SET NEW.credit = @subjectCredit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `register`
--

CREATE TABLE `register` (
  `register_id` int(10) NOT NULL,
  `module_id` int(10) NOT NULL,
  `student_id` varchar(10) NOT NULL,
  `test1` double(8,2) DEFAULT NULL,
  `test2` double(8,2) DEFAULT NULL,
  `mid` double(8,2) DEFAULT NULL,
  `final` double(8,2) DEFAULT NULL,
  `avg10` double(8,2) DEFAULT NULL,
  `avg4` double(8,2) DEFAULT NULL,
  `avgchar` varchar(3) DEFAULT NULL,
  `xeploai` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `register`
--

INSERT INTO `register` (`register_id`, `module_id`, `student_id`, `test1`, `test2`, `mid`, `final`, `avg10`, `avg4`, `avgchar`, `xeploai`) VALUES
(1, 1, 'sv001', 7.00, 7.30, 9.70, 6.50, 6.95, 2.50, 'C+', 'TB'),
(2, 3, 'sv001', 7.00, 7.00, 8.00, 9.00, 8.50, 4.00, 'A', 'Giỏi'),
(3, 5, 'sv001', 3.30, 9.20, 7.90, 3.40, 4.42, 1.00, 'D', 'TB Yếu'),
(4, 2, 'sv002', 7.30, 5.20, 4.00, 8.10, 7.32, 3.00, 'B', 'Khá'),
(5, 4, 'sv002', 6.20, 8.50, 3.50, 8.60, 7.84, 3.00, 'B', 'Khá'),
(6, 6, 'sv002', 7.70, 4.20, 6.50, 3.50, 4.29, 1.00, 'D', 'TB Yếu'),
(7, 1, 'sv003', 5.80, 5.80, 4.10, 4.70, 4.86, 1.00, 'D', 'TB Yếu'),
(8, 3, 'sv003', 4.20, 7.10, 8.30, 5.00, 5.46, 1.50, 'D+', 'TB Yếu'),
(9, 5, 'sv003', 4.50, 8.80, 3.00, 8.90, 7.86, 3.00, 'B', 'Khá'),
(10, 2, 'sv004', 5.00, 9.90, 5.10, 6.00, 6.20, 2.00, 'C', 'TB'),
(11, 4, 'sv004', 8.60, 3.60, 4.40, 8.70, 7.75, 3.00, 'B', 'Khá'),
(12, 6, 'sv004', 3.20, 3.50, 4.50, 9.00, 7.42, 3.00, 'B', 'Khá'),
(13, 1, 'sv005', 8.70, 3.80, 5.10, 3.60, 4.28, 1.00, 'D', 'TB Yếu'),
(14, 3, 'sv005', 9.60, 6.60, 6.70, 9.30, 8.80, 4.00, 'A', 'Giỏi'),
(15, 5, 'sv005', 4.90, 8.80, 5.80, 3.70, 4.54, 1.00, 'D', 'TB Yếu'),
(16, 2, 'sv006', 3.60, 5.80, 6.10, 7.30, 6.66, 2.50, 'C+', 'TB'),
(17, 4, 'sv006', 10.00, 4.40, 5.30, 9.90, 8.90, 4.00, 'A', 'Giỏi'),
(18, 6, 'sv006', 3.60, 6.90, 4.20, 6.10, 5.74, 1.50, 'D+', 'TB Yếu'),
(19, 1, 'sv007', 7.70, 7.80, 5.50, 7.10, 7.07, 3.00, 'B', 'Khá'),
(20, 3, 'sv007', 3.60, 9.80, 9.90, 6.10, 6.60, 2.50, 'C+', 'TB'),
(21, 5, 'sv007', 7.90, 8.30, 8.30, 6.40, 6.93, 2.50, 'C+', 'TB'),
(22, 2, 'sv008', 5.70, 9.30, 5.80, 8.60, 8.10, 3.50, 'B+', 'Khá'),
(23, 4, 'sv008', 7.00, 4.70, 7.30, 6.60, 6.52, 2.50, 'C+', 'TB'),
(24, 6, 'sv008', 6.30, 4.50, 8.20, 9.70, 8.69, 4.00, 'A', 'Giỏi'),
(25, 1, 'sv009', 8.80, 4.90, 3.80, 8.70, 7.84, 3.00, 'B', 'Khá'),
(26, 3, 'sv009', 7.30, 9.70, 8.30, 4.40, 5.61, 1.50, 'D+', 'TB Yếu'),
(27, 5, 'sv009', 8.20, 9.20, 8.80, 5.30, 6.33, 2.00, 'C', 'TB'),
(28, 2, 'sv010', 8.70, 9.60, 6.40, 5.10, 6.04, 2.00, 'C', 'TB'),
(29, 4, 'sv010', 3.60, 4.50, 6.10, 5.70, 5.41, 1.50, 'D+', 'TB Yếu'),
(30, 6, 'sv010', 9.90, 5.80, 3.90, 9.50, 8.61, 4.00, 'A', 'Giỏi'),
(31, 7, 'sv011', 9.40, 6.00, 8.70, 5.30, 6.12, 2.00, 'C', 'TB'),
(32, 9, 'sv011', 9.10, 3.20, 3.50, 8.40, 7.46, 3.00, 'B', 'Khá'),
(33, 10, 'sv011', 7.80, 4.80, 6.00, 8.90, 8.09, 3.50, 'B+', 'Khá'),
(34, 8, 'sv012', 4.50, 9.40, 6.50, 4.90, 5.47, 1.50, 'D+', 'TB Yếu'),
(35, 9, 'sv012', 8.30, 5.90, 5.10, 8.50, 7.88, 3.00, 'B', 'Khá'),
(36, 10, 'sv012', 7.10, 3.80, 9.70, 5.00, 5.56, 1.50, 'D+', 'TB Yếu'),
(37, 7, 'sv013', 3.90, 8.70, 4.30, 7.10, 6.66, 2.50, 'C+', 'TB'),
(38, 9, 'sv013', 7.50, 5.80, 9.00, 7.50, 7.48, 3.00, 'B', 'Khá'),
(39, 10, 'sv013', 4.50, 8.80, 3.20, 3.50, 4.10, 1.00, 'D', 'TB Yếu'),
(40, 8, 'sv014', 7.80, 9.20, 4.70, 3.30, 4.48, 1.00, 'D', 'TB Yếu'),
(41, 9, 'sv014', 5.60, 3.10, 4.30, 8.40, 7.18, 3.00, 'B', 'Khá'),
(42, 10, 'sv014', 9.10, 4.30, 4.10, 6.00, 5.95, 1.50, 'D+', 'TB Yếu'),
(43, 7, 'sv015', 7.60, 7.80, 8.50, 3.40, 4.77, 1.00, 'D', 'TB Yếu'),
(44, 9, 'sv015', 4.40, 3.10, 4.90, 4.70, 4.53, 1.00, 'D', 'TB Yếu'),
(45, 10, 'sv015', 8.20, 3.30, 5.40, 7.10, 6.66, 2.50, 'C+', 'TB'),
(46, 8, 'sv016', 9.40, 7.40, 6.00, 9.50, 8.93, 4.00, 'A', 'Giỏi'),
(47, 9, 'sv016', 6.40, 3.30, 9.20, 6.20, 6.23, 2.00, 'C', 'TB'),
(48, 10, 'sv016', 7.90, 9.10, 3.70, 7.60, 7.39, 3.00, 'B', 'Khá'),
(49, 7, 'sv017', 7.60, 8.30, 7.80, 3.40, 4.75, 1.00, 'D', 'TB Yếu'),
(50, 9, 'sv017', 7.90, 3.70, 8.20, 4.10, 4.85, 1.00, 'D', 'TB Yếu'),
(51, 10, 'sv017', 8.00, 3.00, 8.30, 10.00, 8.93, 4.00, 'A', 'Giỏi'),
(52, 8, 'sv018', 7.00, 7.70, 7.60, 8.80, 8.39, 3.50, 'B+', 'Khá'),
(53, 9, 'sv018', 4.30, 7.00, 6.90, 9.70, 8.61, 4.00, 'A', 'Giỏi'),
(54, 10, 'sv018', 5.50, 3.20, 4.00, 6.40, 5.75, 1.50, 'D+', 'TB Yếu'),
(55, 7, 'sv019', 7.90, 4.20, 8.00, 5.00, 5.51, 1.50, 'D+', 'TB Yếu'),
(56, 9, 'sv019', 5.00, 8.00, 8.60, 5.10, 5.73, 1.50, 'D+', 'TB Yếu'),
(57, 10, 'sv019', 7.40, 6.60, 6.90, 8.30, 7.90, 3.00, 'B', 'Khá'),
(58, 8, 'sv020', 6.70, 9.70, 9.60, 8.40, 8.48, 3.50, 'B+', 'Khá'),
(59, 9, 'sv020', 8.10, 5.60, 7.40, 4.60, 5.33, 1.50, 'D+', 'TB Yếu'),
(60, 10, 'sv020', 7.80, 7.40, 8.00, 3.30, 4.63, 1.00, 'D', 'TB Yếu'),
(61, 11, 'sv001', NULL, NULL, NULL, 8.70, 8.70, 4.00, 'A', 'Giỏi'),
(62, 15, 'sv001', NULL, NULL, 7.80, 7.50, 7.59, 3.00, 'B', 'Khá'),
(63, 12, 'sv002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 15, 'sv002', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 13, 'sv003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 15, 'sv003', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 11, 'sv004', NULL, NULL, NULL, 8.00, 8.00, 3.50, 'B+', 'Khá'),
(68, 15, 'sv004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 12, 'sv005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 15, 'sv005', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 13, 'sv006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 15, 'sv006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 11, 'sv007', NULL, NULL, NULL, 7.00, 7.00, 3.00, 'B', 'Khá'),
(74, 15, 'sv007', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 12, 'sv008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 15, 'sv008', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 13, 'sv009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 15, 'sv009', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 11, 'sv010', NULL, NULL, NULL, 8.50, 8.50, 4.00, 'A', 'Giỏi'),
(80, 15, 'sv010', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 16, 'sv011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 18, 'sv011', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 17, 'sv012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 19, 'sv012', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 16, 'sv013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 18, 'sv013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 17, 'sv014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 19, 'sv014', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 16, 'sv015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 18, 'sv015', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 17, 'sv016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 19, 'sv016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 16, 'sv017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 18, 'sv017', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(95, 17, 'sv018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(96, 19, 'sv018', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(97, 16, 'sv019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(98, 18, 'sv019', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(99, 17, 'sv020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(100, 19, 'sv020', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Bẫy `register`
--
DELIMITER $$
CREATE TRIGGER `cal_score` BEFORE UPDATE ON `register` FOR EACH ROW BEGIN
	IF NEW.final IS NOT NULL THEN
    	IF NEW.mid is NULL THEN
        	set new.avg10 = NEW.final;
        ELSEIF NEW.test1 is null THEN
        	set new.avg10 = NEW.final * 0.7 + NEW.mid * 0.3;
        ELSEIF NEW.test2 is null THEN
        	set new.avg10 = NEW.final * 0.7 + NEW.mid * 0.2 + NEW.test1 * 0.1;
        ELSE
        	set new.avg10 = NEW.final * 0.7 + NEW.mid * 0.1 + NEW.test1 * 0.1 + NEW.test2 * 0.1;
        end IF;
        
        if new.avg10 >= 8.5 THEN
        	set new.avg4 = 4;
            set new.avgchar = 'A';
            set new.xeploai = "Giỏi";
        elseif new.avg10 >= 8 THEN
        	set new.avg4 = 3.5;
            set new.avgchar = 'B+';
            set new.xeploai = "Khá";
        elseif new.avg10 >= 7 THEN
        	set new.avg4 = 3;
            set new.avgchar = 'B';
            set new.xeploai = "Khá";
        elseif new.avg10 >= 6.5 THEN
        	set new.avg4 = 2.5;
            set new.avgchar = 'C+';
            set new.xeploai = "TB";
        elseif new.avg10 >= 6 THEN
        	set new.avg4 = 2;
            set new.avgchar = 'C';
            set new.xeploai = "TB";
        elseif new.avg10 >= 5 THEN
        	set new.avg4 = 1.5;
            set new.avgchar = 'D+';
            set new.xeploai = "TB Yếu";
        elseif new.avg10 >= 4 THEN
        	set new.avg4 = 1;
            set new.avgchar = 'D';
            set new.xeploai = "TB Yếu";
        else
        	set new.avg4 = 0;
            set new.avgchar = 'F';
            set new.xeploai = 'Kém';
        end if;
    ELSE
    	set new.avg10 = null;
        set new.avg4 = null;
        set new.avgchar = null;
        set new.xeploai = null;
    end IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `dkhp_1` BEFORE INSERT ON `register` FOR EACH ROW BEGIN

	 DECLARE sub INT;
     DECLARE sem INT;
     DECLARE stu VARCHAR(10);

     SET sub = (SELECT DISTINCT subject_id FROM MODULE WHERE module_id = NEW.module_id);
     SET sem = (SELECT DISTINCT semester_id FROM MODULE WHERE module_id = NEW.module_id);
     SET stu = (SELECT DISTINCT student_id FROM register WHERE student_id = NEW.student_id);	
     
    if EXISTS (
        SELECT 1 from register, module
        WHERE register.module_id = module.module_id
        AND sub = module.subject_id
        AND sem = module.semester_id
        AND stu = register.student_id
    )
    THEN
        -- If the student is already registered for the subject, prevent the insert
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'A student cannot be registered for the same subject twice.';
  	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `semester`
--

CREATE TABLE `semester` (
  `semester_id` int(10) NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `start` date NOT NULL DEFAULT current_timestamp(),
  `end` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `semester`
--

INSERT INTO `semester` (`semester_id`, `semester_name`, `start`, `end`) VALUES
(1, 'HK1(2023-2024)', '2024-05-03', '2024-05-10'),
(2, 'HK2(2023-2024)', '2024-06-03', '2024-06-10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `student_id` varchar(10) NOT NULL,
  `student_class_id` int(10) NOT NULL,
  `student_major_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`student_id`, `student_class_id`, `student_major_id`) VALUES
('sv001', 1, 1),
('sv002', 1, 1),
('sv003', 1, 1),
('sv004', 1, 1),
('sv005', 1, 1),
('sv006', 2, 1),
('sv007', 2, 1),
('sv008', 2, 1),
('sv009', 3, 1),
('sv010', 3, 1),
('sv011', 4, 2),
('sv012', 4, 2),
('sv013', 4, 2),
('sv014', 4, 2),
('sv015', 4, 2),
('sv016', 5, 2),
('sv017', 5, 2),
('sv018', 5, 2),
('sv019', 5, 2),
('sv020', 5, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(10) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `major_id` int(10) NOT NULL,
  `credit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `major_id`, `credit`) VALUES
(1, 'Cấu trúc dữ liệu và giải thuật', 1, 2),
(2, 'Cơ sở dữ liệu', 1, 2),
(3, 'Lập trình hướng đối tượng', 1, 3),
(4, 'Phân tích thiết kế hệ thống thông tin', 1, 3),
(5, 'Lập trình mã nguồn mở', 1, 3),
(6, 'Nhập môn tài chính tiền tệ', 2, 2),
(7, 'Phân tích báo cáo tài chính', 2, 3),
(8, 'Kinh tế vi mô', 2, 3),
(9, 'Kinh tế vĩ mô 2', 2, 3),
(10, 'Nguyên lý kế toán', 2, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` varchar(10) NOT NULL,
  `major_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `major_id`) VALUES
('gv001', 1),
('gv002', 1),
('gv003', 1),
('gv004', 1),
('gv005', 2),
('gv006', 2),
('gv007', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_id` varchar(10) NOT NULL,
  `subject_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dateofbirth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`username`, `password`, `name`, `gender`, `dateofbirth`, `email`, `role`, `token`) VALUES
('admin001', 'admin', 'Máy chủ', 'Nam', '2000-01-01', 'admin1@gmail.com', 'admin', NULL),
('gv001', '123', 'Trần Việt Hùng', 'Nam', '1985-05-05', 'tvhung@gmail.com', 'teacher', NULL),
('gv002', '123', 'Bùi Công Danh', 'Nam', '1990-09-09', 'bcdanh@gmail.com', 'teacher', NULL),
('gv003', '123', 'Vũ Văn Vinh', 'Nam', '1989-11-11', 'nle82745@gmail.com', 'teacher', NULL),
('gv004', '123', 'Nguyễn Thị Bích Ngân', 'Nữ', '1990-08-10', 'ntbngan@gmail.com', 'teacher', NULL),
('gv005', '123', 'Trần Phước', 'Nam', '1980-12-12', 'tranphuoc@gmail.com', 'teacher', NULL),
('gv006', '123', 'Tô Hồng Thiên', 'Nam', '1985-11-19', 'thyen@gmail.com', 'teacher', NULL),
('gv007', '123', 'Võ Thị Yên Hà', 'Nữ', '1987-07-16', 'vtyha@gmail.com', 'teacher', NULL),
('sv001', '123', 'Ngô Quốc Phong', 'Nam', '2000-04-07', 'trinhnghia270903@gmail.com', 'student', NULL),
('sv002', '123', 'Lý Văn Khải', 'Nam', '2000-08-08', 'lvkhai@gmail.com', 'student', NULL),
('sv003', '123', 'Bùi Thị Ngân', 'Nữ', '2000-10-09', 'btngan@gmail.com', 'student', NULL),
('sv004', '123', 'Nguyễn Văn An', 'Nam', '2000-01-01', 'nvan@gmail.com', 'student', NULL),
('sv005', '123', 'Lê Thị Bình', 'Nữ', '2000-03-02', 'ltbinh@gmail.com', 'student', NULL),
('sv006', '123', 'Trần Quốc Cao', 'Nam', '2000-01-03', 'tqcao@gmail.com', 'student', NULL),
('sv007', '123', 'Phạm Thị Dung', 'Nữ', '2000-01-30', 'ptdung@gmail.com', 'student', NULL),
('sv008', '123', 'Vũ Văn Anh', 'Nam', '2000-07-05', 'kimngan4869@gmail.com', 'student', NULL),
('sv009', '123', 'Hoàng Minh Phúc', 'Nam', '2000-11-06', 'hmphuc@gmail.com', 'student', NULL),
('sv010', '123', 'Đỗ Ngọc Hạnh', 'Nữ', '2000-12-07', 'dnhanh@gmail.com', 'student', NULL),
('sv011', '123', 'Ngô Quốc Khánh', 'Nam', '2000-01-08', 'nqkhanh@gmail.com', 'student', NULL),
('sv012', '123', 'Lý Văn Phong', 'Nam', '2000-05-09', 'lvphong@gmail.com', 'student', NULL),
('sv013', '123', 'Bùi Thị Hương', 'Nữ', '2000-08-10', 'bthuong@gmail.com', 'student', NULL),
('sv014', '123', 'Nguyễn Văn Hải', 'Nam', '2000-11-11', 'nvhai@gmail.com', 'student', NULL),
('sv015', '123', 'Lê Thị Loan', 'Nữ', '2000-02-12', 'ltloan@gmail.com', 'student', NULL),
('sv016', '123', 'Trần Quốc Long', 'Nam', '2000-07-13', 'tqlong@gmail.com', 'student', NULL),
('sv017', '123', 'Phạm Thị Ngân', 'Nữ', '2000-12-14', 'ptngan@gmail.com', 'student', NULL),
('sv018', '123', 'Vũ Văn Đạt', 'Nam', '2000-04-15', 'vvdat@gmail.com', 'student', NULL),
('sv019', '123', 'Hoàng Minh Sơn', 'Nam', '2000-01-16', 'hmson@gmail.com', 'student', NULL),
('sv020', '123', 'Đỗ Ngọc Tài', 'Nam', '2000-09-17', 'dntai@gmail.com', 'student', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Chỉ mục cho bảng `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`major_id`);

--
-- Chỉ mục cho bảng `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`module_id`,`subject_id`,`teacher_id`,`class_id`,`semester_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Chỉ mục cho bảng `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`register_id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Chỉ mục cho bảng `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semester_id`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `student_class_id` (`student_class_id`),
  ADD KEY `student_major_id` (`student_major_id`);

--
-- Chỉ mục cho bảng `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Chỉ mục cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `major_id` (`major_id`);

--
-- Chỉ mục cho bảng `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`teacher_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `major`
--
ALTER TABLE `major`
  MODIFY `major_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `module`
--
ALTER TABLE `module`
  MODIFY `module_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `register`
--
ALTER TABLE `register`
  MODIFY `register_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT cho bảng `semester`
--
ALTER TABLE `semester`
  MODIFY `semester_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `module_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `module_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `module_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `module_ibfk_4` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`semester_id`);

--
-- Các ràng buộc cho bảng `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`module_id`),
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Các ràng buộc cho bảng `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`student_class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`student_major_id`) REFERENCES `major` (`major_id`);

--
-- Các ràng buộc cho bảng `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `major` (`major_id`);

--
-- Các ràng buộc cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `major` (`major_id`);

--
-- Các ràng buộc cho bảng `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `teacher_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
