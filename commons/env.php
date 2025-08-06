<?php 

// Biến môi trường, dùng chung toàn hệ thống
// Khai báo dưới dạng HẰNG SỐ để không phải dùng $GLOBALS

//đường dẫn vào client
define('BASE_URL'       , 'http://localhost/pro1014-beebook/');
//đường dẫn vào admin
define('BASE_ADMIN_URL' , 'http://localhost/pro1014-beebook/admin/');

define('DB_HOST'    , 'localhost');
define('DB_PORT'    , 3306);
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME'    , 'bee_book');  // Tên database

define('PATH_ROOT'    , __DIR__ . '/../');