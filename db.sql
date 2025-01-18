-- إنشاء قاعدة البيانات
CREATE DATABASE sehe;

-- استخدام قاعدة البيانات
USE sehe;

-- إنشاء جدول الموظفين
CREATE TABLE employees (
    employee_id INT AUTO_INCREMENT PRIMARY KEY, -- رقم الموظف (رقم فريد)
    name VARCHAR(100) NOT NULL,                -- اسم الموظف
    job_title VARCHAR(100),                    -- المسمى الوظيفي
    department VARCHAR(100),                   -- القسم
    contact_info VARCHAR(255) NOT NULL UNIQUE  -- معلومات الاتصال (مثل رقم الهوية/الإقامة - يجب أن تكون فريدة)
);

-- إنشاء جدول الإجازات المرضية
CREATE TABLE medical_leaves (
    leave_id INT AUTO_INCREMENT PRIMARY KEY,   -- رمز الخدمة أو رقم الإجازة (رقم فريد)
    employee_id INT NOT NULL,                  -- رقم الموظف (مرتبط بجدول الموظفين)
    start_date DATE NOT NULL,                  -- تاريخ بدء الإجازة
    end_date DATE NOT NULL,                    -- تاريخ نهاية الإجازة
    reason VARCHAR(255),                       -- سبب الإجازة
    status ENUM('معتمدة', 'مرفوضة', 'قيد الانتظار') DEFAULT 'قيد الانتظار', -- حالة الإجازة
    issued_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- تاريخ إصدار الإجازة
    FOREIGN KEY (employee_id) REFERENCES employees(employee_id) ON DELETE CASCADE
);

-- إدخال بيانات مبدئية في جدول الموظفين
INSERT INTO employees (name, job_title, department, contact_info)
VALUES 
('أحمد محمد', 'مهندس برمجيات', 'تكنولوجيا المعلومات', '1234567890'),
('سارة خالد', 'محاسبة', 'المالية', '9876543210'),
('محمد علي', 'مدير مبيعات', 'المبيعات', '5678901234');

-- إدخال بيانات مبدئية في جدول الإجازات المرضية
INSERT INTO medical_leaves (employee_id, start_date, end_date, reason, status)
VALUES
(1, '2025-01-01', '2025-01-05', 'إنفلونزا', 'معتمدة'),
(2, '2025-01-10', '2025-01-15', 'صداع شديد', 'قيد الانتظار'),
(3, '2025-02-01', '2025-02-03', 'نزلة برد', 'مرفوضة');

