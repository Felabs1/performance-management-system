<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>performance</title>


    <link rel="stylesheet" href="./Assets/felabs/felabs.css">
    <link rel="stylesheet" href="./Assets/felabs/style.css">
</head>

<body>
    <div class="w3-bar w3-white w3-padding w3-border-bottom">
        <span class="w3-large w3-bar-item">
            Hill Breeze Student Performance Management System
        </span>
    </div>
    <div class="w3-bar w3-white w3-padding">
        <a href="./index.php" class="w3-bar-item">Home</a>
        <a href="./student.php" class="w3-bar-item">Students</a>
        <a href="./courses.php" class="w3-bar-item w3-border-bottom">Courses</a>
        <a href="./units.php" class="w3-bar-item">Units</a>
        <a href="./logout.php" class="w3-bar-item">Log Out</a>
    </div><br>

    <div class="w3-auto w3-padding w3-round-large w3-white">
        <button class="w3-button w3-light-grey w3-round" onclick="openModal('newCourse')">New Course</button>
        <button class="w3-button w3-light-grey w3-round" onclick="openModal('scheduleExam')">Schedule Exam</button>
        <div class="w3-right">
            <input type="text" onkeyup="retrieveData('allCourses', `./resources/UI.php?course_interface=${this.value}`)"
                placeholder="search" class="w3-input w3-border w3-round">
        </div>
    </div><br>
    <div class="w3-auto w3-padding w3-round-large w3-white">
        <h4>All Courses</h4>
        <div id="allCourses" style="height: 300px; overflow-y: auto;">
            <table class="w3-table w3-bordered w3-small">
                <tr>
                    <th>Course COde</th>
                    <th>Course Name</th>
                    <th>Units</th>
                    <th>Student COunt</th>
                    <th>Mean</th>
                </tr>
                <tr>
                    <td>7797</td>
                    <td>Dip In ICT Mod I</td>
                    <td>8</td>
                    <td>922</td>
                    <td>9.9</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="w3-modal" id="newCourse">
        <div class="w3-modal-content w3-white w3-round-large w3-padding">
            <div class="w3-container">
                <span class="w3-large">New Course</span>
                <div class="w3-right"><button class="w3-button w3-borde w3-round-xlarge"
                        onclick="closeModal('newCourse')">&times;</button></div>
            </div>
            <hr>
            <form action="./resources/process.php?new_course=true" class="w3-container" method="post">
                <label for="">Code</label>
                <input type="text" name="code" id="code" class="w3-input w3-border w3-round">
                <label for="">Course Name</label>
                <input type="text" name="courseName" id="courseName" class="w3-input w3-border w3-round">
                <br>
                <button class="w3-button w3-light-grey w3-round w3-block">Submit</button><br>
            </form>
        </div>
    </div>

    <div class="w3-modal" id="scheduleExam">
        <div class="w3-modal-content w3-white w3-round-large w3-padding">
            <div class="w3-container">
                <span class="w3-large">Schedule Exam</span>
                <div class="w3-right"><button class="w3-button w3-borde w3-round-xlarge"
                        onclick="closeModal('scheduleExam')">&times;</button></div>
            </div>
            <hr>
            <form action="./resources/process.php?schedule_exam=true" class="w3-container" method="post">
                <label for="">Date</label>
                <input type="date" name="examDate" id="examDate" class="w3-input w3-border w3-round" required>
                <label for="">Exam Name</label>
                <input type="text" name="examName" id="examName" class="w3-input w3-border w3-round" required>
                <label for="">Course Name</label>
                <select name="course" id="course" class="w3-select w3-border w3-round"
                    onfocus="retrieveData('course', './resources/UI.php?courses=true')">

                </select><br>
                <br>
                <button class="w3-button w3-light-grey w3-round w3-block">Submit</button><br>
            </form>
        </div>
    </div>
    <script src="./Assets/jquery/jquery.min.js"></script>
    <script src="./Assets/felabs/JS/app.js"></script>
    <script>
    retrieveData('allCourses', `./resources/UI.php?course_interface=`)
    </script>
</body>

</html>