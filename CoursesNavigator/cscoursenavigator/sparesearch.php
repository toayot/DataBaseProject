<?php
$db_hostname = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "cscoursenavigator";
$con = mysqli_connect($db_hostname,$db_username,$db_password,$db_database);
if (!$con)
  {
  die('Could not connect: ' . mysqli_error());
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
        <title>ทดสอบหน้าค้นหา</title>
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
            <table><tr>
                <td height="30"></td>
            </tr>
                <tr>
                        <td width="30"></td>
                    <td><a href="https://tu.ac.th/">
              <img src="thanontiger.png"   width="100" height="100"> </a></td>
              <td>
                    <p style="color:black; font-size:2.4vw">&nbsp;&nbsp;&nbsp;&nbsp;ระบบจัดแผนการเรียน</p><br>
                    <p style="color: black; font-size:1.75vw;">&nbsp;&nbsp;&nbsp;&nbsp;สำหรับนักศึกษาคณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยธรรมศาสตร์ ศูนย์รังสิต</p>
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

<div style="margin-left: 15%;margin-top: 2%;">
    <form action="" method="POST">
        <input type="text" name="term" placeholder="ค้นหารายวิชา">
        <input type="submit" value="ค้นหา">
    </form>
    <br>
</div>
<div class="main">
<?php
if(!empty($_REQUEST['term'])) {
$term = $_REQUEST['term'];     
$result = $con->query("SELECT * FROM subject WHERE subID LIKE '%$term%' ORDER BY semester ASC, year ASC");
if (mysqli_num_rows($result) > 0) {
    echo "<table style=\"text-align:center;\">
    <tr>
    <th width='5%'>รหัสวิชา</th>
    <th width='5%'>หน่วยกิต</th>
    <th width='15%'>ชื่อวิชา</th>
    </tr>";
    while($row = mysqli_fetch_array($result))
    echo "<tr><td>" . $row["subID"]. "</td><td>" . $row["subCredit"] . "</td><td>". $row["subName"]. "</td><tr>";
}
else{
    echo "ไม่พบข้อมูลที่ค้นหา";
}
echo "</table>";
} 

$con->close();
?>
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
            if (confirm("คุณต้องการออกจากระบบหรือไม่")) {
            window.location = "logout.php";
            } 
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