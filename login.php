<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="./css/w3.css"> -->
    <link rel="stylesheet" href="./Assets/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="./Assets/felabs/felabs.css">
    <link rel="stylesheet" href="./Assets/felabs/style.css">

    <style>
    * {
        font-family: sans-serif;
        color: #444;
    }

    .w3-bar-item {
        text-decoration: none;
    }

    .w3-bar-item:hover {
        color: #f44336;
    }

    .background {
        height: 300px;
        position: relative;
    }

    .background h1 {
        font-weight: 600;
        margin: 50px 10px 20px 80px;
    }

    .background button {
        margin: 50px 10px 20px 80px;
    }
    </style>
    <title>Document</title>
</head>

<body style="background-color: #efefef">
    <div class="w3-bar w3-white">
        <a class="w3-bar-item w3-large"><span class="w3-text-red">Hill</span> Breeze</a>
        <div class="w3-right">
            <!-- <a href="./index.php" class="w3-bar-item">Home</a>
            <a href="./index.php" class="w3-bar-item">About Us</a>
            <a href="./index.php" class="w3-bar-item">Properties</a> -->
            <a href="./login.html" class="w3-bar-item">Log in</a>
        </div>
    </div>
    <div class="background">
        <div class="w3-row-padding">
            <div class="w3-col m8">
                <br>
                <h1>Welcome To Hill Breeze Student Performance Management System</h1>
                <!-- <button class="w3-button w3-red w3-round-xlarge">Get Started</button> -->

            </div>
            <div class="w3-col m4"><br><br>
                <div class="w3-white w3-round-large w3-padding-large">
                    <h3>Sign In</h3>
                    <form id="frmlogin">
                        <label for="">email</label>
                        <input type="text" class="w3-input w3-border w3-round-xlarge" placeholder="eg user@domain.com"
                            name="email" id="email"><br>
                        <label for="">Password</label>
                        <input type="password" class="w3-input w3-border w3-round-xlarge" placeholder="enter password"
                            name="password" id="password"><br>
                        <input class="w3-button w3-light-grey w3-block w3-round-xlarge" type="button" value="log in"
                            onclick="login()"><br>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <script src="./Assets/jquery/jquery.min.js"></script>
    <script src="./Assets/felabs/JS/app.js"></script>

    <script>
    function login() {
        var email = $("#email"),
            password = $("#password"),
            status;

        if (email.val() == "" || password.val() == "") {
            alert('please fill in every field');
            status = false;
        }

        if (status !== false) {
            $.ajax({
                url: "./resources/process.php?login=true",
                method: "POST",
                data: $("#frmlogin").serialize(),
                success: function(data) {
                    console.log(data);
                    if (data == "INVALID_USER") {
                        alert('invalid username');
                    } else if (data == 'INCORRECT_PASSWORD') {
                        alert('incorrect password');
                    } else {
                        alert('logged in, Redirecting...')
                        window.location.href = './index.php'
                    }
                }
            })
        }

    }
    </script>

</body>

</html>