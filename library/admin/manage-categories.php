<?php
session_start();
include('includes/config.php');

// Kiểm tra đăng nhập
if(strlen($_SESSION['alogin']) == 0){
    header('location:index.php');
    exit;
}

// Tạo CSRF token nếu chưa có
if(empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Xử lý xóa danh mục nếu có yêu cầu POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $_SESSION['delmsg'] = "Yêu cầu không hợp lệ (CSRF token sai).";
        header('location:manage-categories.php');
        exit;
    }

    $id = intval($_POST['id']);
    if ($id <= 0) {
        $_SESSION['delmsg'] = "ID không hợp lệ.";
        header('location:manage-categories.php');
        exit;
    }

    // Kiểm tra danh mục tồn tại
    $stmt = $dbh->prepare("SELECT id FROM tblcategory WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        $_SESSION['delmsg'] = "Danh mục không tồn tại.";
        header('location:manage-categories.php');
        exit;
    }

    // Xóa
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
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Danh mục</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Quản lý Danh mục</h2>

    <?php if(isset($_SESSION['delmsg'])): ?>
        <div class="alert alert-info">
            <?php
                echo htmlentities($_SESSION['delmsg']);
                unset($_SESSION['delmsg']);
            ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM tblcategory";
            $query = $dbh->prepare($sql);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
            $cnt = 1;
            if($query->rowCount() > 0) {
                foreach($results as $result) {
            ?>
            <tr>
                <td><?php echo htmlentities($cnt); ?></td>
                <td><?php echo htmlentities($result->CategoryName); ?></td>
                <td>
                    <form method="post" action="manage-categories.php" style="display:inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">
                        <input type="hidden" name="id" value="<?php echo $result->id; ?>">
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                        <button type="submit" name="delete" class="btn btn-danger btn-sm">Xóa</button>
                    </form>
                </td>
            </tr>
            <?php
                $cnt++;
                }
            } else {
                echo "<tr><td colspan='3'>Không có danh mục nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>

        }