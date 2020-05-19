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
<div class="main" style="margin-top: 4%;">
<p> ยืนยันเพิ่มวิชา : </p>
<?php
    if(isset($_POST['subIDAdd'],$_POST['subNameAdd'],$_POST['subCreditAdd'],$_POST['gradersemester']))
	{
        $subIDAdd = $_POST['subIDAdd'];
        $subNameAdd = $_POST['subNameAdd'];
        $subCreditAdd = intval($_POST['subCreditAdd']);
        $gradersemester = intval($_POST['gradersemester']);
    }
    ?>
    <table class="tg">
    <thead>
    <tr>   
    <th>รหัสวิชา</th>
    <th>ชื่อวิชา</th>
    <th>จำนวนเครดิต</th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo "$subIDAdd"; ?></th>
        <td><?php echo "$subNameAdd"; ?></th>
        <td><?php echo "$subCreditAdd"; ?></th>
      </tr>
        <td colspan="3">
        <?php 
            $search = 0;
            $specialGrader = ["TU050","CS300"];
            foreach ($specialGrader as $count){
            if (strpos($count, $subIDAdd) === 0) {
                $search++;
            }

        }

            if ($search > 0) {
            echo '
            <div id="addSub">
              <div>
                  <form method="post" action="addSub.php" >
                    <select id="grader" name="grader">
                        <option value="">โปรดระบุเกรด</option>      
                        <option value="S">S</option>
                        <option value="U">U</option>
                        <option value="W">W</option>
                        </select>
                            <input  type=hidden id="subIDAdd" name="subIDAdd" value="'.$subIDAdd.'">
                            <input  type=hidden id="subNameAdd" name="subNameAdd" value="'.$subNameAdd.'">
                            <input  type=hidden id="subCreditAdd" name="subCreditAdd" value="'.$subCreditAdd.'">
                            <input  type=hidden id="gradersemester" name="gradersemester" value="'.$gradersemester.'">
                                <button type="submit" class="btn btn-default" data-dismiss="modal">บันทึก</button>
                    </form>
                  </div>
            </div>';
            }    
            else{
                echo  '
                <div id="addSub">
                      <form method="post" action="addSub.php" >
                        <div  >
                        <select id="grader" name="grader">
                            <option value="">โปรดระบุเกรด</option>      
                            <option value="A">A</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="C+">C+</option>
                            <option value="C">C</option>  
                            <option value="D+">D+</option>
                            <option value="D">D</option>  
                            <option value="F">F</option>
                            <option value="W">W</option>
                            </select>
                                <input  type=hidden id="subIDAdd" name="subIDAdd" value="'.$subIDAdd.'">
                                <input  type=hidden id="subNameAdd" name="subNameAdd" value="'.$subNameAdd.'">
                                <input  type=hidden id="subCreditAdd" name="subCreditAdd" value="'.$subCreditAdd.'">
                                <input  type=hidden id="gradersemester" name="gradersemester" value="'.$gradersemester.'">
                                    <button type="submit" class="btn btn-default" data-dismiss="modal">บันทึก</button>
                        </div>
                        </form>
                
                </div>';
            }
        ?>
        </td>
      </tr>
    </tbody>
    </table>
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
</html>
