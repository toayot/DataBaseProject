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
<title>ตารางวิชาตามหลักสูตรปี 61</title>
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
<div class="main">
<?php
include('connection.php');
$sqs = "SELECT * FROM registerdata ,subject";
$q = mysqli_query($con,$sqs) ;
$pow = mysqli_fetch_array($q);

$userID = $_SESSION['studentID'];
$studentlist = mysqli_query($con,"SELECT * FROM registerdata WHERE studentID = '".$userID."'");
$row = mysqli_fetch_array($studentlist);


?> 
<form studentID=<?php $pow['studentID']?> method="post"> 

    <font color="#000080" size="6"><b> ข้อมูลแผนการเรียน</b></font>

<h3>      ชื่อ           <?php echo $row[1] . " " . $row[2] ;?></h3>
<h3>      สาขาวิชา      วิทยาการคอมพิวเตอร์</h3>
<h3>      สาขาวิชาเอก   <?php if($row[5]==1){echo "คอมพิวเตอร์และวิทยาการสารสนเทศ";}
                        else if($row[5]==2){echo "คอมพิวเตอร์ประยุกต์";}?></h3>
<h3>      ปีการศึกษา      ชั้นปีที่ 
<select name="year1" placeholder="ปีการศึกษา" value="ปีการศึกษา">                  
<option value="1"> 1 </option>
<option value="2"> 2 </option>
<option value="3"> 3 </option>
<option value="4"> 4 </option>
</select>    ภาคการศึกษาที่ <select name="semester1" placeholder="ภาคการศึกษา" value="ภาคการศึกษา">
<option value="1"> 1 </option>
<option value="2"> 2 </option></select>   <input type="submit" value="ค้นหา"></h3></br>
</form>

<table>
<tr>
<th width="8%">รหัสวิชา</th>
<th width="5%">หน่วยกิต</th>
<th width="15%">ชื่อวิชา</th>
<th>รายละเอียด</th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "cscoursenavigator");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
// Close Notice error
error_reporting(E_ALL ^ E_NOTICE);
$year = $_GET['year1'];
$semester = $_GET['semester1'];

$sql = "SELECT subID, subCredit, subName, subjDescription FROM subject";
if ($year != null && $semester != null){
    $result = $conn->query("SELECT * FROM subject WHERE year = '$year' AND semester = '$semester'  ORDER BY `subject`.`year` ASC, `subject`.`semester` ASC");
} else {
    $result = $conn->query("SELECT * FROM subject ORDER BY `subject`.`year` ASC, `subject`.`semester` ASC");
}

if ($result->num_rows > 0) {
// output data of each row

while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["subID"]. "</td><td>" . $row["subCredit"] . "</td><td>"
. $row["subName"]. "</td><td>" . $row["subjDescription"] . "</td></tr>";
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</div>
<div class="w3-padding w3-display-bottomleft " style="position: sticky;">
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