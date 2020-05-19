<?php
    
    session_start();
    require('connection.php');
?>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>
<body>
  <?php
        if(isset($_POST['studentID'])){
				//connection
                  include("connection.php");
				//รับค่า user & password
                  $studentID = $_POST['studentID'];
                  $password = $_POST['password'];
				//query 
                  $sql="SELECT * FROM registerdata Where studentID='".$studentID."' and password='".$password."' ";
                  $result = mysqli_query($con,$sql);
                  if(mysqli_num_rows($result)==1){
                    $row = mysqli_fetch_array($result);
                    $_SESSION["studentID"] = $row["studentID"];
                    $_SESSION["username"] = $row["title"]."".$row["firstName"]." ".$row["lastName"];

                    $plancheck = "SELECT studentID FROM subplantest Where studentID='".$studentID."'";
                    $resultplancheck = mysqli_query($con,$plancheck);
                    if(mysqli_num_rows($resultplancheck)>0){
                      header("Location: homepage.php");
                    }
                    else{
                      header("Location: start.php");
                    }
                  }else{
                    echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "error",
                title: "เข้าสู่ระบบล้มเหลว",
                text: "ไม่มีบัญชีนี้หรือรหัสผ่านไม่ถูกต้อง",
              }).then((result) => {
                if (result.value) {
                    window.history.go(-1);
                }
              })
        </script>';
                  }
        }else{
             Header("Location: loginpage.html"); //user & password incorrect back to login again

        }
?>
</body>
</html>