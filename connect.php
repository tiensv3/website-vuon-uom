<?php

// Thông tin kết nối đến MySQL
$host = "localhost";
$user = "root";
$password = "";
$database = "vuonuom_db";

// Tạo kết nối đến MySQL
$conn = new mysqli($host, $user, $password, $database);


// Thiết lập UTF-8 làm bộ ký tự mặc định
$conn->set_charset("utf8");
date_default_timezone_set('Asia/Bangkok');
