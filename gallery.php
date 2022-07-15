<?php
    session_name('travel');
    session_start();
    error_reporting(0);
    if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
    } else
        header("location:includes/signin.php");

    include('processor/get_processor.php');
    $userPost = $obj->getUserPost();
?>
<!DOCTYPE HTML>
<html style="scroll-behavior: smooth;">

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
    <script src="https://kit.fontawesome.com/068fbca468.js" crossorigin="anonymous"></script>
    <!--//end-animate-->
</head>

<body style="background-color:rgba(0, 0, 0, 0.05)">
    <?php include('includes/header.php'); ?>

    <main class="pt-1">

       <!-- gallery -->
        <div class="container mt-5 py-5">
            <h1>Gallery</h1>
            <hr class="m-0">
            <div class="container mt-5">
                <div class="row">
                    <?php foreach ($userPost as $key => $value) { ?>
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="ratio ratio-4x3">
                                    <img class="card-img-top" src="images/<?php echo $value->p_image; ?>" alt="Card image cap" style="width:100%; background-size:contain; object-fit:cover; background-position:center">
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- gallery end -->

    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>