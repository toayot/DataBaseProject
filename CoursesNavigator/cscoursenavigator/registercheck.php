<!DOCTYPE html>
<html>
    
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->

</head>

<body>

<?php
	$serverName = "localhost";
    $userName = "root";
    $userPassword = "";
    $dbName = "cscoursenavigator";
    $objCon = mysqli_connect($serverName,$userName,$userPassword,$dbName);
    
    if(trim($_POST["title"]) == "")
    {
        echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "warning",
                text: "โปรดระบุคำนำหน้า",
            
              }).then((result) => {
                if (result.value) {
                    window.history.back();
                }
              })
        </script>';
        exit();
    }	

	if(trim($_POST["firstName"]) == "")
	{
        
		echo "โปรดระบุชื่อจริง";
		exit();	
	}
    
    if(trim($_POST["lastName"]) == "")
	{
		echo "โปรดระบุนามสกุล";
		exit();	
    }
    
	if(trim($_POST["password"]) == "")
	{
		echo "โปรดระบุรหัสผ่าน";
		exit();	
	}	
		
	if($_POST["password"] != $_POST["passwordCon"])
	{ echo '<script scr="sweetalert2.all.min.js">
        Swal.fire({
            icon: "warning",
            text: "รหัสผ่านไม่ตรงกัน กรุณากรอกอีกครั้ง",
        
          }).then((result) => {
            if (result.value) {
                window.history.back();
            }
          })
    </script>';
		
        exit();
	}
	
	if(trim($_POST["currentYear"]) == 0)
	{echo '<script scr="sweetalert2.all.min.js">
        Swal.fire({
            icon: "warning",
            text: "โปรดระบุชั้นปีปัจจุบัน",
        
          }).then((result) => {
            if (result.value) {
                window.history.back();
            }
          })
          </script>';
          exit();
    }	
    
    if(trim($_POST["majorID"]) == 0)
	{echo '<script scr="sweetalert2.all.min.js">
        Swal.fire({
            icon: "warning",
            text: "โปรดระบุวิชาเอกของนักศึกษา",
        
          }).then((result) => {
            if (result.value) {
                window.history.back();
            }
          })
          </script>';
          exit();
      
    }

	
	$strSQL = "SELECT * FROM registerdata WHERE studentID = '".trim($_POST['studentID'])."' ";
	$objQuery = mysqli_query($objCon,$strSQL);
    $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
	if($objResult)
	{echo '<script scr="sweetalert2.all.min.js">
        Swal.fire({
            icon: "warning",
            text: "รหัสนักศึกษานี้เคยลงทะเบียนแล้ว ไม่สามารถลงทะเบียนซ้ำ",
        
          }).then((result) => {
            if (result.value) {
                window.history.back();
            }
          })
          </script>';
          exit();
 
	}
	else
	{	
		
		$strSQL = "INSERT INTO registerdata (title, firstName, lastName, studentID, currentYear, majorID, password) VALUES 
        ('".$_POST["title"]."', '".$_POST["firstName"]."', '".$_POST["lastName"]."','".$_POST["studentID"]."','".$_POST["currentYear"]."','".$_POST["majorID"]."','".$_POST["password"]."')";
		$objQuery = mysqli_query($objCon,$strSQL);
		
        echo '<script scr="sweetalert2.all.min.js">
        Swal.fire({
            icon: "success",
            title: "ลงทะเบียนเสร็จสิ้น",
            text: "ลงทะเบียนเสร็จสิ้น กลับสู่หน้าลงชื่อเข้าใช้",
          }).then((result) => {
            if (result.value) {
                window.location.href = "loginpage.html";
            }
          })
          </script>';
     
	}

	mysqli_close($objCon);
?>
</body>

</html>