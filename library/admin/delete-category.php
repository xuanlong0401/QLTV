<?php
session_start();
include('includes/config.php');

// Chỉ xử lý nếu người dùng đã đăng nhập
if(strlen($_SESSION['alogin']) == 0){
    header('location:index.php');
    exit;
}

// Kiểm tra yêu cầu POST hợp lệ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {

    // Kiểm tra CSRF token
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['delmsg'] = "Yêu cầu không hợp lệ (CSRF token sai).";
        header('location:manage-categories.php');
        exit;
    }

    // Kiểm tra ID
    $id = intval($_POST['id']);
    if ($id <= 0) {
        $_SESSION['delmsg'] = "ID không hợp lệ.";
        header('location:manage-categories.php');
        exit;
    }

    // Kiểm tra danh mục có tồn tại không
    $stmt = $dbh->prepare("SELECT id FROM tblcategory WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        $_SESSION['delmsg'] = "Danh mục không tồn tại.";
        header('location:manage-categories.php');
        exit;
    }

    // Xóa danh mục
    $sql = "DELETE FROM tblcategory WHERE id = :id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);

    if ($query->execute()) {
        $_SESSION['delmsg'] = "Danh mục đã được xóa thành công.";
    } else {
        $_SESSION['delmsg'] = "Lỗi khi xóa danh mục.";
    }

    header('location:manage-categories.php');
    exit;
}
else {
    // Truy cập sai phương thức
    $_SESSION['delmsg'] = "Phương thức yêu cầu không hợp lệ.";
    header('location:manage-categories.php');
    exit;
}
