<!DOCTYPE html>
<html>
    
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->

</head>

<body>
<?php
include('connection.php');

$studentID = $_GET['studentID'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];
$currentYear = $_POST['currentYear'];
$majorID = $_POST['majorID'];

$sql = "UPDATE registerdata SET password='$password', firstName='$firstName'
,lastName='$lastName', currentYear='$currentYear' ,
majorID = '$majorID' where studentID='$studentID'";

$row = mysqli_query($con,$sql);
if($row)
{echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "success",
                title: "แก้ไขข้อมูลเรียบร้อย",
               
            
              }).then((result) => {
                if (result.value) {
                    window.history.go(-2);
                }
              })
        </script>';

}

else
{
echo "ไม่สามารถแก้ไขได้ [".$sql."]";
}

?>

</body>

</html>
