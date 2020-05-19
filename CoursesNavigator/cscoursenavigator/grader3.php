<?php 
  session_start(); 

  if (!isset($_SESSION['studentID'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: loginpage.html');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['studentID']);
  	header("location: loginpage.php");
  }
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "cscoursenavigator";
$con = mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
  }
  if(isset($_POST['subStatus'])){
    $userID = $_SESSION['studentID'];
    $subStatus = $_POST['subStatus'];
        $updateStatus = "UPDATE registerdata SET subStatus = '$subStatus'  WHERE studentID LIKE '$userID' ";
        $updateSub = mysqli_query($con,$updateStatus);
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <title>เพิ่มวิชาที่เคยลงเรียนมาแล้ว</title>
        <style>
        table {
        margin-left: 10%;
        border-collapse: separate;
        border-spacing: 2px;
        width: 80%;
        color: black;
        font-size: 14px;
        text-align: center;
        }
        th {
        background-color: lightblue;
        color: black;
        text-align: center;
        padding: 20px;
        }
        td{
            padding: 10px;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
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
<div class="main"
><div>
<?php  if (isset($_SESSION["studentID"])) : ?>
    <p>เพิ่ม/ลบข้อมูลรายวิชาของ <?php print_r($_SESSION["username"]); ?></p>
    <p>ชั้นปีการศึกษาที่ 1 ภาคฤดูร้อน</p>
<?php endif ?>
</div>
<div>
<!-- table plan -->
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '3'");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%' style=\"background-color:white;\"></th>
    <th width='5%'>รหัสวิชา</th>
    <th width='15%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td style=\"background-color:white;\">
    <form method=\"post\" action=\"deleteSub.php\" >
    <input  type=hidden id=\"subIDDel\" name=\"subIDDel\" value=" .$addrow["subID"]. ">
    <button type=\"submit\" class=\"btn btn-link\">ลบวิชา</button></form></td>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
}
else{
    echo "ไม่พบวิชาที่ทำการลงทะเบียน";
}
echo "</table>"; 

?>
</div>

<!-- searching form -->
<div style="margin-left: 15%;margin-top: 2%;float: left;">
    <form action="" method="POST">
        <input type="text" name="term" placeholder="ค้นหารายวิชา">
        <input type="submit" value="ค้นหา">
    </form>
</div>   
<div style="margin-right: 15%;margin-top: 2%;float: right;"> 
    <a href="gradermain.php" class="btn btn-info btn-lg" role="button">บันทึกข้อมูล</a>
    <br>
</div>


<div>
<!-- table subject -->
<?php
if(!empty($_REQUEST['term'])) {
$term = $_REQUEST['term'];     
$result = $con->query("SELECT * FROM subject WHERE subID LIKE '%$term%' ORDER BY semester ASC, year ASC");
if (mysqli_num_rows($result) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%' style=\"background-color:white;\"></th>
    <th width='5%'>รหัสวิชา</th>
    <th width='15%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    echo "<tr>
    <td style=\"background-color:white;\">
    <form method=\"post\"  action=\"testgradermodal.php\" >
    <input  type=hidden id=\"subIDAdd\" name=\"subIDAdd\" value=" .$row["subID"]. ">
    <input  type=hidden id=\"subNameAdd\" name=\"subNameAdd\" value=" .$row["subName"]. ">
    <input  type=hidden id=\"subCreditAdd\" name=\"subCreditAdd\" value=" .$row["subCredit"]. ">
    <input  type=hidden id=\"gradersemester\" name=\"gradersemester\" value=\"3\">
    <button type=\"submit\" class=\"btn btn-link\">เพิ่มวิชา</button></form></td><td>"
    .$row["subID"]. 
    "</td><td>"
    .$row["subName"]. 
    "</td><td>"
    .$row["subCredit"].
    "</td><tr>";
}
else{
    echo "ไม่พบข้อมูลที่ค้นหา";
}
echo "</table>";
} 



$con->close();
?>
</div>
</table>
<br>
<br>
<br>
</div>

<div class="w3-padding w3-display-bottomleft " style="position: fixed;">
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