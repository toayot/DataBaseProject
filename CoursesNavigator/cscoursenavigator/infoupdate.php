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
<html lang>
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
    <title>บัญชีนักศึกษา</title>
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

<div class="main"  >
    <?php
include('connection.php');
$sql = "SELECT * FROM registerdata WHERE studentID = '".$_SESSION['studentID']."' ";
$q = mysqli_query($con,$sql) ;
$row = mysqli_fetch_array($q);
?> 
    <FONT  COLOR=#000080 SIZE=6><B>&ensp;ข้อมูลส่วนตัวของนักศึกษา</B></FONT></TD></TR>

<form action="processInfo.php?studentID=<?=$row['studentID']?>" method="post"> 

<table BORDER=0 CELLSPACING=2 CELLPADDING=0  style="width: 50%">
<tr></tr>
<tr>
<th>รหัสนักศึกษา</th>
<td><p><?php print_r($_SESSION["studentID"]); ?></p></td>
</tr>

<tr>
<th>ชื่อ</th>
<td><input type="text" name="firstName" placeholder="ชื่อ" maxlength="30"
value="<?php echo $row['firstName']; ?>" />
</td>
</tr>

<tr>
<th>นามสกุล</th>
<td><input type="text" name="lastName"  maxlength="30" placeholder="นามสกุล" 
value="<?php echo $row['lastName']; ?>" />
</td>
</tr>

<tr>
<th>ปีการศึกษา</th>
<td>
<SELECT name="currentYear" placeholder="ภาคการศึกษาปัจจุบัน" value="<?php echo $row['currentYear']; ?>" >
<OPTION VALUE="<?php echo $row['currentYear']; ?>" ><?php if($row['currentYear']==1){echo "ชั้นปีที่ 1 ภาคการศึกษาที่ 1";}
                                            else if($row['currentYear']==2){echo "ชั้นปีที่ 1 ภาคการศึกษาที่ 2";}
                                            else if($row['currentYear']==3){echo "ชั้นปีที่ 1 ภาคฤดูร้อน";}
                                            else if($row['currentYear']==4){echo "ชั้นปีที่ 2 ภาคการศึกษาที่ 1";}
                                            else if($row['currentYear']==5){echo "ชั้นปีที่ 2 ภาคการศึกษาที่ 2";}
                                            else if($row['currentYear']==6){echo "ชั้นปีที่ 2 ภาคฤดูร้อน";}
                                            else if($row['currentYear']==7){echo "ชั้นปีที่ 3 ภาคการศึกษาที่ 1";}
                                            else if($row['currentYear']==8){echo "ชั้นปีที่ 3 ภาคการศึกษาที่ 2";}
                                            else if($row['currentYear']==9){echo "ชั้นปีที่ 3 ภาคฤดูร้อน";}
                                            else if($row['currentYear']==10){echo "ชั้นปีที่ 4 ภาคการศึกษาที่ 1";}
                                            else if($row['currentYear']==11){echo "ชั้นปีที่ 4 ภาคการศึกษาที่ 2";}
                                            else if($row['currentYear']==12){echo "ชั้นปีสูง(5ขึ้นไป)";}  ?>
<option value="1">ชั้นปีที่ 1 ภาคการศึกษาที่ 1</option>
<option value="2">ชั้นปีที่ 1 ภาคการศึกษาที่ 2</option>
<option value="3">ชั้นปีที่ 1 ภาคฤดูร้อน</option>
<option value="4">ชั้นปีที่ 2 ภาคการศึกษาที่ 1</option>
<option value="5">ชั้นปีที่ 2 ภาคการศึกษาที่ 2</option>
<option value="6">ชั้นปีที่ 2 ภาคฤดูร้อน</option>
<option value="7">ชั้นปีที่ 3 ภาคการศึกษาที่ 1</option>
<option value="8">ชั้นปีที่ 3 ภาคการศึกษาที่ 2</option>
<option value="9">ชั้นปีที่ 3 ภาคฤดูร้อน</option>
<option value="10">ชั้นปีที่ 4 ภาคการศึกษาที่ 1</option>
<option value="11">ชั้นปีที่ 4 ภาคการศึกษาที่ 2</option>
<option value="12">ชั้นปีสูง</option>
</SELECT>
</td>
</tr>

<tr>
<th>สาขาวิชาเอก</th>
<td>

<SELECT name="majorID" placeholder="สาขาวิชาเอก" ?>" >
<OPTION VALUE="<?php echo $row['majorID']; ?>"> 
<?php if($row['majorID']==1){echo "คอมพิวเตอร์และวิทยาการสารสนเทศ";}
else if($row['majorID']==2){echo "คอมพิวเตอร์ประยุกต์";}  ?>
<OPTION VALUE="1">คอมพิวเตอร์และวิทยาการสารสนเทศ
<OPTION VALUE="2">คอมพิวเตอร์ประยุกต์
</SELECT>

</td>
</tr>

<tr>
<th>รหัสผ่าน</th>
<td><input type="text" name="password" size="30" placeholder="รหัสผ่าน" 
value="<?php echo $row['password']; ?>" />
</td>
</tr>
<tr></tr>
<tr>
<td><a href="info.php" class="btn btn-link btn-lg" role="button">ย้อนกลับ</a></td>
<td><input class="btn btn-info btn-lg" type="submit" value="บันทึก" /></td>
</tr> 
</table>

</form>

</div>

    <div class="w3-padding w3-display-bottomleft " style="position: relative;">
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