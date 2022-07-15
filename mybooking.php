<?php
    session_name('travel');
    session_start();
    error_reporting(0);
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
    } else
        header("location:includes/signin.php");

    include("processor/get_processor.php");
    $mybooking  = $package_obj->get_single_user_booking($_SESSION['id']);

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

        .package-details h3 {
            font-size: 20px;
        }

        .package-details h3 span {
            opacity: 0.7;
        }
    </style>
</head>

<body style="background-color:rgba(0, 0, 0, 0.05)">
    <?php include('includes/header.php'); ?>

    <main class="pt-5 bg-light">
        <div class="container p-5">
            <div class="row w-75 mx-auto bg-light p-3" style="box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.3);">
                
                <table class="table table-striped table-hover ">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Package Name</th>
                            <th scope="col">Package Type</th>
                            <th scope="col">Package Location</th>
                            <th scope="col">Package Price</th>
                            <th scope="col">Booking Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mybooking as $key => $booking) {?>
                        <tr>
                            <th scope="row"><?php echo $key+1 ?></th>
                            <td><?php echo $booking->PackageName ?></td>
                            <td><?php echo $booking->PackageType ?></td>
                            <td><?php echo $booking->PackageLocation ?></td>
                            <td><?php echo $booking->PackagePrice ?>/-</td>
                            <td style="color: blue;"><?php  if($booking->status) echo "Accepted"; else echo "Requested" ; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>