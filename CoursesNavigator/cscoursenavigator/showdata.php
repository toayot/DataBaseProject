<?php
require('.connection.php');  //**** */ ใส่ path *****

        /* showdata.php  */
        $subjectCon = "SELECT * FROM subject JOIN subplantest ON subject.subID = subplantest.subID WHERE studentID = '".$userID."' ";
        $subjectResult = mysqli_query($con,$subjectCon);

        if($subjectResult){
            while($record1 = mysqli_fetch_array($subjectResult,MYSQLI_ASSOC)){
                $token = 0;
                $con1 = (explode("_",$record1['condition1']));
                $con2 =  (explode("_",$record1['condition2']));
                $conditionCon = $record1['andOr'];
                $passCondition = $record1['passCondition'];
                //เช็คว่าวิชาที่จะลงมีเงื่อนไขไหม
                if( $record1['condition1'] == null && $record1['condition2'] == null){
                
                    //     INPUT    //
                    //              //
                    
                    echo "คุณสามารถลงเรียนได้เลยเพราะ วิชา  ".$record1['subID']."  ไม่มีเงื่อนไข<br><hr>";
                    continue;
                }
         //*******      กรณีที่  1    **************************************
                if( $record1['condition2'] != null ){
                    $sql =  "SELECT `subID`,`grade` FROM `subplantest` WHERE subID LIKE '$con1[1]' OR subID LIKE '$con2[1]';";
                    $result = mysqli_query($con,$sql);
                    //เช็คว่าผู้ใช้เคยเรียนวิชาที่อยู่ในเงื่อนไขไหม
                    if(mysqli_num_rows($result) == 0 ){
                    
                        //     INPUT    //
                        //              //
            
                        echo "คุณไม่ผ่านเงื่อนไขวิชา  ".$record1['subID']."   เพราะคุณไม่เคยเรียนวิชาในเงื่อนไข<br><hr>";
                        continue;
                    }
                    while($record2 = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $grade = $record2['grade'];
                        if(  $passCondition == 'F'  ){
                            switch($grade){
                                case "A":   $grade = 'pass';
                                            break;
                                case "B+":  $grade = 'pass';
                                            break;
                                case "B":  $grade = 'pass';
                                            break;
                                case "C+":  $grade = 'pass';
                                            break;
                                case "C":   $grade = 'pass';
                                            break;
                                case "D+":  $grade = 'pass';
                                            break;
                                case "D":  $grade = 'pass';
                                            break;
                                case "F":  $grade = 'ever';
                                            break;
                                case "S":   $grade = 'pass';
                                            break;
                                case "U":   $grade = 'ever';
                                            break;
                                case "W":   $grade = 'ever';
                                            break;         
                                default :   break;
                            }
                        }else if( $passCondition == 'D+' ){
                            switch($grade){
                                case "A":   $grade = 'pass';
                                            break;
                                case "B+":  $grade = 'pass';
                                            break;
                                case "B":  $grade = 'pass';
                                            break;
                                case "C+":  $grade = 'pass';
                                            break;
                                case "C":   $grade = 'pass';
                                            break;
                                case "D+":  $grade = 'ever';
                                            break;
                                case "D":  $grade = 'ever';
                                            break;
                                case "F":  $grade = 'ever';
                                            break;
                                case "S":   $grade = 'pass';
                                            break;
                                case "U":   $grade = 'ever';
                                            break;
                                case "W":   $grade = 'ever';
                                            break;         
                                default :   break;
                            }
                        }
                        if( $con1[1] == $record2['subID']){
                        // เงื่อนไข and
                            if( $conditionCon == 'and' ){
                                if( $grade == $con1[0] && $grade == $con2[0] ){
                                    
                                    //     INPUT    //
                                    //              //
                                    
                                    echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
                                    echo "จาก : ".$con1[1]."\tและ\t".$con2[1]."<br>";
                                    echo "<hr>";
                                    break;
                                }else{
                                   
                                    //     INPUT    //
                                    //              //
                                 
                                    echo "คุณไม่ผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
                                    echo "จาก : ".$con1[1]."\tและ\t".$con2[1]."ที่ต้องผ่านทั้งสองวิชา<br>";
                                    echo "<hr>";
                                    break;
                                }
                            }else{//เงื่อนไข or 2
                                if( $grade == $con1[0] ){
        
                                    //     INPUT    //
                                    //              //
        
                                    echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
                                    echo "จาก : ".$record2['subID']."<br>";
                                    echo "ด้วยเกรด : ".$record2['grade']."<br>";
                                    echo "<hr>";
                                    break;
                                }else{
        
                                    //     INPUT    //
                                    //              //
        
                                    echo "คุณไม่ผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
                                    echo "จาก : ".$record2['subID']."<br>";
                                    echo "ด้วยเกรด : ".$record2['grade']."<br>";
                                    echo "<hr>";
                                    break;
                                }
                            }
                        }//เงื่อนไข or 1
                        else if( $con2[1] == $record2['subID'] ){
                            if( $grade == $con2[0] ){
                                
                                //     INPUT    //
                                //              //
        
                                echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
                                echo "จาก : ".$record2['subID']."<br>";
                                echo "ด้วยเกรด : ".$record2['grade']."<br>";
                                echo "<hr>";
                                break;
                            }
                        }
                    }   
                }
        //************    กรณีที่ 2    *****************************************
                else{  
                    $sql =  "SELECT `subID`,`grade` FROM `subplantest` WHERE subID LIKE '$con1[1]';";
                    $result = mysqli_query($con,$sql);
                    //เช็คว่าผู้ใช้เคยเรียนวิชาที่อยู่ในเงื่อนไขไหม
                    if(mysqli_num_rows($result) == 0 ){
                        
                        //     INPUT    //
                        //              //
        
                        echo "คุณไม่ผ่านเงื่อนไขวิชา  ".$record1['subID']."   เพราะคุณไม่เคยเรียนวิชาในเงื่อนไข<br><hr>";
                        continue;
                    }
                    while($record2 = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $grade = $record2['grade'];
                        if(  $passCondition == 'F'  ){
                            switch($grade){
                                case "A":   $grade = 'pass';
                                            break;
                                case "B+":  $grade = 'pass';
                                            break;
                                case "B":  $grade = 'pass';
                                            break;
                                case "C+":  $grade = 'pass';
                                            break;
                                case "C":   $grade = 'pass';
                                            break;
                                case "D+":  $grade = 'pass';
                                            break;
                                case "D":  $grade = 'pass';
                                            break;
                                case "F":  $grade = 'ever';
                                            break;
                                case "S":   $grade = 'pass';
                                            break;
                                case "U":   $grade = 'ever';
                                            break;
                                case "W":   $grade = 'ever';
                                            break;         
                                default :   break;
                            }
                        }else if( $passCondition == 'D+' ){
                            switch($grade){
                                case "A":   $grade = 'pass';
                                            break;
                                case "B+":  $grade = 'pass';
                                            break;
                                case "B":  $grade = 'pass';
                                            break;
                                case "C+":  $grade = 'pass';
                                            break;
                                case "C":   $grade = 'pass';
                                            break;
                                case "D+":  $grade = 'ever';
                                            break;
                                case "D":  $grade = 'ever';
                                            break;
                                case "F":  $grade = 'ever';
                                            break;
                                case "S":   $grade = 'pass';
                                            break;
                                case "U":   $grade = 'ever';
                                            break;
                                case "W":   $grade = 'ever';
                                            break;         
                                default :   break;
                            }
                        }
                        if( $con1[1] == $record2['subID']){
                            if( $grade == $con1[0] ){
        
                                //     INPUT    //
                                //              //
        
                                echo "คุณผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
                                echo "จาก : ".$record2['subID']."<br>";
                                echo "ด้วยเกรด : ".$record2['grade']."<br>";
                                echo "<hr>";
                                break;
                            }else{
        
                                //     INPUT    //
                                //              //
        
                                echo "คุณไม่ผ่านเงื่อนไขวิชา  ".$record1['subID']."<br>";
                                echo "จาก : ".$record2['subID']."<br>";
                                echo "ด้วยเกรด : ".$record2['grade']."<br>";
                                echo "<hr>";
                                break;
                            }
                        }
                    }
                }
            }
        }else{
            echo "ผิดพลาด";
        }


        /* end of showdata.php  */
mysqli_close($con);
?>