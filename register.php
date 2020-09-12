<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <?php
    include_once('connect.php');
    if (isset($_POST['submit'])) {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $picture = $_FILES['fileUpload'];

        // echo 'ชื่อรูป: ' .$_FILES['fileUpload']['name'].'<br>';
        // echo 'เนื้อหาไฟล์: ' .$_FILES['fileUpload']['tmp_name'].'<br>';
        // echo 'ขนาดรูป: ' .$_FILES['fileUpload']['size'] / 1024 .'KB <br>';
        //echo 'ชนิดไฟล์: ' .$_FILES['fileUpload']['type'].'<br>';
        $temp = explode('.', $_FILES['fileUpload']['name']); // ขั้นตอนการเปลี่ยนชื่อไฟล์ เพื่อไม่ให้ชื่อซ้ำ

        $newName = round(microtime(true)) . '.' . end($temp); // ขั้นตอนการเปลี่ยนชื่อไฟล์ เพื่อไม่ให้ชื่อซ้ำ

        if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], 'uploads/' . $newName)) { // อัปโหลดรูปเก็บไว้ในโฟล์เดอร์ที่ชื่อ uploads และเช็คว่าอัปโหลดสำเร็จหรือไม่
            echo "Upload Completed";
            $sql = "INSERT INTO `member` (`id`, `firstname`, `lastname`, `username`, `password`, `picture`) VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '$newName');"; // ใช้ $newName แทน $picture
            $result = $conn->query($sql);

            if ($result) {
                echo '<script>alert("Register Completed")</script>';
                header('Refresh:0; url=login.php'); // ใช้คู่กับ alert
            } else {
                echo "no";
            }
        }
    }
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5 ">
                <div class="card">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- enctype ไว้อัปโหลดรูป -->
                        <div class="card-header text-center">
                            Register
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="firstname" class="col-sm-3 col-form-label">First Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastname" class="col-sm-3 col-form-label">Last Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="username" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="fileUpload" class="col-sm-3 col-form-label">Upload</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" id="fileUpload" name="fileUpload" onchange="readURL(this)"> <!-- ทำให้โชว์รูปภาพก่อนที่จะอัปโหลด ดูคลิป ep.11 -->
                                </div>
                            </div>
                            <figure class="figure">
                                <img id="imgUpload" class="figure-img img-fluid rounded" alt="">    <!-- ทำให้โชว์รูปภาพก่อนที่จะอัปโหลด ดูคลิป ep.11 -->
                                <figcaption class="figure-caption">A caption for the above image.</figcaption>
                            </figure>
                            <div class="card-footer text-center">
                                <input type="submit" name="submit" class="btn btn-success" value="Register">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script>
        function readURL(input) { //ทำให้โชว์รูปภาพก่อนที่จะอัปโหลด ดูคลิป ep.11
           
            var reader = new FileReader()
            reader.onload = function(e) {
                console.log(e.target.result)
                $('#imgUpload').attr('src', e.target.result).width(300)
            }
            reader.readAsDataURL(input.files[0]);
        }
    </script>

</body>

</html>