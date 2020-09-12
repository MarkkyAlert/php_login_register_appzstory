<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="node_modules\bootstrap\dist\css\bootstrap.min.css">
</head>

<body>
    <?php
    include_once('connect.php');
    
    if (isset($_POST['submit'])) { // เช็คว่ามีการกด submit ไหม
        $username = $_POST['username'];
        $password = $conn->real_escape_string($_POST['password']);
        $sql = "SELECT * FROM `member` WHERE `username` = '".$username."' AND `password` = '".$password."'";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) { // เช็คว่ามี username/password ใน db หรือเปล่า
            $row = $result->fetch_assoc();
            $_SESSION['id'] = $row['id']; // ใช้ session มาเก็บตัวแปร เพื่อที่จะใช้ข้ามหน้า
            $_SESSION['name'] = $row['firstname']; // ใช้ session มาเก็บตัวแปร เพื่อที่จะใช้ข้ามหน้า
            header('location:index.php');
        } else {
            echo "Username or Password is invalid";
        }
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <div class="card">
                    <form action="" method="post"> <!-- ทำให้ส่งข้อมูลไปในไฟล์เดียวกัน -->
                        <div class="card-header">
                            Login to Your Account
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-center">
                            <input type="submit" name="submit" class="btn btn-success" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="node_modules\jquery\dist\jquery.min.js"></script>

    <script src="node_modules\bootstrap\dist\js\bootstrap.min.js"></script>

    <script src="node_modules\popper.js\dist\umd\popper.min.js"></script>
</body>

</html>