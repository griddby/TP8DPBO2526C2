CREATE DATABASE tp_mvc26;
USE tp_mvc26;

CREATE TABLE lecturers(
    id_lecturer INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nidn VARCHAR(30) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    join_date DATE NOT NULL
);

CREATE TABLE students(
    id_student INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    nim VARCHAR(30) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    prodi VARCHAR(100)
);

CREATE TABLE attendance(
    id_attendance INT AUTO_INCREMENT PRIMARY KEY,
    id_student INT NOT NULL,
    id_lecturer INT NOT NULL,
    attendance_date DATE NOT NULL DEFAULT(CURRENT_DATE),
    status ENUM('Hadir', 'Izin', 'Sakit', 'Alpa') NOT NULL DEFAULT 'Hadir',
    FOREIGN KEY(id_student) REFERENCES students(id_student),
    FOREIGN KEY(id_lecturer) REFERENCES lecturers(id_lecturer)
);


INSERT INTO lecturers (name, nidn, phone, join_date) VALUES
('Andi Pratama', '0405019001', '081234567890', '2020-01-15'),
('Siti Rahmawati', '0405029102', '082345678901', '2021-03-10'),
('Bambang Setiawan', '0405039203', '083456789012', '2022-06-20');

INSERT INTO students (name, nim, phone, prodi) VALUES
('Budi Santoso', '2401234', '081298765432', 'Ilmu Komputer'),
('Dina Permata', '2405678', '085678901234', 'Pendidikan Ilmu Komputer'),
('Rizky Ramadhan', '2409012', '087890123456', 'Ilmu Komputer');

INSERT INTO attendance (id_student, id_lecturer, attendance_date, status) VALUES
(1, 1, '2026-11-18', 'Hadir'),
(2, 2, '2026-11-18', 'Izin'),
(3, 3, '2026-11-18', 'Sakit');