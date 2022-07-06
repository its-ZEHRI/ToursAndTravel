<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");
?>

<?php
session_name('travel');
session_start();
error_reporting(0);
if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
} else
    header("location:includes/signin.php");

$pid = intval($_GET['id']);
include("processor/Package.php");
$object = new Package();
$package  = $object->get_package($pid);
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>TMS | Package List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <!-- Custom Theme files -->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <style type="text/css">
        .edit-image-icon {
            position: absolute;
            bottom: -30%;
            left: 16%;
            color: red;
            cursor: pointer;

        }
        .package-details h3{
            font-size: 20px;
        }
        .package-details h3 span{
            opacity: 0.7;
        }
    </style>
</head>

<body style="background-color:rgba(0, 0, 0, 0.05)">
    <?php include('includes/header.php'); ?>

    <main class="pt-5 bg-light">
        <div class="container p-5">
            <div class="row bg-light p-3" style="box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.3);">
                <div class="col-md-7 px-5 package-details">
                    <h2><?php echo $package[0]->PackageName ?></h2>
                    <hr>
                    <h3>Package Type : <span><?php echo $package[0]->PackageType ?></span></h3>
                    <h3>Package Location : <span><?php echo $package[0]->PackageLocation ?></span></h3>
                    <h3>Features : <span><?php echo $package[0]->PackageFetures ?></span></h3>
                    <h3>Total : <span>2500/-</span></h3>
                    <form action="" method="POST" class="w-50 my-4">
                        <div class="form-group">
                            <label for="">From</label>
                            <input type="date" name="from" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">To</label>
                            <input type="date" name="to" class="form-control">
                        </div>
                    </form>
                    <h3>Package Details</h3>
                    <P style="opacity: 0.7;"><?php echo $package[0]->PackageDetails ?></P>
                </div>
                <div class="col-md-5 text-end">
                    <img src="images/6.jpg" alt="" width="80%">
                </div>
            </div>
        </div>
    </main>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>