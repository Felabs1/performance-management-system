<?php

require_once("./students.php");

$student = new Student;

if(isset($_GET['courses'])){
    $myrow = $student->fetch("SELECT * FROM courses");
    foreach($myrow as $row){
        ?>
<option value="<?php echo $row['code'] ?>"><?php echo $row['name']; ?></option>
<?
    }
    exit();
}

if(isset($_GET['student_interface'])){
    $myrow = $student->fetch("SELECT * FROM student WHERE `name` LIKE '%".$_GET['student_interface']."%'");
    ?>
<table class="w3-table w3-bordered w3-small">
    <tr>
        <th>Adm No</th>
        <th>Student Name</th>
        <th>Action</th>
    </tr>
    <?php 
    foreach($myrow as $row){
        ?>
    <tr>
        <td><?php echo $row['admission']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><button class="w3-button w3-padding-small w3-round w3-border"
                onclick="openModalInTable('newEntry', `./resources/UI.php?newEntry=<?php echo $row['admission']; ?>`)">New
                Entry</button>&nbsp;<button class="w3-button w3-padding-small w3-round w3-border"
                onclick="openModalInTable('updateEntry', `./resources/UI.php?updateEntry=<?php echo $row['admission']; ?>`)">Update
                Entry</button>&nbsp;<button class="w3-button w3-padding-small w3-round w3-border"
                onclick="openModalInTable('progress', `./resources/UI.php?progress=<?php echo $row['admission']; ?>`)">Progress

            </button>
        </td>
    </tr>

    <?php
    }


?>
</table>
<?php
exit();
}

if(isset($_GET['newEntry'])){
    $myrow = $student->fetch("SELECT * FROM student WHERE admission = '".$_GET['newEntry']."'");
    foreach($myrow as $row){
        ?>
<div class="w3-modal-content w3-white w3-round-large w3-padding">
    <div class="w3-container">
        <span class="w3-large"><?php echo $_GET['newEntry']; ?></span><br>
        <span class="w3-small"><b>Name: </b><?php echo $row['name']; ?>&nbsp;&nbsp;<b>Course Code:
            </b><?php echo $row['course']; ?>&nbsp;&nbsp;<b>Course Name:
            </b><?php $myrow2 = $student->fetch("SELECT * FROM courses WHERE code = '".$row['course']."'");
            foreach($myrow2 as $row2){
                echo $row2['name'];
            }
            
            ?>|&nbsp;&nbsp;<b>Units: </b>[<?php $myrow3 = $student->fetch("SELECT * FROM unit WHERE course = '".$row['course']."'");
            foreach($myrow3 as $row3){
                echo $row3['unitCode'] . ",";
            }
             ?>]</span>
        <div class="w3-right"><button class="w3-button w3-border w3-round-xxlarge"
                onclick="closeModal('newEntry')">&times;</button></div>

    </div>
    <hr>

    <?php
    }
    ?>

    <form id="frmEntry" class="w3-container">
        <label>Exam</label>
        <input type="hidden" name="admission" value="<?php echo $_GET['newEntry']; ?>">
        <select name="exam" id="exam" class="w3-select w3-border w3-round">
            <?php
            $myrow4 = $student->fetch("SELECT * FROM schedule WHERE course = '".$row['course']."'");
            foreach($myrow4 as $row4){
                ?>
            <option value="<?php echo $row4['id']; ?>"><?php echo $row4['exam_name']; ?> |
                <?php echo $row4['exam_date']; ?></option>
            <?php
            }
            ?>
        </select><br>
        <label>Unit</label>
        <select name="unit" id="unit" class="w3-select w3-border w3-round">
            <?php
            foreach($myrow3 as $row3){
                ?>
            <option value="<?php echo $row3['unitCode'] ?>">
                (<?php echo $row3['unitCode']; ?>)<?php echo $row3['name']; ?></option>
            <?php
            }
            ?>
        </select><br>
        <label>Marks</label>
        <input type="number" max="100" name="marks" id="marks" min="0" required class="w3-input w3-border w3-round"><br>
        <button class="w3-button w3-light-grey w3-block w3-round" type="button" onclick="newEntry()">Accept</button><br>
    </form>
</div>
<?php
exit();
}

if(isset($_GET['updateEntry'])){
    $myrow = $student->fetch("SELECT * FROM student WHERE admission = '".$_GET['updateEntry']."'");
    foreach($myrow as $row){
        ?>
<div class="w3-modal-content w3-white w3-round-large w3-padding">
    <div class="w3-container">
        <span class="w3-large"><?php echo $_GET['updateEntry']; ?></span><br>
        <span class="w3-small"><b>Name: </b><?php echo $row['name']; ?>&nbsp;&nbsp;<b>Course Code:
            </b><?php echo $row['course']; ?>&nbsp;&nbsp;<b>Course Name:
            </b><?php $myrow2 = $student->fetch("SELECT * FROM courses WHERE code = '".$row['course']."'");
            foreach($myrow2 as $row2){
                echo $row2['name'];
            }
            
            ?>|&nbsp;&nbsp;<b>Units: </b>[<?php $myrow3 = $student->fetch("SELECT * FROM unit WHERE course = '".$row['course']."'");
            foreach($myrow3 as $row3){
                echo $row3['unitCode'] . ",";
            }
             ?>]</span>
        <div class="w3-right"><button class="w3-button w3-border w3-round-xxlarge"
                onclick="closeModal('updateEntry')">&times;</button></div>

    </div>
    <hr>

    <?php
    }
    ?>

    <form action="./resources/process.php?new_entry=true" id="frmUpdateEntry" class="w3-container">
        <label>Exam</label>
        <input type="hidden" name="admission" value="<?php echo $_GET['updateEntry']; ?>">
        <select name="exam" id="exam" class="w3-select w3-border w3-round"
            onfocus="retrieveData('unit', `./resources/UI.php?examIdd=${this.value}&admission=<?php echo $_GET['updateEntry']; ?>`)"
            onchange="retrieveData('unit', `./resources/UI.php?examIdd=${this.value}&admission=<?php echo $_GET['updateEntry']; ?>`)">
            <?php
            $myrow4 = $student->fetch("SELECT * FROM schedule WHERE course = '".$row['course']."'");
            foreach($myrow4 as $row4){
                ?>
            <option value="<?php echo $row4['id']; ?>"><?php echo $row4['exam_name']; ?> |
                <?php echo $row4['exam_date']; ?></option>
            <?php
            }
            ?>
        </select><br>
        <label>Unit</label>
        <select name="unit" id="unit" class="w3-select w3-border w3-round"
            onfocus="retrieveMarksData('marks', `./resources/UI.php?unitIdd=${this.value}`)"
            onchange="retrieveMarksData('marks', `./resources/UI.php?unitIdd=${this.value}`)">

        </select><br>
        <label>Marks</label>
        <input type="number" max="100" name="marks" id="marks" min="0" required class="w3-input w3-border w3-round"><br>
        <button class="w3-button w3-light-grey w3-block w3-round" type="button"
            onclick="updateEntry()">Update</button><br>
    </form>
</div>
<?php
exit();
}

if(isset($_GET['examIdd'])){
    $myrow = $student->fetch("SELECT * FROM `entry` WHERE exam_name = '".$_GET['examIdd']."' AND student_admission = '".$_GET['admission']."'");
    foreach($myrow as $row){
        ?>
<option value="<?php echo $row['id'] ?>">
    (<?php echo $row['unit']; ?>)<?php $myrow2 = $student->fetch("SELECT * FROM unit WHERE unitCode = '".$row['unit']."'");
    foreach($myrow2 as $row2){
        echo $row2['name'];
    } ?> => <?php echo $row['marks']; ?>
</option>
<?php
    }
    exit();
}

if(isset($_GET['unitIdd'])){
    // echo $_GET['unitIdd'];
    $myrow = $student->fetch("SELECT * FROM `entry` WHERE id = '".$_GET['unitIdd']."'");
    foreach($myrow as $row){
        echo $row['marks'];
    }
    exit();
}

if(isset($_GET['course_interface'])){
    $myrow = $student->fetch("SELECT * FROM `courses` WHERE `name` LIKE '%".$_GET['course_interface']."%'");
    ?>
<table class="w3-table w3-bordered w3-small">
    <tr>
        <th>Course Code</th>
        <th>Course Name</th>
        <th>Units</th>
        <th>Student COunt</th>
    </tr>
    <?php

    foreach($myrow as $row){
        ?>
    <tr>
        <td><?php echo $row['code']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php $myrow3 = $student->fetch("SELECT * FROM unit WHERE course = '".$row['code']."'"); 
        echo count($myrow3) ?></td>
        <td><?php $myrow2 = $student->fetch("SELECT * FROM student WHERE course = '".$row['code']."'");
        echo count($myrow2);
         ?></td>
    </tr>
    <?php
    }

    ?>

</table>
<?php
exit();
}

if(isset($_GET['progress'])){
    $myrow = $student->fetch("SELECT * FROM student WHERE admission = '".$_GET['progress']."'");
    foreach($myrow as $row){
        ?>
<div class="w3-modal-content w3-white w3-round-large w3-padding">
    <div class="w3-container">
        <span class="w3-large"><?php echo $_GET['progress']; ?></span><br>
        <span class="w3-small"><b>Name: </b><?php echo $row['name']; ?>&nbsp;&nbsp;<b>Course Code:
            </b><?php echo $row['course']; ?>&nbsp;&nbsp;<b>Course Name:
            </b><?php $myrow2 = $student->fetch("SELECT * FROM courses WHERE code = '".$row['course']."'");
            foreach($myrow2 as $row2){
                echo $row2['name'];
            }
            
            ?>|&nbsp;&nbsp;<b>Units: </b>[<?php $myrow3 = $student->fetch("SELECT * FROM unit WHERE course = '".$row['course']."'");
            foreach($myrow3 as $row3){
                echo $row3['unitCode'] . ",";
            }
             ?>]</span>
        <div class="w3-right"><button class="w3-button w3-border w3-round-xxlarge"
                onclick="closeModal('progress')">&times;</button></div>

    </div>
    <hr>

    <?php
    }
    ?>

    <form action="./resources/process.php?new_entry=true" id="frmUpdateEntry" class="w3-container">
        <label>Exam</label>
        <input type="hidden" name="admission" value="<?php echo $_GET['updateEntry']; ?>">
        <select name="exam" id="exam" class="w3-select w3-border w3-round"
            onfocus="retrieveData('unit', `./resources/UI.php?examIdd2=${this.value}&admission=<?php echo $_GET['progress']; ?>`)"
            onchange="retrieveData('unit', `./resources/UI.php?examIdd2=${this.value}&admission=<?php echo $_GET['progress']; ?>`)">
            <?php
            $myrow4 = $student->fetch("SELECT * FROM schedule WHERE course = '".$row['course']."'");
            foreach($myrow4 as $row4){
                ?>
            <option value="<?php echo $row4['id']; ?>"><?php echo $row4['exam_name']; ?> |
                <?php echo $row4['exam_date']; ?></option>
            <?php
            }
            ?>
        </select><br><br>
        <!-- <label>Unit</label> -->
        <div name="unit" id="unit" class="w3-border w3-round">

        </div><br>
        <button class="w3-button w3-light-grey w3-block w3-round" type="button"
            onclick="printReport('unit')">Print</button><br>
    </form>
</div>
<?php
exit();
}

if(isset($_GET['examIdd2'])){
    $myrow = $student->fetch("SELECT * FROM `entry` WHERE exam_name = '".$_GET['examIdd2']."' AND student_admission = '".$_GET['admission']."'");
    ?>
<table class="w3-table w3-bordered w3-padding w3-small">
    <caption><b>PROGRESS REPORT FOR <?php 
     $myrow7 = $student->fetch("SELECT * FROM schedule WHERE id = '".$_GET['examIdd2']."'");
     foreach($myrow7 as $row7){
        //  echo $row7['exam_name'];
        ?>
            <span class="w3-text-blue"><?php echo $row7['exam_name']; ?></span> Exams Done On
            <?php echo $row7['exam_date']; ?>
            <?php
     }
     $myrow8 = $student->fetch("SELECT * FROM student WHERE admission = '".$_GET['admission']."'");
    ?></b></caption>
    <caption><b>Name: <?php foreach($myrow8 as $row8){echo $row8['name'];}  ?></b></caption>
    <caption><b>Admission: <?php echo $_GET['admission'];  ?></b></caption>
    <caption><b>Course: <?php
     $myrow9 = $student->fetch("SELECT * FROM courses WHERE code = '".$row7['course']."'");
     foreach($myrow9 as $row9){
         echo $row9['name'];
     }
      ?></b></caption>
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Marks</th>
        <th>Grade</th>
    </tr>
    <?php
    foreach($myrow as $row){
        ?>
    <tr>
        <td><?php echo $row['unit'] ?></td>
        <td><?php $myrow2 = $student->fetch("SELECT * FROM unit WHERE unitCode = '".$row['unit']."'"); foreach($myrow2 as $row2){echo $row2['name'];} ?>
        </td>
        <td><?php echo $row['marks'] ?></td>
        <td>
            <?php
            $marks = $row['marks'];
            if($marks >= 90){
                echo "DISTINCTION I";
            }else if($marks >= 80){
                echo "DISTINCTION II";
            }else if($marks >= 70){
                echo "CREDIT III";
            }else if($marks >= 60){
                echo "CREDIT IV";
            }else if($marks >= 50){
                echo "PASS V";
            }else if($marks >= 40){
                echo "PASS VI";
            }else if($marks >= 30){
                echo "REFERRED";
            }else{
                echo "FAIL";
            }
            ?>
        </td>

    </tr>
    <?php
}
    ?>

</table>
<div class="w3-center w3-padding">
    <b>GRADE: <?php 

    //number of subjects in course
    $myrow3 = $student->fetch("SELECT * FROM student WHERE admission = '".$_GET['admission']."'");
    foreach($myrow3 as $row3){
        $myrow4 = $student->fetch("SELECT * FROM unit WHERE course = '".$row3['course']."'");
        $total_units = count($myrow4);
        $units_done = count($myrow);
        if($units_done < $total_units){
            echo "INCOMPLETE";
        }else{
            $myrow5 = $student->fetch("SELECT SUM(marks) AS total FROM `entry` WHERE exam_name = '".$_GET['examIdd2']."' AND student_admission = '".$_GET['admission']."'");
            foreach($myrow5 as $row5){
                $total_marks = $row5['total'];
                // echo $total_marks;
            }
            $myrow6 = $student->fetch("SELECT * FROM `entry` WHERE exam_name = '".$_GET['examIdd2']."' AND student_admission = '".$_GET['admission']."' AND marks < 40");
            if(count($myrow6) > 2){
                echo "FAIL";
            }elseif(count($myrow6) > 0){
                echo "REFERRED (".count($myrow6).")";
            }else{
                $average = $total_marks / $units_done;
                if($average >= 90){
                    echo "DISTINCTION I";
                }else if($average >= 80){
                    echo "DISTINCTION II";
                }else if($average >= 70){
                    echo "CREDIT III";
                }else if($average >= 60){
                    echo "CREDIT IV";
                }else if($average >= 50){
                    echo "PASS V";
                }else if($average >= 40){
                    echo "PASS VI";
                }else if($average >= 30){
                    echo "REFERRED";
                }else{
                    echo "FAIL";
                }
            }
        }
        
    }
    
    //number of subjects done
    //average can now be found
    ?></b>
</div>


<?php
exit();
    
}

if(isset($_GET['unit_interface'])){
    $myrow = $student->fetch("SELECT * FROM unit WHERE `name` LIKE '%".$_GET['unit_interface']."%' ORDER BY id DESC LIMIT 7");
    ?>
<table class="w3-table w3-bordered w3-small">
    <tr>
        <th>Code</th>
        <th>Name</th>
        <th>Mean</th>
    </tr>
    <?php

    foreach($myrow as $row){
        ?>
    <tr>
        <td><?php echo $row['unitCode']; ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php 
        $myrow2 = $student->fetch("SELECT * FROM `entry` WHERE unit = '".$row['unitCode']."'");
        $myrow3 = $student->fetch("SELECT SUM(marks) AS total FROM `entry` WHERE unit = '".$row['unitCode']."'");
        foreach($myrow3 as $row3){
            $total = $row3['total'];
            $f = count($myrow2);
            if($f < 1){
                echo "No Entry Detected";
            }else{
                $mean = $total / $f;
                echo number_format($mean, 2);
            }
        }
        ?></td>
    </tr>
    <?php
    }

    ?>

</table>
<?php
}



// 

?>