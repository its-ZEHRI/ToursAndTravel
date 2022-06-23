 <?php
include("../processor/get_processor.php");
if(isset($_POST['submit'])){
    $resp=$obj->tblusersup();
}
//  include("config.php");
// session_start();
// error_reporting(0);
// if(isset($_POST['submit']))
// {
// $fname=$_POST['fname'];
// $mnumber=$_POST['mobilenumber'];
// $email=$_POST['email'];
// $password=md5($_POST['password']);
// $sql="INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
// $query = $dbh->prepare($sql);
// $query->bindParam(':fname',$fname,PDO::PARAM_STR);
// $query->bindParam(':mnumber',$mnumber,PDO::PARAM_STR);
// $query->bindParam(':email',$email,PDO::PARAM_STR);
// $query->bindParam(':password',$password,PDO::PARAM_STR);
// $query->execute();
// $lastInsertId = $dbh->lastInsertId();
// if($lastInsertId)
// {
// $_SESSION['msg']="You are Scuccessfully registered. Now you can login ";
// header('location:../thankyou.php');
// }
// else 
// {
// $_SESSION['msg']="Something went wrong. Please try again.";
// header('location:thankyou.php');
// }
// }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Final Year Project -- Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./images/logo.jpg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="./styles/variables.css"> -->
    <link rel="stylesheet" href="../css/signup.css">
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

             <!--Javascript for check email availabilty-->
<script>
function checkAvailability() {

$("#loaderIcon").show();
jQuery.ajax({
url: "../check_availability.php",
data:'emailid='+$("#email").val(),
type: "POST",
success:function(data){
$("#user-availability-status").html(data);
$("#loaderIcon").hide();
},
error:function (){}
});
}
</script>
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
    <div class="container">
        <div class="title">Registration</div>
        <div class="content">
            <form action="signup.php" method="post">
                <div class="user-details">
                    <div class="input-box">
                        <span class="details">Full Name</span>
                        <input type="text" name="fname" placeholder="Enter your Fname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Phone Number</span>
                        <input type="text" name="mobilenumber" maxlength="11" placeholder="Enter your number" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="text" name="email" autocomplete="off" id="email" onblur="checkAvailability()" placeholder="Enter your email" required>
                        <span id="user-availability-status" style="font-size:12px;"></span> 

                    </div>
                    
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password" name="password" autocomplete="off" placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="button">
                    <input type="submit" name="submit" value="Register">
                </div>
                <p>By logging in you agree to our <a href="../page.php?type=terms">Terms and Conditions</a> and <a href="../page.php?type=privacy">Privacy Policy</a></p>
            </form>
        </div>
    </div>
    <div class="back-btn-wrap">
        <a class="back-btn" href="../index.php" style="color:blue;"><i class="fa fa-arrow-left"></i>Back to HomePage</a>
    </div>
    <!-- Footer  -->
    <footer>
        <!-- <p>By logging in you agree to our <a href="page.php?type=terms">Terms and Conditions</a> and <a href="page.php?type=privacy">Privacy Policy</a></p> -->

        <p>Copyright &copy; Last Year Project AUP</p>
    </footer>
</body>

</html>