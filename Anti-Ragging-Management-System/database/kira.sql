-- =========================================================
-- ANTI-RAGGING MANAGEMENT SYSTEM
-- Complete MySQL Database
-- =========================================================

CREATE DATABASE IF NOT EXISTS anti_ragging;

USE anti_ragging;

-- =========================================================
-- 1. STUDENTS TABLE
-- =========================================================

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20) DEFAULT NULL,
    course VARCHAR(100) DEFAULT NULL,
    roll_no VARCHAR(50) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- 2. ADMINS TABLE
-- =========================================================

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================================
-- 3. COMPLAINTS TABLE
-- =========================================================

CREATE TABLE IF NOT EXISTS complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,

    student_id INT NOT NULL,

    title VARCHAR(200) NOT NULL,

    description TEXT NOT NULL,

    incident_date DATE DEFAULT NULL,

    incident_time TIME DEFAULT NULL,

    location VARCHAR(200) DEFAULT NULL,

    accused_name VARCHAR(150) DEFAULT NULL,

    accused_details TEXT DEFAULT NULL,

    witness_details TEXT DEFAULT NULL,

    evidence VARCHAR(255) DEFAULT NULL,

    status ENUM(
        'Pending',
        'Under Investigation',
        'Resolved',
        'Rejected'
    ) DEFAULT 'Pending',

    admin_remarks TEXT DEFAULT NULL,

    assigned_to INT DEFAULT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_complaint_student
        FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_complaint_admin
        FOREIGN KEY (assigned_to)
        REFERENCES admins(id)
        ON DELETE SET NULL
);

-- =========================================================
-- 4. COMPLAINT STATUS HISTORY
-- =========================================================

CREATE TABLE IF NOT EXISTS complaint_status_history (
    id INT AUTO_INCREMENT PRIMARY KEY,

    complaint_id INT NOT NULL,

    old_status VARCHAR(50) DEFAULT NULL,

    new_status VARCHAR(50) NOT NULL,

    remarks TEXT DEFAULT NULL,

    changed_by INT DEFAULT NULL,

    changed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_history_complaint
        FOREIGN KEY (complaint_id)
        REFERENCES complaints(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_history_admin
        FOREIGN KEY (changed_by)
        REFERENCES admins(id)
        ON DELETE SET NULL
);

-- =========================================================
-- 5. NOTIFICATIONS TABLE
-- =========================================================

CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,

    student_id INT NOT NULL,

    complaint_id INT DEFAULT NULL,

    message TEXT NOT NULL,

    is_read TINYINT(1) DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_notification_student
        FOREIGN KEY (student_id)
        REFERENCES students(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_notification_complaint
        FOREIGN KEY (complaint_id)
        REFERENCES complaints(id)
        ON DELETE CASCADE
);

-- =========================================================
-- 6. DEFAULT ADMIN ACCOUNT
-- =========================================================
-- Email    : admin@antiragging.com
-- Password : admin123
--
-- Password hash below is for "admin123"
-- =========================================================

INSERT INTO admins
(
    name,
    email,
    password
)
VALUES
(
    'Administrator',
    'admin@antiragging.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEaK7l4L2u4q9u4j0Q7X2u1J5r8e'
);

-- =========================================================
-- 7. SAMPLE STUDENT
-- =========================================================
-- Email    : student@gmail.com
-- Password : student123
-- =========================================================

INSERT INTO students
(
    name,
    email,
    password,
    phone,
    course,
    roll_no
)
VALUES
(
    'Test Student',
    'student@gmail.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEaK7l4L2u4q9u4j0Q7X2u1J5r8e',
    '9876543210',
    'TYCS',
    '07'
);

-- =========================================================
-- 8. SAMPLE COMPLAINT
-- =========================================================

INSERT INTO complaints
(
    student_id,
    title,
    description,
    incident_date,
    incident_time,
    location,
    accused_name,
    accused_details,
    witness_details,
    status,
    admin_remarks
)
VALUES
(
    1,
    'Verbal Ragging Incident',
    'I was verbally harassed by senior students near the college campus.',
    '2026-10-05',
    '12:30:00',
    'College Canteen',
    'Senior Student',
    'The student was wearing a college uniform.',
    'Two students were present at the location.',
    'Pending',
    NULL
);

-- =========================================================
-- 9. INDEXES
-- =========================================================

CREATE INDEX idx_student_email
ON students(email);

CREATE INDEX idx_admin_email
ON admins(email);

CREATE INDEX idx_complaint_student
ON complaints(student_id);

CREATE INDEX idx_complaint_status
ON complaints(status);

CREATE INDEX idx_complaint_date
ON complaints(created_at);

CREATE INDEX idx_notification_student
ON notifications(student_id);

-- =========================================================
-- 10. VIEW FOR ADMIN COMPLAINT REPORTS
-- =========================================================

CREATE OR REPLACE VIEW complaint_report AS
SELECT
    c.id AS complaint_id,
    s.name AS student_name,
    s.email AS student_email,
    s.roll_no,
    c.title,
    c.description,
    c.incident_date,
    c.incident_time,
    c.location,
    c.accused_name,
    c.status,
    c.admin_remarks,
    a.name AS assigned_admin,
    c.created_at,
    c.updated_at
FROM complaints c
JOIN students s
    ON c.student_id = s.id
LEFT JOIN admins a
    ON c.assigned_to = a.id;

-- =========================================================
-- END OF DATABASE
-- =========================================================