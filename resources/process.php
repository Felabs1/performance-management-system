<?php 

require_once("students.php");

$student = new Student;

if(isset($_GET['new_course'])){
    $ns = $student->new_course($_POST['courseName'], $_POST['code']);
    if($ns == "course_exist"){
        header('location: ../courses.php?err=A course with the same code name exist');
    }else{
        header("location: ../courses.php?msg=course registered successfully");
    }
}

if(isset($_GET['new_unit'])){
    $nu = $student->new_unit($_POST['unitName'], $_POST['unitCode'], $_POST['course']);
    if($nu == "unit_exist"){
        header('location: ../units.php?err=A unit with the same code name exist');
    }else{
        header("location: ../units.php?msg=unit registered successfully");
    }
}

if(isset($_GET['schedule_exam'])){
    $se = $student->new_schedule($_POST['examName'], $_POST['examDate'],  $_POST['course']);
    if($se == "schedule_exist"){
        header("location: ../courses.php?err=exam allready exist");

    }else{
        header("location: ../courses.php?msg=exam scheduled successfully");
    }
}

if(isset($_GET['new_student'])){
    $ns = $student->new_student($_POST['sname'], $_POST['sadm'], $_POST['scourse']);
    echo $ns;
}


if(isset($_GET['new_entry'])){
    $ne = $student->new_entry($_POST['admission'], $_POST['exam'], $_POST['unit'], $_POST['marks']);
    echo $ne;
}

if(isset($_GET['updateEntry'])){
    $ue = $student->update_entry($_POST['unit'], $_POST['marks']);
    echo $ue;
}

if(isset($_GET['login'])){
    echo $student->login($_POST['email'], $_POST['password']);
}



?>