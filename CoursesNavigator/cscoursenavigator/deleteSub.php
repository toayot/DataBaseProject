<?php
    
    session_start();
    require('connection.php');
?>
<html>
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
</head>
<body>
<?php
    if(isset($_POST['subIDDel']))
	{
        $userID = $_SESSION['studentID'];
        $subIDDel = $_POST['subIDDel'];

        $code =
        "DELETE FROM subplantest WHERE subplantest.studentID = '".$userID."' AND subplantest.subID = '".$subIDDel."'";
        $con->query($code) ; 
		
        echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "success",
                title: "ลบวิชาสำเร็จ",
              }).then((result) => {
                if (result.value) {
                    window.history.go(-2);
                }
              })
        </script>';

        }
    else{
        echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "error",
                title: "ลบวิชาล้มเหลว",
                text: "ไม่สามารถลบวิชาได้ กรุณาลองอีกครั้ง",
              }).then((result) => {
                if (result.value) {
                    window.history.go(-1);
                }
              })
        </script>';

    }
?>
</body>
</html>