<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $name = $_POST["tensach"];
            if($name == 1){
                echo"Đây là sách bạn cân tìm";
            }
            else {
                echo"sách bạn tìm không có trong thư viện";
            } 
        }
        
    ?>

    <form action="index.php" method="post">
        Ten: <input type="text" name="tensach">
        <input type="submit">
    </form>
</body>
</html>