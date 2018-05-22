<?php
define('PAGINATE',20);

define('DOCUMENT_UPLOAD_DIR', '/uploads/documents/');

define('DOCUMENT_UPLOAD_ADDITIONAL', '/uploads/document_additional/');
/*
    Các role của nhân viên trung tâm
*/


//quản lý trung tâm
define('QLTT', 1);
//giáo vụ
define('GV', 2);
//Phụ trách chuyên môn
define('PTCM', 3);
//Cố vấn học tập
define('CVHT', 4);
//Bán hàng
define('SALE', 5);
//kế toán
define('KT', 6);

define('ADMIN', 7);
define('BTV', 8);
define('DEV', 9);

define('PARTNER', 10);
/*
thể loại câu hỏi, đáp án
*/
//Câu hỏi
define('P', 1);
//Đáp án
define('D', 2);

define('NAM', 1);
define('NU', 0);

////// các ngày trong tuần
define('T2', 2);
define('T3', 3);
define('T4', 4);
define('T5', 5);
define('T6', 6);
define('T7', 7);
define('CN', 8);
/*
----------------------------
*/
define('THL', 'THL');
define('KEY_API', 'AVwtTTSaWpn7LfDW');
define('ACTIVE', 1);
define('INACTIVE', 2);
define('REGISTER_LESSON', 0);
//define status trong bang ask_permission: 1 la approve, 2 là chờ approve
define('APPROVE', 1);
define('WAIT_APPROVE', 2);
//define subject email landingpage
define('LANDING_PAGE_EMAIL_SUBJECT', '[HOCMAI]_Xác nhận đăng ký tham gia thi thử/ĐGNL thành công');
define('LANDING_PAGE_EMAIL_SUBJECT_CENTER', 'Đăng kí thi thử/ĐGNL');
//define device
define('COMPUTER', 1);
define('MOBILE', 2);

// define login in landing_page
define('USER', 'user');
define('PASSWORD', '123456');
define('SESSION_LANDING_LOGIN', 'ortherlogin');