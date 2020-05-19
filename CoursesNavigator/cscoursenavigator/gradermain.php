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
  include('connection.php');
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
        hr { 
        border-width: 5px;
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
<div class="main" style="margin-top: 3%;text-align: center;">
<FONT  COLOR=#000080 SIZE=6><B>&ensp;แผนการศึกษาปัจจุบันของคุณ</B></FONT>
<br><br><br>
<hr>
<h3>ชั้นปีการศึกษาที่ 1 ภาคเรียนที่ 1</h3><br>
<!-- table plan 1 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '1' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader1.php" >
    <input  type=hidden id="subStatus" name="subStatus" value="p">
    <input  type=hidden id="subStatus" name="semesterCheck" value="1">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader1.php" >
    <input  type=hidden id="subStatus" name="subStatus" value="p">
    <input  type=hidden id="subStatus" name="semesterCheck" value="1">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 1 -->
<h3>ชั้นปีการศึกษาที่ 1 ภาคเรียนที่ 2</h3><br>
<!-- table plan 2 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '2' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader2.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader2.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 2 -->
<h3>ชั้นปีการศึกษาที่ 1 ภาคเรียนที่ 3</h3><br>
<!-- table plan 3 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '3' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader3.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader3.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 3 -->
<h3>ชั้นปีการศึกษาที่ 2 ภาคเรียนที่ 1</h3><br>
<!-- table plan 4 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '4' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader4.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader4.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 4 -->
<h3>ชั้นปีการศึกษาที่ 2 ภาคเรียนที่ 2</h3><br>
<!-- table plan 5 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '5' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader5.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader5.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 5 -->
<h3>ชั้นปีการศึกษาที่ 2 ภาคเรียนที่ 3</h3><br>
<!-- table plan 6 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '6' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader6.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader6.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 6 -->
<h3>ชั้นปีการศึกษาที่ 3 ภาคเรียนที่ 1</h3><br>
<!-- table plan 7 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '7' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader7.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader7.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 7 -->
<h3>ชั้นปีการศึกษาที่ 3 ภาคเรียนที่ 2</h3><br>
<!-- table plan 8 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '8' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader8.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader8.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 8 -->
<h3>ชั้นปีการศึกษาที่ 3 ภาคเรียนที่ 3</h3><br>
<!-- table plan 9 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '9' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader9.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader9.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 9 -->
<h3>ชั้นปีการศึกษาที่ 4 ภาคเรียนที่ 1</h3><br>
<!-- table plan 10 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '10' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader10.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader10.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 10 -->
<h3>ชั้นปีการศึกษาที่ 4 ภาคเรียนที่ 2</h3><br>
<!-- table plan 11 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '11' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader11.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader11.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 11 -->
<h3>ชั้นปีการศึกษาที่ 4 ภาคฤดูร้อนเป็นต้นไป</h3><br>
<!-- table plan 12 -->
<div>
<?php
$userID = $_SESSION['studentID'];
$add = $con->query("SELECT * FROM subplantest WHERE studentID LIKE '%$userID%' AND gradersemester = '12' ");
if (mysqli_num_rows($add) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='20%'>ชื่อวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='5%'>เกรด</th>
    </tr>";
    while($addrow = mysqli_fetch_array($add))
    echo "<tr>
    <td>".$addrow["subID"]."</td>
    <td>".$addrow["subName"]."</td>
    <td>".$addrow["subCredit"]."</td>
    <td>".$addrow["grade"]."</td>
  <tr>";
  echo '</table><br> 
  <form method="post"  action="grader12.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">แก้ไขแผนการเรียน</button></form>';
  }
  else{
    echo ' 
  <form method="post"  action="grader12.php" >
  <input  type=hidden id="subStatus" name="subStatus" value="p">
    <button type="submit" class="btn btn-link btn-lg">เริ่มจำลองแผนการเรียน</button></form>';
  }
?>
<br>
<hr>
</div>
<!-- end table plan 12 -->
</div>
<!-- and fix that green text good again -->
<div class="w3-padding w3-display-bottomleft  w3-allerta" style="position: sticky;">
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