<?php 
  session_start(); 

  if (!isset($_SESSION['studentID'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: loginpage.html');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['studentID']);
  	header("location: loginpage.html");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบจัดแผนการเรียน</title>
    <link href="https://fonts.googleapis.com/css?family=Sarabun" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/assets/css/font-awesome.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
    <style>
        td{
            padding: 10px;
        }
        .swal2-container {
            zoom: 1.5;
        }
        .swal2-actions button {
            margin: .5em !important;
        }
    </style>
</head>
<body>
    <div class="banner-image">
        <div>
            <table style="all:unset;"><tr>
                <td height="10"></td>
            </tr>
                <tr style="background-color:unset;" >
                    <td width="40"></td>
                    <td><a href="https://tu.ac.th/">
              <img src="thanontiger.png"   width="100" height="100"> </a></td>
              <td>
                    <p style="color:black; font-size:2.4vw">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระบบจัดแผนการเรียน</p><br>
                    <p style="color: black; font-size:1.75vw;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สำหรับนักศึกษาสาขาวิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์ฯ มหาวิทยาลัยธรรมศาสตร์ ศูนย์รังสิต</p>
                </td>
                </tr></table>
          </div>
      </div>
      <div class="sidenav">
        <div style="margin-top: 100%;">
            <a href="tutorial_main.html">วิธีการใช้งาน</a>
            <button class="dropdown-btn">ข้อมูลนักศึกษา<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
                <a href="info.php">บัญชีของนักศึกษา</a>
                <a href="usersub.php">ข้อมูลการศึกษา</a>
                <a href="Subjecttest.php">ข้อมูลแผนการเรียน</a>
                <a href="syllabus.html">ข้อมูลหลักสูตร</a>
            </div>
                <button class="dropdown-btn">Course Navigator<i class="fa fa-caret-down"></i></button>
                <div class="dropdown-container">
                <a href="gradermain.php">จำลองแผนการเรียน</a>
                <a href="requiredSub.php">รายวิชาที่จำเป็น</a>
            </div> 
                <a href="#" onclick="logoutFunction()">ออกจากระบบ</a>
        </div>
    </div>
<div class="main" style="margin-top: 5%;text-align: center;">
<h3>เมื่อคุณกดปุ่ม “เริ่มต้น”<br><br>
ระบบจะทำการเก็บข้อมูลการศึกษาย้อนหลังของท่าน<br><br>
รวมถึงเกรด กรุณาใส่ข้อมูลตามความเป็นจริง<br><br>
เพื่อที่ระบบจะสามารถทำงานได้<br><br>
อย่างมีประสิทธิภาพสูงสุด<br><br>
</h2>
<a href="usersub.php" class="btn btn-info btn-lg" role="button" aria-pressed="true">เริ่มต้นเพิ่มรายวิชาที่เรียนแล้ว</a>
</div>
<!-- and fix that green text good again -->
<div class="w3-padding w3-display-bottomleft  w3-allerta">
    <iframe src="http://free.timeanddate.com/clock/i71m8hxz/n28/tlth/fn8/fs22/tct/pct/pa0/th1" frameborder="0" width="106" height="25" allowtransparency="true"></iframe>
</div>
<script>
        function logoutFunction() {

            const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
            text: "ยืนยันออกจากระบบ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'ตกลง' ,
            cancelButtonText: 'ยกเลิก',

            }).then((result) => {
            if (result.value) {
                swalWithBootstrapButtons.fire({
                icon: 'success',
                text: 'ออกจากระบบสำเร็จ กำลังกลับสู่หน้าหลัก',
                timer: 1500,
                }).then(function() {
                window.location = "logout.php";
                });
            }
            })
        }
    </script>
    <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html>