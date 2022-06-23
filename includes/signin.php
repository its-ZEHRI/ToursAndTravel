<?php
include("../processor/get_processor.php");
if(isset($_POST['signin'])){
    $resp=$obj->tblusers();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Final Year Project -- Login in</title>
    <link rel="shortcut icon" href="./images/logo.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="./styles/variables.css">
     <style type="text/css">
             .back-btn-wrap {
    position: absolute;
    top: 0;
    left: 10px;
    display: inline-block;
    text-align: center;
    padding-top: .5rem;
}

.back-btn-wrap i {
    padding: 0 5px;
    color: var(--lightblue-color);
}

.back-btn {
    text-decoration: none;
    color: var(--lightblue-color);
    border-radius: 5px;
    font-size: 1rem;
}

.back-btn:hover {
    color: var(--lightblue-hover);
}


footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    height: 3rem;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: var(--lightblue-color);
    color: white;
}

footer p {
    letter-spacing: 1px;
    font-weight: 600;
    font-size: 1rem !important;
}
         </style> 
</head>

<body>
    <div id="login-form-wrap">
        <h2>Login</h2>
        <form action="signin.php" method="post" id="login-form">
            <p>
                <input type="email" id="email" name="email" placeholder="Email" required>
            </p>
            <p>
                <input type="text" id="password" name="password" placeholder="Password" required> 
            </p>
            <p>
                <div class="btn btn-primary">
                <input type="submit" style="color:blue;" name="signin" id="login" value="Login">
                </div>
            </p>
        </form>
        <div id="create-account-wrap">
            <a href="../forgot-password.php">Forgot password?</a>
            <p>Aren't you an account? <a href="signup.php">create account</a><p/>
            <p>By logging in you agree to our <a href="../page.php?type=terms">Terms and Conditions</a> and <a href="../page.php?type=privacy">Privacy Policy</a></p>


        </div>
    </div>
    <div class="back-btn-wrap">
        <a class="back-btn" href="../index.php" style="color: blue;"><i class="fa fa-arrow-left"></i>Back to HomePage</a>
    </div>
    <!-- Footer  -->
    <footer>
        <!-- <p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p> -->

        <p>Copyright &copy; Last Year Project AUP</p>
    </footer>
</body>

</html>