<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>performance</title>


    <link rel="stylesheet" href="./Assets/felabs/felabs.css">
    <link rel="stylesheet" href="./Assets/felabs/style.css">
    <style>
    th,
    td {
        border: 1px solid #ccc;
    }
    </style>
</head>

<body>
    <div class="w3-bar w3-white w3-padding w3-border-bottom">
        <span class="w3-large w3-bar-item">
            Hill Breeze Student Performance Management System
        </span>
    </div>
    <div class="w3-bar w3-white w3-padding">
        <a href="./index.php" class="w3-bar-item">Home</a>
        <a href="./student.php" class="w3-bar-item w3-border-bottom">Students</a>
        <a href="./courses.php" class="w3-bar-item">Courses</a>
        <a href="./units.php" class="w3-bar-item">Units</a>
        <a href="./logout.php" class="w3-bar-item">Log Out</a>
    </div><br>
    <div class="w3-auto w3-padding w3-round-large w3-white">
        <button class="w3-button w3-light-grey w3-round" onclick="openModal('newStudent')">New Student</button>
        <!-- <button class="w3-button w3-light-grey w3-round">Exam Entry</button> -->
        <div class="w3-right">
            <input type="text" placeholder="search"
                onkeyup="retrieveData('allStudents', `./resources/UI.php?student_interface=${this.value}`)"
                class="w3-input w3-border w3-round">
        </div>
    </div><br>
    <div class="w3-auto w3-padding w3-round-large w3-white">
        <h4>All Students</h4>
        <div id="allStudents" style="height: 300px; overflow-y: auto;">
            <table class="w3-table w3-bordered w3-small">
                <tr>
                    <th>Adm</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td>DICT/j11/099</td>
                    <td>Felabs</td>
                    <td><button class="w3-button w3-padding-small w3-round w3-border"
                            onclick="openModal('newEntry')">New Entry</button>&nbsp;<button
                            class="w3-button w3-padding-small w3-round w3-border"
                            onclick="openModal('updateEntry')">Update
                            Entry</button>&nbsp;<button
                            class="w3-button w3-padding-small w3-round w3-border">Progress</button></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="w3-modal" id="newStudent">
        <div class="w3-modal-content w3-white w3-round-large w3-padding">
            <div class="w3-container">
                <span class="w3-large w3-padding">New Student</span>
                <div class="w3-right"><button class="w3-button w3-border w3-round-xxlarge"
                        onclick="closeModal('newStudent')">&times;</button></div>

            </div>
            <hr>
            <form action="./resources/process.php?new_student=true" id="frmNewStudent" class="w3-container">
                <div id="studentAlert" style="display: none;" class="w3-card-6 w3-round-large w3-padding w3-green">Saved
                    successfully</div>
                <label>Name</label>
                <input type="text" name="sname" id="sname" class="w3-input w3-border w3-round">
                <label>Admission</label>
                <input type="text" name="sadm" id="sadm" class="w3-input w3-border w3-round">
                <label>Course</label>
                <select name="scourse" id="scourse" onfocus="retrieveData('scourse', './resources/UI.php?courses=true')"
                    class="w3-select w3-border w3-round">

                </select><br><br>
                <button class="w3-button w3-light-grey w3-block w3-round" type="button"
                    onclick="registerStudent()">Register</button><br>
            </form>
        </div>
    </div>

    <div class="w3-modal" id="newEntry">

    </div>

    <div class="w3-modal" id="updateEntry">

    </div>

    <div class="w3-modal" id="progress">

    </div>

    <script src="./Assets/jquery/jquery.min.js"></script>
    <script src="./Assets/felabs/JS/app.js"></script>
    <script>
    retrieveData('allStudents', `./resources/UI.php?student_interface=`)
    </script>
</body>

</html>