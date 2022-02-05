<?php 

class Student {

    private $conn;

    public function __construct(){
        $this->conn = new mysqli("localhost", "root", "", "StudentPerformance");
    }

    private function course_exist($code){
        $sql = "SELECT * FROM courses WHERE code = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $code);
        $stmt->execute() or die($this->conn->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return 1;
        }else{
            return 0;
        }
    }

    private function unit_exist($unit_code){
        $sql = "SELECT * FROM unit WHERE unitCode = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $unit_code);
        $stmt->execute() or die($this->conn->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return 1;
        }else{
            return 0;
        }
    }

    private function schedule_exist($exam_name, $exam_date, $course){
        $sql = "SELECT * FROM schedule WHERE exam_name = ? AND exam_date = ? AND course = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $exam_name, $exam_date, $course);
        $stmt->execute() or die($this->conn->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return 1;
        }else{
            return 0;
        }
    }

    private function student_exist($admission){
        $sql = "SELECT * FROM student WHERE admission = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $admission);
        $stmt->execute() or die($this->conn->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return 1;
        }else{
            return 0;
        }
    }

    private function entry_exist($admission, $exam_name, $unit){
        $sql = "SELECT * FROM `entry` WHERE student_admission = ? AND exam_name = ? AND unit = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $admission, $exam_name, $unit);
        $stmt->execute() or die($this->conn->error);
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            return 1;
        }else{
            return 0;
        }
    }

    public function new_course($name, $code){
        if($this->course_exist($code)){
            return "course_exist";
        }else{
            $sql = "INSERT INTO `courses`(`name`, `code`) VALUES (?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss", $name, $code);
            $result = $stmt->execute() or die($this->conn->error);
            if($result){
                return 1;
            }else{
                return $this->conn->error;
            }
        }
        
    }

    public function new_unit($name, $unit_code, $course){
        if($this->unit_exist($unit_code)){
            return "unit_exist";
        }else{
            $sql = "INSERT INTO `unit`(`name`, `unitCode`, `course`) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $name, $unit_code, $course);
            $result = $stmt->execute()or die($this->conn->error);
            if($result){
                return 1;
            }else{
                return $this->conn->error;
            }
        }
        
    }

    public function new_schedule($exam_name, $exam_date, $course){
        if($this->schedule_exist($exam_name, $exam_date, $course)){
            return "schedule_exist";
        }else{
            $sql = "INSERT INTO `schedule`(`exam_name`, `exam_date`, `course`) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $exam_name, $exam_date, $course);
            $result = $stmt->execute()or die($this->conn->error);
            if($result){
                return 1;
            }else{
                return $this->conn->error;
            }
        }
        
    }

    public function new_student($name, $admission, $course){
        if($this->student_exist($admission)){
            return "student_exists";
        }else{
            $sql = "INSERT INTO `student`(`name`, `admission`, `course`) VALUES (?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sss", $name, $admission, $course);
            $result = $stmt->execute() or die($this->conn->error);
            if($result){
                return 1;
            }else{
                return $this->conn->error;
            }
        }
        
    }

    public function new_entry($admission ,$exam_name, $unit, $marks){
        if($this->entry_exist($admission, $exam_name, $unit)){
            return "entry_exist";
        }else{
            $sql = "INSERT INTO `entry`(`student_admission`, `exam_name`, `unit`, `marks`) VALUES (?,?,?,?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ssss", $admission ,$exam_name, $unit, $marks);
            $result = $stmt->execute() or die($this->conn->error);
            if($result){
                return 1;
            }else{
                return $this->conn->error;
            } 
        }
        

    }

    public function update_entry($id, $marks){
        // $sql = "UPDATE `entry` SET marks = ?, WHERE student_admission = ? AND exam_name = ? AND unit = ?";
        // $stmt = $this->conn->prepare($sql);
        // $stmt->bind_param("ssss", $marks ,$admission, $exam_name, $unit);
        // $result = $stmt->execute() or die($this->conn->error);
        // if($result){
        //     return 1;
        // }else{
        //     return $this->conn->error;
        // } 

        $sql = "UPDATE `entry` SET marks = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $marks, $id);
        $result = $stmt->execute() or die($this->conn->error);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }

    public function fetch($sql){
        $array = array();
        $result = $this->conn->query($sql);
        while($row = $result->fetch_assoc()){
            $array[] = $row;
        }
        return $array;
    }

    public function login($email, $password){
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute() or die($this->conn->error);
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                $_SESSION['id'] = $row['id'];
                $_SESSION['fullname'] = $row['full_name'];
                $_SESSION['usertype'] = $row['user_type'];
                $_SESSION['email'] = $row['email'];
            }else{
                return "INCORRECT_PASSWORD";
            }
        }else{
            return "INVALID_USER";
        }
    }


}



// echo password_hash("31028431", PASSWORD_DEFAULT);



?>