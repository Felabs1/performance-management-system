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
        <a href="./courses.php" class="w3-bar-item">Courses</a>
        <a href="./units.php" class="w3-bar-item w3-border-bottom">Units</a>
        <a href="./logout.php" class="w3-bar-item">Log Out</a>
    </div><br>
    <div class="w3-auto w3-padding w3-round-large w3-white">
        <button class="w3-button w3-light-grey w3-round" onclick="openModal('newUnit')">New Unit</button>
        <div class="w3-right">
            <input type="text" onkeyup="retrieveData('allUnits', `./resources/UI.php?unit_interface=${this.value}`)"
                placeholder="search" class="w3-input w3-border w3-round">
        </div>
    </div><br>
    <div class="w3-auto w3-padding w3-round-large w3-white">
        <h4>All Units</h4>
        <div id="allUnits" style="height: 300px; overflow-y: auto;">
            <table class="w3-table w3-bordered w3-small">
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Course Count</th>
                    <th>Mean</th>
                </tr>
                <tr>
                    <td>777</td>
                    <td>Maths</td>
                    <td>3</td>
                    <td>92%</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="w3-modal" id="newUnit">
        <div class="w3-modal-content w3-white w3-round-large w3-padding">
            <div class="w3-container">
                <span class="w3-large">New Unit</span>
                <div class="w3-right"><button class="w3-button w3-border w3-round-xxlarge"
                        onclick="closeModal('newUnit')">&times;</button></div>

            </div>
            <hr>
            <form action="./resources/process.php?new_unit=true" method="post" class="w3-container">
                <label>unit Code</label>
                <input type="text" name="unitCode" id="unitCode" class="w3-input w3-border w3-round">
                <label>unit Name</label>
                <input type="text" name="unitName" id="unitName" class="w3-input w3-border w3-round">
                <label>Course</label>
                <select name="course" id="course" class="w3-select w3-border w3-round"
                    onfocus="retrieveData('course', './resources/UI.php?courses=true')">

                </select><br><br>
                <button class="w3-button w3-light-grey w3-block w3-round">Register</button><br>
            </form>
        </div>
    </div>
    <script src="./Assets/jquery/jquery.min.js"></script>
    <script src="./Assets/felabs/JS/app.js"></script>
    <script>
    retrieveData('allUnits', `./resources/UI.php?unit_interface=`);
    </script>
</body>

</html>