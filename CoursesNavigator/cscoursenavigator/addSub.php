<!DOCTYPE html>
<html>
    
<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->

</head>

<body>
<?php
    session_start();
    require('connection.php');
    error_reporting(E_ALL ^ E_NOTICE);
    if(isset($_POST['subIDAdd'],$_POST['subNameAdd'],$_POST['subCreditAdd'],$_POST['grader'],$_POST['gradersemester']))
	{
        $userID = $_SESSION['studentID'];
        $subIDAdd = $_POST['subIDAdd'];
        $subNameAdd = $_POST['subNameAdd'];
        $subCreditAdd = intval($_POST['subCreditAdd']);
        $gradersemester = intval($_POST['gradersemester']);
        $grader = $_POST['grader'];
        
        $summercheck = 0;
        $specialGrader = array("3","6","9");
        foreach ($specialGrader as $count){
        if (in_array($gradersemester, $specialGrader)) {
            $summercheck++;
            }
        }
        if ($summercheck > 0) {
            $minimumCredit = 9;
        }
        else{
            $minimumCredit = 22;
        }

        if(trim($_POST["grader"]) == "")
	    {
            echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "error",
                title: "เพิ่มวิชาล้มเหลว",
                text: "โปรดระบุเกรดให้ถูกต้อง กรุณาเพิ่มวิชาใหม่อีกครั้ง",
            
              }).then((result) => {
                if (result.value) {
                    window.history.go(-4);
                }
              })
        </script>';
        
            exit();
        
        }
        $minimumCredittemp = 0;
        $creditcheck = "SELECT subCredit FROM `subplantest` WHERE `studentID`='".$userID."' AND `gradersemester` = '".$gradersemester."'";
        $creditQuery = mysqli_query($con,$creditcheck);
        while($creditcheck = mysqli_fetch_assoc($creditQuery)){
            $minimumCredittemp += $creditcheck['subCredit'];
        }
        $creditcurrectcheck = "SELECT subCredit FROM `subject` WHERE `subID`='".$subIDAdd."'";
        $creditcurrectQuery = mysqli_query($con,$creditcurrectcheck);
        while($creditcheck = mysqli_fetch_assoc($creditcurrectQuery)){
            $minimumCredittemp += $creditcheck['subCredit'];
        }
        $sum = $minimumCredit - $minimumCredittemp;
        if($sum < 0){
            echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "error",
                title: "เพิ่มวิชาล้มเหลว",
                text: "หน่วยกิตเต็มแล้ว ไม่สามารถเพิ่มวิชาได้อีก",
            
              }).then((result) => {
                if (result.value) {
                    window.history.go(-4);
                }
              })
        </script>';
        exit();
        }

        $subStatusSelect = "SELECT `subStatus` FROM `registerdata` WHERE `studentID` = '".$userID."'";
        $subStatusQuery = mysqli_query($con,$subStatusSelect);
        while($subStatusrow = mysqli_fetch_assoc($subStatusQuery)){
            $subStatus = $subStatusrow['subStatus'];
        }

        /* showdata.php  */

        // $subjectCon = "SELECT * FROM subject JOIN subplantest ON subject.subID = subplantest.subID WHERE studentID = '".$userID."' ";
        // $subjectResult = mysqli_query($con,$subjectCon);

        // if($subjectResult){
        //     while($record1 = mysqli_fetch_array($subjectResult,MYSQLI_ASSOC)){
        //         $token = 0;
        //         $con1 = (explode("_",$record1['condition1']));
        //         $con2 =  (explode("_",$record1['condition2']));
        //         $conditionCon = $record1['andOr'];
        //         $passCondition = $record1['passCondition'];
        //         //เช็คว่าวิชาที่จะลงมีเงื่อนไขไหม
        //         if( $record1['condition1'] == null && $record1['condition2'] == null){
                
        //             //     INPUT    //
        //             //              //
                    
        //             /*echo "คุณสามารถลงเรียนได้เลยเพราะ วิชา  ".$record1['subID']."  ไม่มีเงื่อนไข<br><hr>";
        //             continue;*/
        //         }
        //  //*******      กรณีที่  1    **************************************
        //         if( $record1['condition2'] != null ){
        //             $sql =  "SELECT `subID`,`grade` FROM `subplantest` WHERE subID LIKE '$con1[1]' OR subID LIKE '$con2[1]';";
        //             $result = mysqli_query($con,$sql);
        //             //เช็คว่าผู้ใช้เคยเรียนวิชาที่อยู่ในเงื่อนไขไหม
        //             if(mysqli_num_rows($result) == 0 ){
                    
        //                 echo '<script scr="sweetalert2.all.min.js">
        //                     Swal.fire({
        //                         icon: "error",
        //                         title: "เพิ่มวิชาล้มเหลว",
        //                         text: "คุณไม่ผ่านเงื่อนไขวิชา  '.$record1["subID"].'   เพราะคุณไม่เคยเรียนวิชาในเงื่อนไข",
        //                     }).then((result) => {
        //                         if (result.value) {
        //                             window.history.go(-3);
        //                         }
        //                     })
        //                 </script>';
        //                 exit();
        //             }
        //             while($record2 = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        //                 $grade = $record2['grade'];
        //                 if(  $passCondition == 'F'  ){
        //                     switch($grade){
        //                         case "A":   $grade = 'pass';
        //                                     break;
        //                         case "B+":  $grade = 'pass';
        //                                     break;
        //                         case "B":  $grade = 'pass';
        //                                     break;
        //                         case "C+":  $grade = 'pass';
        //                                     break;
        //                         case "C":   $grade = 'pass';
        //                                     break;
        //                         case "D+":  $grade = 'pass';
        //                                     break;
        //                         case "D":  $grade = 'pass';
        //                                     break;
        //                         case "F":  $grade = 'ever';
        //                                     break;
        //                         case "S":   $grade = 'pass';
        //                                     break;
        //                         case "U":   $grade = 'ever';
        //                                     break;
        //                         case "W":   $grade = 'ever';
        //                                     break;         
        //                         default :   break;
        //                     }
        //                 }else if( $passCondition == 'D+' ){
        //                     switch($grade){
        //                         case "A":   $grade = 'pass';
        //                                     break;
        //                         case "B+":  $grade = 'pass';
        //                                     break;
        //                         case "B":  $grade = 'pass';
        //                                     break;
        //                         case "C+":  $grade = 'pass';
        //                                     break;
        //                         case "C":   $grade = 'pass';
        //                                     break;
        //                         case "D+":  $grade = 'ever';
        //                                     break;
        //                         case "D":  $grade = 'ever';
        //                                     break;
        //                         case "F":  $grade = 'ever';
        //                                     break;
        //                         case "S":   $grade = 'pass';
        //                                     break;
        //                         case "U":   $grade = 'ever';
        //                                     break;
        //                         case "W":   $grade = 'ever';
        //                                     break;         
        //                         default :   break;
        //                     }
        //                 }
        //                 if( $con1[1] == $record2['subID']){
        //                 // เงื่อนไข and
        //                     if( $conditionCon == 'and' ){
        //                         if( $grade == $con1[0] && $grade == $con2[0] ){
                                    
                                    
        //                             /*echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
        //                             echo "จาก : ".$con1[1]."\tและ\t".$con2[1]."<br>";
        //                             echo "<hr>";
        //                             break;*/
        //                         }else{
                                   
        //                             echo '<script scr="sweetalert2.all.min.js">
        //                                 Swal.fire({
        //                                     icon: "error",
        //                                     title: "วิชา '.$record1["subID"].' ไม่ผ่านเงื่อนไข",
        //                                     text: "จาก : '.$con1[1].'\tและ\t'.$con2[1].'ที่ต้องผ่านทั้งสองวิชา",
        //                                 }).then((result) => {
        //                                     if (result.value) {
        //                                         window.history.go(-3);
        //                                     }
        //                                 })
        //                             </script>';
        //                         exit();
        //                             }
        //                     }else{//เงื่อนไข or 2
        //                         if( $grade == $con1[0] ){
        
        //                             //     INPUT    //
        //                             //              //
        
        //                             /*echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
        //                             echo "จาก : ".$record2['subID']."<br>";
        //                             echo "ด้วยเกรด : ".$record2['grade']."<br>";
        //                             echo "<hr>";*/
        //                         }else{
        
        //                             echo '<script scr="sweetalert2.all.min.js">
        //                                 Swal.fire({
        //                                     icon: "error",
        //                                     title: "วิชา '.$record1["subID"].' ไม่ผ่านเงื่อนไข",
        //                                     text: "เนื่องจากวิชา '.$record2['subID'].'ได้เกรด'.$record2['grade'].'",
        //                                 }).then((result) => {
        //                                     if (result.value) {
        //                                         window.history.go(-3);
        //                                     }
        //                                 })
        //                             </script>';
        //                         exit();
        //                         }
        //                     }
        //                 }//เงื่อนไข or 1
        //                 else if( $con2[1] == $record2['subID'] ){
        //                     if( $grade == $con2[0] ){
                                
        //                         //     INPUT    //
        //                         //              //
        
        //                         /*echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
        //                         echo "จาก : ".$record2['subID']."<br>";
        //                         echo "ด้วยเกรด : ".$record2['grade']."<br>";
        //                         echo "<hr>";
        //                         break;*/
        //                     }
        //                 }
        //             }   
        //         }
        // //************    กรณีที่ 2    *****************************************
        //         else{  
        //             $sql =  "SELECT `subID`,`grade` FROM `subplantest` WHERE subID LIKE '$con1[1]'";
        //             $result = mysqli_query($con,$sql);
        //             //เช็คว่าผู้ใช้เคยเรียนวิชาที่อยู่ในเงื่อนไขไหม
        //             if(mysqli_num_rows($result) == 0 ){
                        
        //                 /*echo '<script scr="sweetalert2.all.min.js">
        //                 Swal.fire({
        //                     icon: "error",
        //                     title: "เพิ่มวิชาล้มเหลว",
        //                     text: "คุณไม่ผ่านเงื่อนไขวิชา  '.$record1["subID"].'   เพราะคุณไม่เคยเรียนวิชาในเงื่อนไข",
        //                 }).then((result) => {
        //                     if (result.value) {
        //                         window.history.go(-3);
        //                     }
        //                 })
        //             </script>';
        //             exit();
        //             }*/
        //             while($record2 = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        //                 $grade = $record2['grade'];
        //                 if(  $passCondition == 'F'  ){
        //                     switch($grade){
        //                         case "A":   $grade = 'pass';
        //                                     break;
        //                         case "B+":  $grade = 'pass';
        //                                     break;
        //                         case "B":  $grade = 'pass';
        //                                     break;
        //                         case "C+":  $grade = 'pass';
        //                                     break;
        //                         case "C":   $grade = 'pass';
        //                                     break;
        //                         case "D+":  $grade = 'pass';
        //                                     break;
        //                         case "D":  $grade = 'pass';
        //                                     break;
        //                         case "F":  $grade = 'ever';
        //                                     break;
        //                         case "S":   $grade = 'pass';
        //                                     break;
        //                         case "U":   $grade = 'ever';
        //                                     break;
        //                         case "W":   $grade = 'ever';
        //                                     break;         
        //                         default :   break;
        //                     }
        //                 }else if( $passCondition == 'D+' ){
        //                     switch($grade){
        //                         case "A":   $grade = 'pass';
        //                                     break;
        //                         case "B+":  $grade = 'pass';
        //                                     break;
        //                         case "B":  $grade = 'pass';
        //                                     break;
        //                         case "C+":  $grade = 'pass';
        //                                     break;
        //                         case "C":   $grade = 'pass';
        //                                     break;
        //                         case "D+":  $grade = 'ever';
        //                                     break;
        //                         case "D":  $grade = 'ever';
        //                                     break;
        //                         case "F":  $grade = 'ever';
        //                                     break;
        //                         case "S":   $grade = 'pass';
        //                                     break;
        //                         case "U":   $grade = 'ever';
        //                                     break;
        //                         case "W":   $grade = 'ever';
        //                                     break;         
        //                         default :   break;
        //                     }
        //                 }
        //                 if( $con1[1] == $record2['subID']){
        //                     if( $grade == $con1[0] ){
        
        //                         //     INPUT    //
        //                         //              //
        
        //                         /*echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
        //                         echo "จาก : ".$record2['subID']."<br>";
        //                         echo "ด้วยเกรด : ".$record2['grade']."<br>";
        //                         echo "<hr>";
        //                         break;*/
        //                     }else{
        
        //                         //     INPUT    //
        //                         //              //
        
        //                         echo '<script scr="sweetalert2.all.min.js">
        //                         Swal.fire({
        //                             icon: "error",
        //                             title: "วิชา '.$record1["subID"].' ไม่ผ่านเงื่อนไข",
        //                             text: "เนื่องจากวิชา '.$record2['subID'].'ได้เกรด'.$record2['grade'].'",
        //                         }).then((result) => {
        //                             if (result.value) {
        //                                 window.history.go(-3);
        //                             }
        //                         })
        //                     </script>';
        //                 exit();
        //                     }
        //                 }
        //             }
        //         }
        //     }
        // }
        // }else{
        //     echo "ผิดพลาด";
        // }


        /* end of showdata.php  */

        $strSQL = "SELECT subID FROM `subplantest` WHERE studentID='".$userID."' AND subID='".$subIDAdd."'";
        $objQuery = mysqli_query($con,$strSQL);
        $objResult = mysqli_fetch_array($objQuery,MYSQLI_ASSOC);
        // ลงซ้ำ
        // $passCo = "SELECT `passCondition` FROM `subject` WHERE `subID`='".$subIDAdd."'";
        // $passCon = mysqli_query($con,$passCo);
        // $passConn = mysqli_fetch_array($passCon);
        // $Count = "SELECT COUNT(`subID`) FROM `subplantest` WHERE `subID`='".$subIDAdd."' AND `studentID`= '".$userID."' AND `subStatus`='pp'";
        // $Countsub = mysqli_query($con,$Count);
        // $CountsubPre = mysqli_fetch_array($Countsub,MYSQLI_ASSOC);
        // if($objResult)
        // {
            // if($passConn="D+"){
            //     if($grade="D+"){
            //         $code = "
            //             INSERT INTO subplantest (studentID, subID, subName, subCredit, grade, gradersemester,subStatus)
            //             VALUES ('".$userID."' ,'".$subIDAdd."','".$subNameAdd."','".$subCreditAdd."','".$grader."','".$gradersemester."','".$subStatus."')";
            //             $con->query($code) ; 
        
            //             echo '<script scr="sweetalert2.all.min.js">
            //             Swal.fire({
            //             icon: "success",
            //             title: "เพิ่มวิชาสำเร็จ 1",
            
            //               }).then((result) => {
            //             if (result.value) {
            //             window.history.go(-4);
            //             }
            //               })
            //             </script>';
            //     }if ($grade="D") {
            //         $code = "
            //             INSERT INTO subplantest (studentID, subID, subName, subCredit, grade, gradersemester,subStatus)
            //             VALUES ('".$userID."' ,'".$subIDAdd."','".$subNameAdd."','".$subCreditAdd."','".$grader."','".$gradersemester."','".$subStatus."')";
            //             $con->query($code) ; 
        
            //             echo '<script scr="sweetalert2.all.min.js">
            //             Swal.fire({
            //             icon: "success",
            //             title: "เพิ่มวิชาสำเร็จ 2",
            
            //               }).then((result) => {
            //             if (result.value) {
            //             window.history.go(-4);
            //             }
            //               })
            //             </script>';
            //     }if ($grade="F") {
            //         $code = "
            //             INSERT INTO subplantest (studentID, subID, subName, subCredit, grade, gradersemester,subStatus)
            //             VALUES ('".$userID."' ,'".$subIDAdd."','".$subNameAdd."','".$subCreditAdd."','".$grader."','".$gradersemester."','".$subStatus."')";
            //             $con->query($code) ; 
        
            //             echo '<script scr="sweetalert2.all.min.js">
            //             Swal.fire({
            //             icon: "success",
            //             title: "เพิ่มวิชาสำเร็จ 3",
            
            //               }).then((result) => {
            //             if (result.value) {
            //             window.history.go(-4);
            //             }
            //               })
            //             </script>';
            //     } else {
            //         if($CountsubPre="1"){
            //             # code...ลงไม่ได้เพราะผ่านแล้ว
            //             echo '<script scr="sweetalert2.all.min.js">
            //               Swal.fire({
            //                 icon: "error",
            //                 title: "เพิ่มวิชาล้มเหลว",
            //                 text: "คุณได้ผ่านวิชานี้ไปก่อนหน้าแล้ว กรุณาเพิ่มวิชาอื่น",
            
            //                 }).then((result) => {
            //                  if (result.value) {
            //                   window.history.go(-4);
            //                   }
            //                    })
            //               </script>';
            //         }else{
            //             # code...ลงได้ ต่อจากนี้จะแล้วลงไม่ได้อีก
            //             $code = "
            //             INSERT INTO subplantest (studentID, subID, subName, subCredit, grade, gradersemester,subStatus)
            //             VALUES ('".$userID."' ,'".$subIDAdd."','".$subNameAdd."','".$subCreditAdd."','".$grader."','".$gradersemester."','"pp"')";
            //             $con->query($code) ; 
        
            //             echo '<script scr="sweetalert2.all.min.js">
            //             Swal.fire({
            //             icon: "success",
            //             title: "เพิ่มวิชาสำเร็จ 5",
            
            //               }).then((result) => {
            //             if (result.value) {
            //             window.history.go(-4);
            //             }
            //               })
            //             </script>';
            //         }
                    
            //     }
                
                
            // }# code...

        if($objResult)
        {echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "error",
                title: "เพิ่มวิชาล้มเหลว",
                text: "คุณได้เพิ่มวิชานี้ไปก่อนหน้าแล้ว กรุณาเพิ่มวิชาอื่น",
            
              }).then((result) => {
                if (result.value) {
                    window.history.go(-4);
                }
              })
        </script>';
            
        }
        else
        {
        $code = "
                INSERT INTO subplantest (studentID, subID, subName, subCredit, grade, gradersemester,subStatus)
                VALUES ('".$userID."' ,'".$subIDAdd."','".$subNameAdd."','".$subCreditAdd."','".$grader."','".$gradersemester."','".$subStatus."')";
        $con->query($code) ; 
        
        echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "success",
                title: "เพิ่มวิชาสำเร็จ",
            
              }).then((result) => {
                if (result.value) {
                    window.history.go(-4);
                }
              })
        </script>';
      

        }
    }
    else{
        echo '<script scr="sweetalert2.all.min.js">
            Swal.fire({
                icon: "error",
                text: "ไม่สามารถเพิ่มวิชาได้ กรุณาลองอีกครั้ง",
            
              }).then((result) => {
                if (result.value) {
                    window.history.go(-4);
                }
              })
        </script>';
     
    }

?>
</body>

</html>




