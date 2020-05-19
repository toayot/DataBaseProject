<?php 
  session_start(); 

  if (!isset($_SESSION['studentID'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: loginpage.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['studentID']);
  	header("location: loginpage.php");
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
    <style>
    </style>
</head>
<body>
    <div class="banner-image">
        <div class="banner-text">
          <a href="https://tu.ac.th/">
  
              <img  src="thanontiger.png" style="margin-left: 2%;margin-top: 2%;" width="100" height="100"> </a>
              <div class = " w3-container w3-right w3-small" style="width:90%;margin-top: 2%;">
              
              <p style="color:black; font-size:2.25vw">ระบบจัดแผนการเรียน</p>
              <p style="color: black; font-size:1.75vw;">สำหรับนักศึกษาคณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยธรรมศาสตร์ ศูนย์รังสิต</p>
              </div>
          </div>
      </div>
      <div style="margin-left:15%;margin-top:2%">
        <?php  if (isset($_SESSION["studentID"])) : ?>
        <p>ยินดีต้อนรับ <?php print_r($_SESSION["username"]); ?></p>
        <p><?php print_r($_SESSION["studentID"]); ?></p>
        <?php endif ?>
      </div>
<!--<div class='' style="margin-top: 10%">
<aside id="menu">
    <ul class="cl-menu">
        <li>
            <a href="tutorial_main.html">วิธีการใช้งาน</a>
        </li>
        <li id="albumes">
            <a href="#">ข้อมูลนักศึกษา</a>
            <ul>
                <li>
                    <a href="info.php">บัญชีของนักศึกษา</a>
                </li>
                <li>
                    <a href="#">ข้อมูลการศึกษา</a>
                </li>
                <li>
                    <a href="#">ข้อมูลแผนการเรียน</a>
                </li>
                <li>
                    <a href="Subjecttest.php">ข้อมูลหลักสูตร</a>
                </li>
            </ul>   
        </li>
         <li>
            <a href="#" onclick="logoutFunction()">ออกจากระบบ</a>
        </li>

    </ul>
</aside>
</div>-->
<!-- Delete this if line if  it not work -->
<div class="sidenav">
    <div style="margin-top: 100%;">
        <a href="tutorial_main.html">วิธีการใช้งาน</a>
        <button class="dropdown-btn">ข้อมูลนักศึกษา<i class="fa fa-caret-down"></i></button>
        <div class="dropdown-container">
            <a href="info.php">บัญชีของนักศึกษา</a>
            <a href="#">ข้อมูลการศึกษา</a>
            <a href="Subjecttest.php">ข้อมูลแผนการเรียน</a>
            <a href="#">ข้อมูลหลักสูตร</a>
        </div> 
            <button class="dropdown-btn">Course Navigator<i class="fa fa-caret-down"></i></button>
            <div class="dropdown-container">
            <a href="start.php">จำลองแผนการเรียน</a>
            <a href="#">รายวิชาที่จำเป็น</a>
        </div> 
            <a href="#" onclick="logoutFunction()">ออกจากระบบ</a>
    </div>
</div>
<!-- and fix that green text good again -->
<div class="w3-padding w3-display-bottomleft  w3-allerta">
    <iframe src="http://free.timeanddate.com/clock/i71m8hxz/n28/tlth/fn8/fs22/tct/pct/pa0/th1" frameborder="0" width="106" height="25" allowtransparency="true"></iframe>
</div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js">
        function logoutFunction() {
            swal({
            title: "ออกจากระบบ",
            text: "คุณต้องการออกจากระบบหรือไม่",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
            } else {
                swal("Your imaginary file is safe!");
            }
});
});
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