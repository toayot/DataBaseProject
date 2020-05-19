<?php
    session_start();
    require('connection.php');
    if(isset($_POST['subIDAdd'],$_POST['subNameAdd'],$_POST['subCreditAdd']))
	{
        $subIDAdd = $_POST['subIDAdd'];
        $subNameAdd = $_POST['subNameAdd'];
        $subCreditAdd = intval($_POST['subCreditAdd']);
        $gradersemester = intval($_POST['gradersemester']);
    }

    echo "รหัสวิชา $subIDAdd";
    echo " ชื่อวิชา $subNameAdd";
    echo " จำนวนเครดิต $subCreditAdd";
    $search = 0;
    $specialGrader = ["TU050","CS300"];
    foreach ($specialGrader as $count){
      if (strpos($count, $subIDAdd) === 0) {
        $search++;
    }

}

    if ($search > 0) {
    echo   '<html>
<div id="addSub" class="modal" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
      <p> โปรดระบุเกรดของคุณ </p>
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
</div>
</div>
</div>';
}    
else{
    echo  '<html>
    <div id="addSub" class="modal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
          <p> โปรดระบุเกรดของคุณ </p>
          <form method="post" action="addSub.php" >
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
            </form>
          </div>
    </div>
    </div>
    </div>';
}
echo '</html>'
?>
